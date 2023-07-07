<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Http\Resources\Admin\StationResource;
use App\Models\Station;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('station_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StationResource(Station::with(['feeders', 'trans', 'box_cosutomers', 'ct_stations', 'rmus', 'auto_closers', 'section_lazies', 'avrs'])->get());
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

        return (new StationResource($station))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Station $station)
    {
        abort_if(Gate::denies('station_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StationResource($station->load(['feeders', 'trans', 'box_cosutomers', 'ct_stations', 'rmus', 'auto_closers', 'section_lazies', 'avrs']));
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

        return (new StationResource($station))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Station $station)
    {
        abort_if(Gate::denies('station_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $station->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
