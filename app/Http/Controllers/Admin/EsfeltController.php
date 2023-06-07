<?php

namespace App\Http\Controllers\Admin;
use App\Events\addToEsfeltEvent;
use App\Events\esfeltFinsh;
use App\Events\stationTranse;
use App\Events\reject;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEsfeltRequest;
use App\Http\Requests\StoreEsfeltRequest;
use App\Http\Requests\UpdateEsfeltRequest;
use App\Models\Esfelt;
use App\Models\Task;
use App\Models\User;
use Gate;
use auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EsfeltController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('esfelt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Esfelt::with(['lics_no', 'eng'])->select(sprintf('%s.*', (new Esfelt())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'esfelt_show';
                $editGate = 'esfelt_edit';
                $deleteGate = 'esfelt_delete';
                $crudRoutePart = 'esfelts';

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
            $table->addColumn('lics_no_name', function ($row) {
                return $row->lics_no ? $row->lics_no->name : '';
            });
            $table->editColumn('end_esfelt_date', function ($row) {
                return $row->end_esfelt_date ? $row->end_esfelt_date : '';
            });
            $table->editColumn('licses', function ($row) {
                if (!$row->licses) {
                    return '';
                }
                $links = [];
                foreach ($row->licses as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('work_done_pic', function ($row) {
                if (!$row->work_done_pic) {
                    return '';
                }
                $links = [];
                foreach ($row->work_done_pic as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Esfelt::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('delivery', function ($row) {
                return $row->delivery ? Esfelt::DELIVERY_SELECT[$row->delivery] : '';
            });
            $table->editColumn('length', function ($row) {
                return $row->length ? $row->length : '';
            });
            $table->editColumn('lengtute', function ($row) {
                return $row->lengtute ? $row->lengtute : '';
            });
            $table->editColumn('check_1', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->check_1 ? 'checked' : null) . '>';
            });
            $table->addColumn('eng_name', function ($row) {
                return $row->eng ? $row->eng->name : '';
            });
// if (Auth::check()==1) {
    // $x=2;
    $table->editColumn('cons', function ($row) {
        return $row->cons ? Esfelt::CONS_SELECT[$row->cons] : '';
    });
// };
            $table->editColumn('esfelt_pic', function ($row) {
                if (!$row->esfelt_pic) {
                    return '';
                }
                $links = [];
                foreach ($row->esfelt_pic as $media) {
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
            $table->editColumn('esfelt_stuts', function ($row) {
                return $row->esfelt_stuts ? Esfelt::ESFELT_STUTS_SELECT[$row->esfelt_stuts] : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });

            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lics_no', 'licses', 'work_done_pic', 'check_1', 'eng', 'esfelt_pic', 'eng_sign']);

            return $table->make(true);
        }

        $tasks = Task::get();
        $users = User::get();

        return view('admin.esfelts.index', compact('tasks', 'users'));
    }
   
    public function create()
    {
        abort_if(Gate::denies('esfelt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $engs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $add= Auth::user();
        return view('admin.esfelts.create', compact('engs', 'lics_nos', 'add'));
    }
    public function add($id)
    {
        abort_if(Gate::denies('esfelt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Task::find($id);

        $engs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $add= Auth::user();
        // dd($lics_nos);

        return view('admin.esfelts.add', compact('engs', 'lics_nos', 'add'));
    }

    public function store(StoreEsfeltRequest $request)
    {
        $esfelt = Esfelt::create($request->all());

        foreach ($request->input('licses', []) as $file) {
            $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('licses');
        }

        foreach ($request->input('work_done_pic', []) as $file) {
            $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('work_done_pic');
        }

        foreach ($request->input('esfelt_pic', []) as $file) {
            $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('esfelt_pic');
        }

        foreach ($request->input('eng_sign', []) as $file) {
            $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('eng_sign');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $esfelt->id]);
        }
        // dd($esfelt);
        event(new addToEsfeltEvent($esfelt ));
        
        return redirect()->route('admin.esfelts.index');
    }

    public function edit(Esfelt $esfelt)
    {
        abort_if(Gate::denies('esfelt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lics_nos = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $id = $lics_nos->id;
        // $lics_nos= Task::find($id);
        $esfelt->load('lics_no', 'eng');
        // dd($esfelt);
        $lics_no_id = $esfelt->lics_no_id;
        // dd($lics_nos);

        return view('admin.esfelts.edit', compact('esfelt', 'lics_nos', 'lics_no_id'));
    }

    public function update(UpdateEsfeltRequest $request, Esfelt $esfelt )
    {      

        $esfelt->update($request->all());
    // lics_no_id
    // $lics_no_id = Task::find($esfelt);

        if (count($esfelt->licses) > 0) {
            foreach ($esfelt->licses as $media) {
                if (!in_array($media->file_name, $request->input('licses', []))) {
                    $media->delete();
                }
            }
        }
        $media = $esfelt->licses->pluck('file_name')->toArray();
        foreach ($request->input('licses', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('licses');
            }
        }

        if (count($esfelt->work_done_pic) > 0) {
            foreach ($esfelt->work_done_pic as $media) {
                if (!in_array($media->file_name, $request->input('work_done_pic', []))) {
                    $media->delete();
                }
            }
        }
        $media = $esfelt->work_done_pic->pluck('file_name')->toArray();
        foreach ($request->input('work_done_pic', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('work_done_pic');
            }
        }

        if (count($esfelt->esfelt_pic) > 0) {
            foreach ($esfelt->esfelt_pic as $media) {
                if (!in_array($media->file_name, $request->input('esfelt_pic', []))) {
                    $media->delete();
                }
            }
        }
        $media = $esfelt->esfelt_pic->pluck('file_name')->toArray();
        foreach ($request->input('esfelt_pic', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('esfelt_pic');
            }
        }

        if (count($esfelt->eng_sign) > 0) {
            foreach ($esfelt->eng_sign as $media) {
                if (!in_array($media->file_name, $request->input('eng_sign', []))) {
                    $media->delete();
                }
            }
        }
        $media = $esfelt->eng_sign->pluck('file_name')->toArray();
        foreach ($request->input('eng_sign', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $esfelt->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('eng_sign');
            }
        }

        // $esfelt_stuts=$request->esfelt_stuts;
        
        // if ($esfelt_stuts==2 && $delivery ==null) {
        //     event(new esfeltFinsh($esfelt ));
        //     event(new stationTranse($esfelt ));

        //     }     
        // if ($esfelt->delivery==2 ) {

        //     }      
        // event(new reject($esfelt ));
        // reject::dispatch($esfelt);
        $lics_no_id = $esfelt->lics_no_id;
        // $lics_nos = Esfelt::find($lics_no_id);

        // dd($lics_nos);

        // event(new reject($lics_no_id));


  return redirect()->route('admin.esfelts.index', compact('lics_no_id') )  ;

    }

    public function show(Esfelt $esfelt)
    {
        abort_if(Gate::denies('esfelt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $esfelt->load('lics_no', 'eng');

        return view('admin.esfelts.show', compact('esfelt'));
    }

    public function destroy(Esfelt $esfelt)
    {
        abort_if(Gate::denies('esfelt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $esfelt->delete();

        return back();
    }

    public function massDestroy(MassDestroyEsfeltRequest $request)
    {
        Esfelt::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('esfelt_create') && Gate::denies('esfelt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Esfelt();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
