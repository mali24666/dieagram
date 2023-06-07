<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTranseformerRequest;
use App\Http\Requests\StoreTranseformerRequest;
use App\Http\Requests\UpdateTranseformerRequest;
use App\Models\Allnote;
use App\Models\Cb;
use App\Models\Line;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TranseformerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transeformer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transeformer::with(['cb_no', 'feeder', 'transe_notes'])->select(sprintf('%s.*', (new Transeformer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transeformer_show';
                $editGate      = 'transeformer_edit';
                $deleteGate    = 'transeformer_delete';
                $crudRoutePart = 'transeformers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('t_no', function ($row) {
                return $row->t_no ? $row->t_no : '';
            });
            $table->editColumn('picture_befor', function ($row) {
                if (! $row->picture_befor) {
                    return '';
                }
                $links = [];
                foreach ($row->picture_befor as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->addColumn('cb_no_trans_cb_fider_number', function ($row) {
                return $row->cb_no ? $row->cb_no->trans_cb_fider_number : '';
            });

            $table->addColumn('feeder_line_no', function ($row) {
                return $row->feeder ? $row->feeder->line_no : '';
            });

            $table->editColumn('transe_note', function ($row) {
                $labels = [];
                foreach ($row->transe_notes as $transe_note) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $transe_note->t_notes);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'picture_befor', 'cb_no', 'feeder', 'transe_note']);

            return $table->make(true);
        }

        $cbs      = Cb::get();
        $lines    = Line::get();
        $allnotes = Allnote::get();

        return view('admin.transeformers.index', compact('cbs', 'lines', 'allnotes'));
    }

    public function create()
    {
        abort_if(Gate::denies('transeformer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb_nos = Cb::pluck('trans_cb_fider_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transe_notes = Allnote::pluck('t_notes', 'id');

        return view('admin.transeformers.create', compact('cb_nos', 'feeders', 'transe_notes'));
    }

    public function store(StoreTranseformerRequest $request)
    {
        $transeformer = Transeformer::create($request->all());
        $transeformer->transe_notes()->sync($request->input('transe_notes', []));
        foreach ($request->input('picture_befor', []) as $file) {
            $transeformer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('picture_befor');
        }

        foreach ($request->input('photo_after', []) as $file) {
            $transeformer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_after');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transeformer->id]);
        }

        return redirect()->route('admin.transeformers.index');
    }

    public function edit(Transeformer $transeformer)
    {
        abort_if(Gate::denies('transeformer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb_nos = Cb::pluck('trans_cb_fider_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transe_notes = Allnote::pluck('t_notes', 'id');

        $transeformer->load('cb_no', 'feeder', 'transe_notes');

        return view('admin.transeformers.edit', compact('cb_nos', 'feeders', 'transe_notes', 'transeformer'));
    }

    public function update(UpdateTranseformerRequest $request, Transeformer $transeformer)
    {
        $transeformer->update($request->all());
        $transeformer->transe_notes()->sync($request->input('transe_notes', []));
        if (count($transeformer->picture_befor) > 0) {
            foreach ($transeformer->picture_befor as $media) {
                if (! in_array($media->file_name, $request->input('picture_befor', []))) {
                    $media->delete();
                }
            }
        }
        $media = $transeformer->picture_befor->pluck('file_name')->toArray();
        foreach ($request->input('picture_befor', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $transeformer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('picture_befor');
            }
        }

        if (count($transeformer->photo_after) > 0) {
            foreach ($transeformer->photo_after as $media) {
                if (! in_array($media->file_name, $request->input('photo_after', []))) {
                    $media->delete();
                }
            }
        }
        $media = $transeformer->photo_after->pluck('file_name')->toArray();
        foreach ($request->input('photo_after', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $transeformer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_after');
            }
        }

        return redirect()->route('admin.transeformers.index');
    }

    public function show(Transeformer $transeformer)
    {
        abort_if(Gate::denies('transeformer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transeformer->load('cb_no', 'feeder', 'transe_notes', 'transeCbs', 'transformerBills', 'transLines', 'transDiagrams');

        return view('admin.transeformers.show', compact('transeformer'));
    }

    public function destroy(Transeformer $transeformer)
    {
        abort_if(Gate::denies('transeformer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transeformer->delete();

        return back();
    }

    public function massDestroy(MassDestroyTranseformerRequest $request)
    {
        $transeformers = Transeformer::find(request('ids'));

        foreach ($transeformers as $transeformer) {
            $transeformer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transeformer_create') && Gate::denies('transeformer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Transeformer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
