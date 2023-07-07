<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTranseformerRequest;
use App\Http\Requests\StoreTranseformerRequest;
use App\Http\Requests\UpdateTranseformerRequest;
use App\Models\Allnote;
use App\Models\Box;
use App\Models\Cb;
use App\Models\Line;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TranseformerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('transeformer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transeformers = Transeformer::with(['cb_no', 'feeder', 'boxes', 'transe_notes', 'media'])->get();

        $cbs = Cb::get();

        $lines = Line::get();

        $boxes = Box::get();

        $allnotes = Allnote::get();

        return view('admin.transeformers.index', compact('allnotes', 'boxes', 'cbs', 'lines', 'transeformers'));
    }
    
    public function fetchTranse($id)
    {
        abort_if(Gate::denies('transeformer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($id);

        $transeformers = Transeformer::where('id' ,$id)->with(['cb_no', 'feeder', 'boxes', 'transe_notes', 'media'])->get();

        $cbs = Cb::get();

        $lines = Line::get();

        $boxes = Box::get();

        $allnotes = Allnote::get();

        return view('admin.transeformers.index', compact('allnotes', 'boxes', 'cbs', 'lines', 'transeformers'));
    }

    public function create()
    {
        abort_if(Gate::denies('transeformer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb_nos = Cb::pluck('trans_cb_fider_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boxes = Box::pluck('box_number', 'id');

        $transe_notes = Allnote::pluck('t_notes', 'id');

        return view('admin.transeformers.create', compact('boxes', 'cb_nos', 'feeders', 'transe_notes'));
    }

    public function store(StoreTranseformerRequest $request)
    {
        $transeformer = Transeformer::create($request->all());
        $transeformer->boxes()->sync($request->input('boxes', []));
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

        $boxes = Box::pluck('box_number', 'id');

        $transe_notes = Allnote::pluck('t_notes', 'id');

        $transeformer->load('cb_no', 'feeder', 'boxes', 'transe_notes');

        return view('admin.transeformers.edit', compact('boxes', 'cb_nos', 'feeders', 'transe_notes', 'transeformer'));
    }

    public function update(UpdateTranseformerRequest $request, Transeformer $transeformer)
    {
        $transeformer->update($request->all());
        $transeformer->boxes()->sync($request->input('boxes', []));
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

        $transeformer->load('cb_no', 'feeder', 'boxes', 'transe_notes', 'transeCbs', 'transformerBills', 'transBoxBoxes', 'transeferProjects', 'transLines', 'transDiagrams', 'transStations');

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
