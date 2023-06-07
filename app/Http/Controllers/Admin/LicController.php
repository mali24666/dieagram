<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLicRequest;
use App\Http\Requests\StoreLicRequest;
use App\Http\Requests\UpdateLicRequest;
use App\Models\Lic;
use App\Models\Task;
use App\Models\User;
use Gate;
use auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LicController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lic::with(['created_by', 'head_eng', 'user', 'licses_number'])->select(sprintf('%s.*', (new Lic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lic_show';
                $editGate = 'lic_edit';
                $deleteGate = 'lic_delete';
                $addGate = 'lic_add';
                $crudRoutePart = 'lics';

                return view('admin.lics.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'addGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('department', function ($row) {
                return $row->department ? Lic::DEPARTMENT_SELECT[$row->department] : '';
            });
            $table->editColumn('license_no', function ($row) {
                return $row->license_no ? $row->license_no : '';
            });

            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('naseg_no', function ($row) {
                return $row->naseg_no ? $row->naseg_no : '';
            });
            $table->editColumn('path', function ($row) {
                if (!$row->path) {
                    return '';
                }
                $links = [];
                foreach ($row->path as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('license_pic', function ($row) {
                if (!$row->license_pic) {
                    return '';
                }
                $links = [];
                foreach ($row->license_pic as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('stuts', function ($row) {
                return $row->stuts ? Lic::STUTS_SELECT[$row->stuts] : '';
            });
            $table->editColumn('e_length', function ($row) {
                return $row->e_length ? $row->e_length : '';
            });
            $table->editColumn('t_length', function ($row) {
                return $row->t_length ? $row->t_length : '';
            });
            $table->editColumn('sarameek', function ($row) {
                return $row->sarameek ? $row->sarameek : '';
            });
            $table->editColumn('wide', function ($row) {
                return $row->wide ? $row->wide : '';
            });
            $table->editColumn('deep', function ($row) {
                return $row->deep ? $row->deep : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->addColumn('head_eng_name', function ($row) {
                return $row->head_eng ? $row->head_eng->name : '';
            });
            $table->editColumn('eng_check', function ($row) {
                return $row->eng_check ? Lic::eng_check[$row->eng_check] : '';

            // $table->editColumn('eng_check', function ($row) {
            //     return '<input type="checkbox" disabled ' . ($row->eng_check ? 'checked' : null) . '>';
            });
            $table->editColumn('order_stauts', function ($row) {
                return $row->order_stauts ? Lic::ORDER_STAUTS_SELECT[$row->order_stauts] : '';
            });
            $table->editColumn('order_pic', function ($row) {
                if (!$row->order_pic) {
                    return '';
                }
                $links = [];
                foreach ($row->order_pic as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('naseg_no', function ($row) {
                return $row->naseg_no ? $row->naseg_no : '';
            });
            $table->editColumn('order_reject', function ($row) {
                if (!$row->order_reject) {
                    return '';
                }
                $links = [];
                foreach ($row->order_reject as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->editColumn('task_number', function ($row) {
                return $row->task_number ? $row->task_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'path', 'license_pic', 'created_by', 'head_eng', 'eng_check', 'order_pic', 'order_reject', 'user', 'licses_number']);

            return $table->make(true);
        }

        $users = User::get();
        $tasks = Task::get();

        return view('admin.lics.index', compact('users', 'tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('lic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $head_engs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $add= Auth::user();
        $licses_numbers = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lics.create', compact('created_bies', 'head_engs', 'licses_numbers', 'users', 'add'));
    }
    

    public function store(StoreLicRequest $request)
    {
        $lic = Lic::create($request->all());

        foreach ($request->input('path', []) as $file) {
            $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('path');
        }

        foreach ($request->input('license_pic', []) as $file) {
            $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('license_pic');
        }

        foreach ($request->input('order_pic', []) as $file) {
            $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('order_pic');
        }

        foreach ($request->input('order_reject', []) as $file) {
            $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('order_reject');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lic->id]);
        }

        return redirect()->route('admin.lics.index');
    }

    public function edit(Lic $lic)
    {
        abort_if(Gate::denies('lic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $head_engs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $licses_numbers = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $add= Auth::user();

        $lic->load('created_by', 'head_eng', 'user', 'licses_number');

        return view('admin.lics.edit', compact('head_engs', 'lic', 'licses_numbers', 'users', 'add'));
    }

    public function update(UpdateLicRequest $request, Lic $lic)
    {
        $lic->update($request->all());

        if (count($lic->path) > 0) {
            foreach ($lic->path as $media) {
                if (!in_array($media->file_name, $request->input('path', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lic->path->pluck('file_name')->toArray();
        foreach ($request->input('path', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('path');
            }
        }

        if (count($lic->license_pic) > 0) {
            foreach ($lic->license_pic as $media) {
                if (!in_array($media->file_name, $request->input('license_pic', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lic->license_pic->pluck('file_name')->toArray();
        foreach ($request->input('license_pic', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('license_pic');
            }
        }

        if (count($lic->order_pic) > 0) {
            foreach ($lic->order_pic as $media) {
                if (!in_array($media->file_name, $request->input('order_pic', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lic->order_pic->pluck('file_name')->toArray();
        foreach ($request->input('order_pic', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('order_pic');
            }
        }

        if (count($lic->order_reject) > 0) {
            foreach ($lic->order_reject as $media) {
                if (!in_array($media->file_name, $request->input('order_reject', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lic->order_reject->pluck('file_name')->toArray();
        foreach ($request->input('order_reject', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('order_reject');
            }
        }

        return redirect()->route('admin.lics.index');
    }

    public function show(Lic $lic)
    {
        abort_if(Gate::denies('lic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lic->load('created_by', 'head_eng', 'user', 'licses_number', 'licsNoTasks');

        return view('admin.lics.show', compact('lic'));
    }

    public function destroy(Lic $lic)
    {
        abort_if(Gate::denies('lic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lic->delete();

        return back();
    }

    public function massDestroy(MassDestroyLicRequest $request)
    {
        Lic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lic_create') && Gate::denies('lic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lic();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
