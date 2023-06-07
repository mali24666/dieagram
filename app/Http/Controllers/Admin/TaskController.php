<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Lic;
use App\Models\Task;
use App\Models\close;
use App\Models\esfelt;
use App\Models\User;
use Gate;
use auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Events\showLicesNumber;

class TaskController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Task::with(['lics_no', 'assigned_to', 'statuts'])->select(sprintf('%s.*', (new Task())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'task_show';
                $editGate = 'task_edit';
                $deleteGate = 'task_delete';
                $taskEsfelt = 'task_esfelt';
                $taskClose = 'task_close';
                $billcon = 'billcon';
                $crudRoutePart = 'tasks';

                return view('admin.tasks.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'taskEsfelt',
                'taskClose',
                'billcon',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('lics_file', function ($row) {
                if (!$row->lics_file) {
                    return '';
                }
                $links = [];
                foreach ($row->lics_file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('lics_no_license_no', function ($row) {
                return $row->lics_no ? $row->lics_no->license_no : '';
            });
            $table->editColumn('responser', function ($row) {
                return $row->responser ? Task::RESPONSER_SELECT[$row->responser] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            // $table->editColumn('name', function ($row) {
            //     return $row->name ? $row->name : '';
            // });

            $table->editColumn('con', function ($row) {
                return $row->con ? Task::CONS_SELECT[$row->con] : '';
            });
            $table->editColumn('city', function ($row) {
            return $row->city ? $row->city : '';
            });
            $table->editColumn('streat', function ($row) {
                return $row->streat ? $row->streat : '';
            });
            $table->editColumn('stuts', function ($row) {
                return $row->stuts ? Task::STUTS_SELECT[$row->stuts] : '';
            });
            $table->addColumn('assigned_to_name', function ($row) {
                return $row->assigned_to ? $row->assigned_to->name : '';
            });
            $table->editColumn('move_to_con_date', function ($row) {
                return $row->move_to_con_date ? $row->move_to_con_date : '';
            });
            $table->editColumn('enjaz_stuts', function ($row) {
                return $row->enjaz_stuts ? Task::ENJAZ_STUTS_SELECT[$row->enjaz_stuts] : '';
            });
            // $table->editColumn('con', function ($row) {
            //     return $row->con ? $row->con : '';
            // });

            $table->rawColumns(['actions', 'placeholder', 'lics_file', 'lics_no', 'assigned_to', 'statuts']);

            return $table->make(true);
        }

        $lics    = Lic::get();
        $users   = User::get();
        $esfelts = Esfelt::get();
        return view('admin.tasks.index', compact('lics', 'users', 'esfelts'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Lic::pluck('license_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $add= Auth::user();

        $statuts = Esfelt::pluck('delivery', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.create', compact('assigned_tos', 'lics_nos', 'statuts', 'add'));
    }

    public function add ($id)
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Lic::find($id);
//  dd($lics_nos);
        $created_by_id =  $lics_nos ->created_by_id;
        $add= Auth::user();
        $statuts = Esfelt::pluck('delivery', 'id')->prepend(trans('global.pleaseSelect'), '');
        $user = DB::table('users')
                ->where('id','=' ,$created_by_id);
        $assigned_tos = DB::table('users')->select('name','id')
                        ->where('id', $created_by_id) 
                        ->get();
       return view('admin.tasks.add', compact('created_by_id', 'lics_nos', 'add', 'statuts', 'user', 'assigned_tos'));
    }



    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());

        foreach ($request->input('lics_file', []) as $file) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lics_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }
        // dd($task);
        event(new showLicesNumber($task ));

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Lic::pluck('license_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $task->load('lics_no', 'assigned_to');
        // dd($task);

        return view('admin.tasks.edit', compact('assigned_tos', 'lics_nos', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());

        if (count($task->lics_file) > 0) {
            foreach ($task->lics_file as $media) {
                if (!in_array($media->file_name, $request->input('lics_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $task->lics_file->pluck('file_name')->toArray();
        foreach ($request->input('lics_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $task->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lics_file');
            }
        }

        return redirect()->route('admin.tasks.index' );
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('lics_no', 'assigned_to', 'licsesNumberLics', 'licsNoEsfelts', 'licesNoCloses');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
