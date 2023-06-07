<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDiagramRequest;
use App\Http\Requests\StoreDiagramRequest;
use App\Http\Requests\UpdateDiagramRequest;
use App\Models\Ct;
use App\Models\Diagram;
use App\Models\Station;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiagramController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('diagram_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagrams = Diagram::with(['station', 'feeders', 'cts', 'trans'])->get();

        return view('admin.diagrams.index', compact('diagrams'));
    }

    public function create()
    {
        abort_if(Gate::denies('diagram_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stations = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Station::pluck('station_no', 'id');

        $cts = Ct::pluck('ct_no', 'id');

        $trans = Transeformer::pluck('t_no', 'id');

        return view('admin.diagrams.create', compact('cts', 'feeders', 'stations', 'trans'));
    }

    public function store(StoreDiagramRequest $request)
    {
        $diagram = Diagram::create($request->all());
        $diagram->feeders()->sync($request->input('feeders', []));
        $diagram->cts()->sync($request->input('cts', []));
        $diagram->trans()->sync($request->input('trans', []));

        return redirect()->route('admin.diagrams.index');
    }

    public function edit(Diagram $diagram)
    {
        abort_if(Gate::denies('diagram_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stations = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Station::pluck('station_no', 'id');

        $cts = Ct::pluck('ct_no', 'id');

        $trans = Transeformer::pluck('t_no', 'id');

        $diagram->load('station', 'feeders', 'cts', 'trans');

        return view('admin.diagrams.edit', compact('cts', 'diagram', 'feeders', 'stations', 'trans'));
    }

    public function update(UpdateDiagramRequest $request, Diagram $diagram)
    {
        $diagram->update($request->all());
        $diagram->feeders()->sync($request->input('feeders', []));
        $diagram->cts()->sync($request->input('cts', []));
        $diagram->trans()->sync($request->input('trans', []));

        return redirect()->route('admin.diagrams.index');
    }

    public function show(Diagram $diagram)
    {
        abort_if(Gate::denies('diagram_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagram->load('station', 'feeders', 'cts', 'trans');

        return view('admin.diagrams.show', compact('diagram'));
    }

    public function destroy(Diagram $diagram)
    {
        abort_if(Gate::denies('diagram_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagram->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiagramRequest $request)
    {
        $diagrams = Diagram::find(request('ids'));

        foreach ($diagrams as $diagram) {
            $diagram->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
