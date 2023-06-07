<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMinibllerRequest;
use App\Http\Requests\StoreMinibllerRequest;
use App\Http\Requests\UpdateMinibllerRequest;
use App\Models\Cb;
use App\Models\Minibllarnote;
use App\Models\Minibller;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinibllerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('minibller_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Minibller::with(['cb_number', 'minibllar_notes'])->select(sprintf('%s.*', (new Minibller())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'minibller_show';
                $editGate = 'minibller_edit';
                $deleteGate = 'minibller_delete';
                $crudRoutePart = 'minibllers';

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
            $table->addColumn('cb_number_trans_cb_fider_number', function ($row) {
                return $row->cb_number ? $row->cb_number->trans_cb_fider_number : '';
            });

            $table->editColumn('minibller_number', function ($row) {
                return $row->minibller_number ? $row->minibller_number : '';
            });
            $table->editColumn('minibller_x', function ($row) {
                return $row->minibller_x ? $row->minibller_x : '';
            });
            $table->editColumn('minibller_y', function ($row) {
                return $row->minibller_y ? $row->minibller_y : '';
            });
            $table->editColumn('minibller_photo', function ($row) {
                if ($photo = $row->minibller_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('minibllar_notes', function ($row) {
                $labels = [];
                foreach ($row->minibllar_notes as $minibllar_note) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $minibllar_note->notes);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'cb_number', 'minibller_photo', 'minibllar_notes']);

            return $table->make(true);
        }

        $cbs            = Cb::get();
        $minibllarnotes = Minibllarnote::get();

        return view('admin.minibllers.index', compact('cbs', 'minibllarnotes'));
    }

    public function create()
    {
        abort_if(Gate::denies('minibller_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb_numbers = Cb::pluck('trans_cb_fider_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $minibllar_notes = Minibllarnote::pluck('notes', 'id');

        return view('admin.minibllers.create', compact('cb_numbers', 'minibllar_notes'));
    }

    public function store(StoreMinibllerRequest $request)
    {
        $minibller = Minibller::create($request->all());
        $minibller->minibllar_notes()->sync($request->input('minibllar_notes', []));
        if ($request->input('minibller_photo', false)) {
            $minibller->addMedia(storage_path('tmp/uploads/' . basename($request->input('minibller_photo'))))->toMediaCollection('minibller_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minibller->id]);
        }

        return redirect()->route('admin.minibllers.index');
    }

    public function edit(Minibller $minibller)
    {
        abort_if(Gate::denies('minibller_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb_numbers = Cb::pluck('trans_cb_fider_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $minibllar_notes = Minibllarnote::pluck('notes', 'id');

        $minibller->load('cb_number', 'minibllar_notes');

        return view('admin.minibllers.edit', compact('cb_numbers', 'minibllar_notes', 'minibller'));
    }

    public function update(UpdateMinibllerRequest $request, Minibller $minibller)
    {
        $minibller->update($request->all());
        $minibller->minibllar_notes()->sync($request->input('minibllar_notes', []));
        if ($request->input('minibller_photo', false)) {
            if (!$minibller->minibller_photo || $request->input('minibller_photo') !== $minibller->minibller_photo->file_name) {
                if ($minibller->minibller_photo) {
                    $minibller->minibller_photo->delete();
                }
                $minibller->addMedia(storage_path('tmp/uploads/' . basename($request->input('minibller_photo'))))->toMediaCollection('minibller_photo');
            }
        } elseif ($minibller->minibller_photo) {
            $minibller->minibller_photo->delete();
        }

        return redirect()->route('admin.minibllers.index');
    }

    public function show(Minibller $minibller)
    {
        abort_if(Gate::denies('minibller_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minibller->load('cb_number', 'minibllar_notes', 'minibllerNoBoxes');

        return view('admin.minibllers.show', compact('minibller'));
    }

    public function destroy(Minibller $minibller)
    {
        abort_if(Gate::denies('minibller_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minibller->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinibllerRequest $request)
    {
        Minibller::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('minibller_create') && Gate::denies('minibller_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Minibller();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
