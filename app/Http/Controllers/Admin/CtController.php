<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCtRequest;
use App\Http\Requests\StoreCtRequest;
use App\Http\Requests\UpdateCtRequest;
use App\Models\Ct;
use App\Models\Line;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CtController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ct_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ct::with(['point_1', 'point_2'])->select(sprintf('%s.*', (new Ct)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ct_show';
                $editGate      = 'ct_edit';
                $deleteGate    = 'ct_delete';
                $crudRoutePart = 'cts';

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
            $table->editColumn('ct_no', function ($row) {
                return $row->ct_no ? $row->ct_no : '';
            });
            $table->addColumn('point_1_line_no', function ($row) {
                return $row->point_1 ? $row->point_1->line_no : '';
            });

            $table->addColumn('point_2_line_no', function ($row) {
                return $row->point_2 ? $row->point_2->line_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'point_1', 'point_2']);

            return $table->make(true);
        }

        $lines = Line::get();

        return view('admin.cts.index', compact('lines'));
    }
    public function fetchCt(request $request)
    { 
        // dd($request);
        abort_if(Gate::denies('ct_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = $request->id;
        // dd($id);
        if ($request->ajax()) {
            $query = Ct::where('id' ,$id)->with(['point_1', 'point_2'])->select(sprintf('%s.*', (new Ct)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ct_show';
                $editGate      = 'ct_edit';
                $deleteGate    = 'ct_delete';
                $crudRoutePart = 'cts';

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
            $table->editColumn('ct_no', function ($row) {
                return $row->ct_no ? $row->ct_no : '';
            });
            $table->addColumn('point_1_line_no', function ($row) {
                return $row->point_1 ? $row->point_1->line_no : '';
            });

            $table->addColumn('point_2_line_no', function ($row) {
                return $row->point_2 ? $row->point_2->line_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'point_1', 'point_2']);

            return $table->make(true);
        }

        $lines = Line::get();

        return view('admin.cts.index', compact('lines'));
    }

    public function create()
    {
        abort_if(Gate::denies('ct_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_1s = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point_2s = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cts.create', compact('point_1s', 'point_2s'));
    }

    public function store(StoreCtRequest $request)
    {
        $ct = Ct::create($request->all());

        return redirect()->route('admin.cts.index');
    }

    public function edit(Ct $ct)
    {
        abort_if(Gate::denies('ct_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_1s = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point_2s = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ct->load('point_1', 'point_2');

        return view('admin.cts.edit', compact('ct', 'point_1s', 'point_2s'));
    }

    public function update(UpdateCtRequest $request, Ct $ct)
    {
        $ct->update($request->all());

        return redirect()->route('admin.cts.index');
    }

    public function show(Ct $ct)
    {
        abort_if(Gate::denies('ct_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ct->load('point_1', 'point_2', 'ctDiagrams', 'ctStationStations');

        return view('admin.cts.show', compact('ct'));
    }

    public function destroy(Ct $ct)
    {
        abort_if(Gate::denies('ct_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ct->delete();

        return back();
    }

    public function massDestroy(MassDestroyCtRequest $request)
    {
        $cts = Ct::find(request('ids'));

        foreach ($cts as $ct) {
            $ct->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
