<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLineRequest;
use App\Http\Requests\StoreLineRequest;
use App\Http\Requests\UpdateLineRequest;
use App\Models\Ct;
use App\Models\Line;
use App\Models\Station;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LineController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lines = Line::with(['station', 'trans', 'cts'])->get();

        $stations = Station::get();

        $transeformers = Transeformer::get();

        $cts = Ct::get();

        return view('admin.lines.index', compact('cts', 'lines', 'stations', 'transeformers'));
    }

    public function fetchfeeder( $line)
    {
        abort_if(Gate::denies('line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            // 
            $lines = Line::where('id' ,$line)->with(['station', 'trans', 'cts'])->get();
            $stations = Station::get();

            $transeformers = Transeformer::get();
    
            $cts = Ct::get();
    
        // $line->load('station', 'trans', 'cts', 'point1Cts', 'point2Cts', 'feederTranseformers', 'feedersStations');
        // dd($lines);
        return view('admin.lines.index', compact('cts', 'lines', 'stations', 'transeformers'));

        // return view('admin.lines.show', compact('line'));
    }

    public function create()
    {
        abort_if(Gate::denies('line_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stations = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trans = Transeformer::pluck('t_no', 'id');

        $cts = Ct::pluck('ct_no', 'id');

        return view('admin.lines.create', compact('cts', 'stations', 'trans'));
    }

    public function store(StoreLineRequest $request)
    {
        $line = Line::create($request->all());
        $line->trans()->sync($request->input('trans', []));
        $line->cts()->sync($request->input('cts', []));

        return redirect()->route('admin.lines.index');
    }

    public function edit(Line $line)
    {
        abort_if(Gate::denies('line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stations = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trans = Transeformer::pluck('t_no', 'id');

        $cts = Ct::pluck('ct_no', 'id');

        $line->load('station', 'trans', 'cts');

        return view('admin.lines.edit', compact('cts', 'line', 'stations', 'trans'));
    }

    public function update(UpdateLineRequest $request, Line $line)
    {
        $line->update($request->all());
        $line->trans()->sync($request->input('trans', []));
        $line->cts()->sync($request->input('cts', []));

        return redirect()->route('admin.lines.index');
    }

    public function show(Line $line)
    {
        abort_if(Gate::denies('line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $line->load('station', 'trans', 'cts', 'point1Cts', 'point2Cts', 'feederTranseformers', 'feederProjects', 'rmuFeederRmus', 'feedersStations');

        return view('admin.lines.show', compact('line'));
    }

    public function destroy(Line $line)
    {
        abort_if(Gate::denies('line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $line->delete();

        return back();
    }

    public function massDestroy(MassDestroyLineRequest $request)
    {
        $lines = Line::find(request('ids'));

        foreach ($lines as $line) {
            $line->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
