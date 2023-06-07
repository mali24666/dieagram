<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBillconRequest;
use App\Http\Requests\StoreBillconRequest;
use App\Http\Requests\UpdateBillconRequest;
use App\Models\Billcon;
use App\Models\Lic;
use App\Models\Task;
use App\Models\User;
use Gate;
use auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillconController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('billcon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Billcon::with(['task_no', 'mokusa', 'created_by'])->select(sprintf('%s.*', (new Billcon())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'billcon_show';
                $editGate = 'billcon_edit';
                $deleteGate = 'billcon_delete';
                $crudRoutePart = 'billcons';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('task_no_name', function ($row) {
                return $row->task_no ? $row->task_no->name : '';
            });

            $table->editColumn('task_no.length_total', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->length_total) : '';
            });
            $table->editColumn('task_no.city', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->city) : '';
            });
            $table->editColumn('task_no.move_to_con_date', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->move_to_con_date) : '';
            });
            $table->editColumn('task_no.esfelt_done', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->esfelt_done) : '';
            });
            $table->editColumn('task_no.enjaz', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->enjaz) : '';
            });
            $table->editColumn('task_no.enjaz_stuts', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : $row->task_no->enjaz_stuts) : '';
            });
            $table->editColumn('task_no.con', function ($row) {
                return $row->task_no ? (is_string($row->task_no) ? $row->task_no : Task::CONS_SELECT[$row->task_no->con]) : '';
            });

            $table->addColumn('mokusa_license_no', function ($row) {
                return $row->mokusa ? $row->mokusa->license_no : '';
            });

            // $table->editColumn('mokusa.stuts', function ($row) {
            //     return $row->mokusa ? (is_string($row->mokusa) ? $row->mokusa :  Lic::STUTS_SELECT[$row->mokusa->department]) : '';
            // });
            $table->editColumn('mokusa.department', function ($row) {
                return $row->mokusa ? (is_string($row->mokusa) ? $row->mokusa :  Lic::DEPARTMENT_SELECT[$row->mokusa->department]) : '';
            });


            $table->editColumn('mokusa.stuts', function ($row) {
                return $row->mokusa ? (is_string($row->mokusa) ? $row->mokusa : Lic::STUTS_SELECT[$row->mokusa->stuts]) : '';
            });
            $table->editColumn('mokusa.e_length', function ($row) {
                return $row->mokusa ? (is_string($row->mokusa) ? $row->mokusa : $row->mokusa->e_length) : '';
            });
            $table->editColumn('mokusa.sarameek', function ($row) {
                return $row->mokusa ? (is_string($row->mokusa) ? $row->mokusa : $row->mokusa->sarameek) : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->editColumn('job_1', function ($row) {
                return $row->job_1 ? Billcon::JOB_1_SELECT[$row->job_1] : '';
            });
            $table->editColumn('job_2', function ($row) {
                return $row->job_2 ? Billcon::JOB_2_SELECT[$row->job_2] : '';
            });
            $table->editColumn('job_3', function ($row) {
                return $row->job_3 ? Billcon::JOB_3_SELECT[$row->job_3] : '';
            });
            $table->editColumn('count_1', function ($row) {
                return $row->count_1 ? $row->count_1 : '';
            });
            $table->editColumn('count_2', function ($row) {
                return $row->count_2 ? $row->count_2 : '';
            });
            $table->editColumn('count_3', function ($row) {
                return $row->count_3 ? $row->count_3 : '';
            });
            $table->editColumn('totall', function ($row) {
                return $row->totall ? $row->totall : '';
            });
            $table->editColumn('totall_2', function ($row) {
                return $row->totall_2 ? $row->totall_2 : '';
            });
            $table->editColumn('totall_3', function ($row) {
                return $row->totall_3 ? $row->totall_3 : '';
            });
            $table->editColumn('totall_4', function ($row) {
                return $row->totall_4 ? $row->totall_4 : '';
            });
            $table->editColumn('enjaz', function ($row) {
                if (!$row->enjaz) {
                    return '';
                }
                $links = [];
                foreach ($row->enjaz as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('account_department', function ($row) {
                return $row->account_department ? Billcon::ACCOUNT_DEPARTMENT_SELECT[$row->account_department] : '';
            });

            $table->rawColumns(['actions','account_department', 'placeholder', 'task_no', 'mokusa', 'created_by', 'enjaz']);

            return $table->make(true);
        }

        $tasks = Task::get();
        $lics  = Lic::get();
        $users = User::get();

        return view('admin.billcons.index', compact('tasks', 'lics', 'users'));
    }
    public function create()
    {
        abort_if(Gate::denies('billcon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mokusas = Lic::pluck('license_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.billcons.create', compact('created_bies', 'mokusas', 'task_nos'));
    }
    public function add($id)
    {
        abort_if(Gate::denies('billcon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task_nos = Task::find($id);

        $mokusas = Lic::pluck('license_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
// dd( $task_nos);
        $add= Auth::user();

        return view('admin.billcons.add', compact('created_bies', 'mokusas', 'add', 'task_nos'));
    }

    public function store(StoreBillconRequest $request)
    {
        $billcon = Billcon::create($request->all());

        foreach ($request->input('enjaz', []) as $file) {
            $billcon->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('enjaz');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $billcon->id]);
        }

// dd($request);
        return redirect()->route('admin.billcons.index');
    }

    public function edit(Billcon $billcon)
    {
        abort_if(Gate::denies('billcon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mokusas = Lic::pluck('license_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $billcon->load('task_no', 'mokusa', 'created_by');

        return view('admin.billcons.edit', compact('billcon', 'created_bies', 'mokusas', 'task_nos'));
    }

    public function update(UpdateBillconRequest $request, Billcon $billcon)
    {
        $billcon->update($request->all());

        if (count($billcon->enjaz) > 0) {
            foreach ($billcon->enjaz as $media) {
                if (!in_array($media->file_name, $request->input('enjaz', []))) {
                    $media->delete();
                }
            }
        }
        $media = $billcon->enjaz->pluck('file_name')->toArray();
        foreach ($request->input('enjaz', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $billcon->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('enjaz');
            }
        }

        return redirect()->route('admin.billcons.index');
    }

    public function show(Billcon $billcon)
    {
        abort_if(Gate::denies('billcon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billcon->load('task_no', 'mokusa', 'created_by');

        return view('admin.billcons.show', compact('billcon'));
    }

    public function destroy(Billcon $billcon)
    {
        abort_if(Gate::denies('billcon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billcon->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillconRequest $request)
    {
        Billcon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('billcon_create') && Gate::denies('billcon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Billcon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}