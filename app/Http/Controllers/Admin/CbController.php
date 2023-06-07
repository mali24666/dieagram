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
use Yajra\DataTables\Facades\DataTables;

class CbController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cb_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Cb::with(['transe'])->select(sprintf('%s.*', (new Cb())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cb_show';
                $editGate = 'cb_edit';
                $deleteGate = 'cb_delete';
                $crudRoutePart = 'cbs';

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
            $table->addColumn('transe_t_no', function ($row) {
                return $row->transe ? $row->transe->t_no : '';
            });

            $table->editColumn('trans_cb_fider_number', function ($row) {
                return $row->trans_cb_fider_number ? $row->trans_cb_fider_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'transe']);

            return $table->make(true);
        }

        $transeformers = Transeformer::get();

        return view('admin.cbs.index', compact('transeformers'));
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

        $cb->load('transe', 'cbNumberMinibllers', 'cbNoTranseformers');

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
        Cb::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
