<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBoxRequest;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\UpdateBoxRequest;
use App\Models\Box;
use App\Models\Minibller;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BoxController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('box_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boxes = Box::with(['minibller_no', 'media'])->get();

        $minibllers = Minibller::get();

        return view('admin.boxes.index', compact('boxes', 'minibllers'));
    }

    public function create()
    {
        abort_if(Gate::denies('box_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minibller_nos = Minibller::pluck('minibller_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.boxes.create', compact('minibller_nos'));
    }

    public function store(StoreBoxRequest $request)
    {
        $box = Box::create($request->all());

        foreach ($request->input('box_photo', []) as $file) {
            $box->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('box_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $box->id]);
        }

        return redirect()->route('admin.boxes.index');
    }

    public function edit(Box $box)
    {
        abort_if(Gate::denies('box_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minibller_nos = Minibller::pluck('minibller_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $box->load('minibller_no');

        return view('admin.boxes.edit', compact('box', 'minibller_nos'));
    }

    public function update(UpdateBoxRequest $request, Box $box)
    {
        $box->update($request->all());

        if (count($box->box_photo) > 0) {
            foreach ($box->box_photo as $media) {
                if (!in_array($media->file_name, $request->input('box_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $box->box_photo->pluck('file_name')->toArray();
        foreach ($request->input('box_photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $box->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('box_photo');
            }
        }

        return redirect()->route('admin.boxes.index');
    }

    public function show(Box $box)
    {
        abort_if(Gate::denies('box_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $box->load('minibller_no');

        return view('admin.boxes.show', compact('box'));
    }

    public function destroy(Box $box)
    {
        abort_if(Gate::denies('box_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $box->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoxRequest $request)
    {
        Box::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('box_create') && Gate::denies('box_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Box();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
