<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStationRequest;
use App\Http\Requests\StoreStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Models\Autorecloser;
use App\Models\Avr;
use App\Models\Box;
use App\Models\Ct;
use App\Models\Line;
use App\Models\Rmu;
use App\Models\SectionLazy;
use App\Models\Station;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('station_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stations = Station::with(['feeders', 'trans', 'box_cosutomers', 'ct_stations', 'rmus', 'auto_closers', 'section_lazies', 'avrs'])->get();

        $lines = Line::get();

        $transeformers = Transeformer::get();

        $boxes = Box::get();

        $cts = Ct::get();

        $rmus = Rmu::get();

        $autoreclosers = Autorecloser::get();

        $section_lazies = SectionLazy::get();

        $avrs = Avr::get();

        return view('admin.stations.index', compact('autoreclosers', 'avrs', 'boxes', 'cts', 'lines', 'rmus', 'section_lazies', 'stations', 'transeformers'));
    }

    public function create()
    {
        abort_if(Gate::denies('station_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeders = Line::pluck('line_no', 'id');

        $trans = Transeformer::pluck('t_no', 'id');

        $box_cosutomers = Box::pluck('box_number', 'id');

        $ct_stations = Ct::pluck('ct_no', 'id');

        $rmus = Rmu::pluck('rmu_no', 'id');

        $auto_closers = Autorecloser::pluck('auto_recloser_no', 'id');

        $section_lazies = SectionLazy::pluck('section_lazey', 'id');

        $avrs = Avr::pluck('avr_no', 'id');

        return view('admin.stations.create', compact('auto_closers', 'avrs', 'box_cosutomers', 'ct_stations', 'feeders', 'rmus', 'section_lazies', 'trans'));
    }

    public function store(StoreStationRequest $request)
    {
        $station = Station::create($request->all());
        $station->feeders()->sync($request->input('feeders', []));
        $station->trans()->sync($request->input('trans', []));
        $station->box_cosutomers()->sync($request->input('box_cosutomers', []));
        $station->ct_stations()->sync($request->input('ct_stations', []));
        $station->rmus()->sync($request->input('rmus', []));
        $station->auto_closers()->sync($request->input('auto_closers', []));
        $station->section_lazies()->sync($request->input('section_lazies', []));
        $station->avrs()->sync($request->input('avrs', []));

        return redirect()->route('admin.stations.index');
    }

    public function edit(Station $station)
    {
        abort_if(Gate::denies('station_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeders = Line::pluck('line_no', 'id');

        $trans = Transeformer::pluck('t_no', 'id');

        $box_cosutomers = Box::pluck('box_number', 'id');

        $ct_stations = Ct::pluck('ct_no', 'id');

        $rmus = Rmu::pluck('rmu_no', 'id');

        $auto_closers = Autorecloser::pluck('auto_recloser_no', 'id');

        $section_lazies = SectionLazy::pluck('section_lazey', 'id');

        $avrs = Avr::pluck('avr_no', 'id');

        $station->load('feeders', 'trans', 'box_cosutomers', 'ct_stations', 'rmus', 'auto_closers', 'section_lazies', 'avrs');

        return view('admin.stations.edit', compact('auto_closers', 'avrs', 'box_cosutomers', 'ct_stations', 'feeders', 'rmus', 'section_lazies', 'station', 'trans'));
    }

    public function update(UpdateStationRequest $request, Station $station)
    {
        $station->update($request->all());
        $station->feeders()->sync($request->input('feeders', []));
        $station->trans()->sync($request->input('trans', []));
        $station->box_cosutomers()->sync($request->input('box_cosutomers', []));
        $station->ct_stations()->sync($request->input('ct_stations', []));
        $station->rmus()->sync($request->input('rmus', []));
        $station->auto_closers()->sync($request->input('auto_closers', []));
        $station->section_lazies()->sync($request->input('section_lazies', []));
        $station->avrs()->sync($request->input('avrs', []));

        return redirect()->route('admin.stations.index');
    }

    public function show(Station $station)
    {
        abort_if(Gate::denies('station_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $station->load('feeders', 'trans', 'box_cosutomers', 'ct_stations', 'rmus', 'auto_closers', 'section_lazies', 'avrs', 'stationDiagrams', 'stationLines', 'nameProjects', 'feederDiagrams');

        return view('admin.stations.show', compact('station'));
    }

    public function destroy(Station $station)
    {
        abort_if(Gate::denies('station_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $station->delete();

        return back();
    }

    public function massDestroy(MassDestroyStationRequest $request)
    {
        $stations = Station::find(request('ids'));

        foreach ($stations as $station) {
            $station->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
