<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStationRequest;
use App\Http\Requests\StoreStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Models\Line;
use App\Models\Station;
use App\Models\Transeformer;


use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('station_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Station::with(['Transeformers','feeders'])->select(sprintf('%s.*', (new Station)->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'station_show';
                $editGate      = 'station_edit';
                $deleteGate    = 'station_delete';
                $crudRoutePart = 'stations';

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
            $table->editColumn('station_no', function ($row) {
                return $row->station_no ? $row->station_no : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
     
        $table->editColumn('feeders', function ($row) {
            $labels = [];
            foreach ($row->feeders as $feeders) {
                $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $feeders->line_no);
            }

            return implode(' ', $labels);
        });
        $table->editColumn('feeders', function ($row) {
            $labels = [];
            foreach ($row->feeders ->Transeformers as $feeders) {
                $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $feeders->t_no);
            }

            return implode(' ', $labels);
        });


            // $table->editColumn('Transeformers', function ($row) {
            //     $labels = [];
            //     foreach ($row->Transeformers as $Transeformers) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $Transeformers->t_no);
            //     }

            //     return implode(' ', $labels);

            $table->rawColumns(['actions', 'placeholder', 'Transeformers', 'feeders']);

            return $table->make(true);
        }

        $lines = Line::get();
        // $Station = Station::get();
        // $trans = $Station->Transeformer;
        // $trans = $Transeformer();
// dd( $trans);
// foreach ($trans->Transeformers as $Transeformers) {
//     $trans[] = sprintf('<span class="label label-info label-many">%s</span>', $Transeformers->t_no);
// }

        return view('admin.stations.index', compact('lines'));
    }

    public function create()
    {
        abort_if(Gate::denies('station_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeders = Line::pluck('line_no', 'id');

        return view('admin.stations.create', compact('feeders'));
    }

    public function store(StoreStationRequest $request)
    {
        $station = Station::create($request->all());
        $station->feeders()->sync($request->input('feeders', []));

        return redirect()->route('admin.stations.index');
    }

    public function edit(Station $station)
    {
        abort_if(Gate::denies('station_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feeders = Line::pluck('line_no', 'id');

        $station->load('feeders');

        return view('admin.stations.edit', compact('feeders', 'station'));
    }

    public function update(UpdateStationRequest $request, Station $station)
    {
        $station->update($request->all());
        $station->feeders()->sync($request->input('feeders', []));

        return redirect()->route('admin.stations.index');
    }

    public function show(Station $station)
    {
        abort_if(Gate::denies('station_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $station->load('feeders', 'stationDiagrams', 'stationLines', 'feederDiagrams');

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
