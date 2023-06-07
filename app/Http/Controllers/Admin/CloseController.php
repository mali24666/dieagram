<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCloseRequest;
use App\Http\Requests\StoreCloseRequest;
use App\Http\Requests\UpdateCloseRequest;
use App\Models\Close;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CloseController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('close_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Close::with(['lices_no'])->select(sprintf('%s.*', (new Close())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'close_show';
                $editGate = 'close_edit';
                $deleteGate = 'close_delete';
                $crudRoutePart = 'closes';

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
            $table->addColumn('lices_no_name', function ($row) {
                return $row->lices_no ? $row->lices_no->name : '';
            });

            $table->editColumn('after_esfelt', function ($row) {
                if (!$row->after_esfelt) {
                    return '';
                }
                $links = [];
                foreach ($row->after_esfelt as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('eng_sign', function ($row) {
                if (!$row->eng_sign) {
                    return '';
                }
                $links = [];
                foreach ($row->eng_sign as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->editColumn('etmam_al_amal', function ($row) {
                if (!$row->etmam_al_amal) {
                    return '';
                }
                $links = [];
                foreach ($row->etmam_al_amal as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'lices_no', 'after_esfelt', 'eng_sign', 'etmam_al_amal']);

            return $table->make(true);
        }

        $tasks = Task::get();

        return view('admin.closes.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('close_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lices_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.closes.create', compact('lices_nos'));
    }
    public function add($id)
    {
        abort_if(Gate::denies('close_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lices_nos = Task::find($id);

        return view('admin.closes.add', compact('lices_nos'));
    }

    public function store(StoreCloseRequest $request)
    {
        $close = Close::create($request->all());

        foreach ($request->input('after_esfelt', []) as $file) {
            $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('after_esfelt');
        }

        foreach ($request->input('eng_sign', []) as $file) {
            $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('eng_sign');
        }

        foreach ($request->input('etmam_al_amal', []) as $file) {
            $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('etmam_al_amal');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $close->id]);
        }

        return redirect()->route('admin.closes.index');
    }

    public function edit(Close $close)
    {
        abort_if(Gate::denies('close_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lices_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $close->load('lices_no');

        return view('admin.closes.edit', compact('close', 'lices_nos'));
    }

    public function update(UpdateCloseRequest $request, Close $close)
    {
        $close->update($request->all());

        if (count($close->after_esfelt) > 0) {
            foreach ($close->after_esfelt as $media) {
                if (!in_array($media->file_name, $request->input('after_esfelt', []))) {
                    $media->delete();
                }
            }
        }
        $media = $close->after_esfelt->pluck('file_name')->toArray();
        foreach ($request->input('after_esfelt', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('after_esfelt');
            }
        }

        if (count($close->eng_sign) > 0) {
            foreach ($close->eng_sign as $media) {
                if (!in_array($media->file_name, $request->input('eng_sign', []))) {
                    $media->delete();
                }
            }
        }
        $media = $close->eng_sign->pluck('file_name')->toArray();
        foreach ($request->input('eng_sign', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('eng_sign');
            }
        }

        if (count($close->etmam_al_amal) > 0) {
            foreach ($close->etmam_al_amal as $media) {
                if (!in_array($media->file_name, $request->input('etmam_al_amal', []))) {
                    $media->delete();
                }
            }
        }
        $media = $close->etmam_al_amal->pluck('file_name')->toArray();
        foreach ($request->input('etmam_al_amal', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $close->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('etmam_al_amal');
            }
        }

        return redirect()->route('admin.closes.index');
    }

    public function show(Close $close)
    {
        abort_if(Gate::denies('close_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $close->load('lices_no');

        return view('admin.closes.show', compact('close'));
    }

    public function destroy(Close $close)
    {
        abort_if(Gate::denies('close_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $close->delete();

        return back();
    }

    public function massDestroy(MassDestroyCloseRequest $request)
    {
        Close::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('close_create') && Gate::denies('close_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Close();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}