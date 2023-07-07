<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCbRequest;
use App\Http\Requests\StoreCbRequest;
use App\Http\Requests\UpdateCbRequest;
use App\Models\Cb;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CbController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cb_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cbs = Cb::with(['transe'])->get();

        $transeformers = Transeformer::get();

        return view('admin.cbs.index', compact('cbs', 'transeformers'));
    }

    public function create()
    {
        abort_if(Gate::denies('cb_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transes = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cbs.create', compact('transes'));
    }

    public function store(StoreCbRequest $request)
    {
        $cb = Cb::create($request->all());

        return redirect()->route('admin.cbs.index');
    }

    public function edit(Cb $cb)
    {
        abort_if(Gate::denies('cb_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transes = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cb->load('transe');

        return view('admin.cbs.edit', compact('cb', 'transes'));
    }

    public function update(UpdateCbRequest $request, Cb $cb)
    {
        $cb->update($request->all());

        return redirect()->route('admin.cbs.index');
    }

    public function show(Cb $cb)
    {
        abort_if(Gate::denies('cb_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb->load('transe', 'cbNumberMinibllers', 'minibllerNoBoxes', 'cbNoTranseformers');

        return view('admin.cbs.show', compact('cb'));
    }

    public function destroy(Cb $cb)
    {
        abort_if(Gate::denies('cb_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cb->delete();

        return back();
    }

    public function massDestroy(MassDestroyCbRequest $request)
    {
        $cbs = Cb::find(request('ids'));

        foreach ($cbs as $cb) {
            $cb->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
