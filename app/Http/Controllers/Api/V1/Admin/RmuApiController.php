<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRmuRequest;
use App\Http\Requests\UpdateRmuRequest;
use App\Http\Resources\Admin\RmuResource;
use App\Models\Rmu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RmuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rmu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RmuResource(Rmu::with(['rmu_feeder', 'created_by'])->get());
    }

    public function store(StoreRmuRequest $request)
    {
        $rmu = Rmu::create($request->all());

        return (new RmuResource($rmu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rmu $rmu)
    {
        abort_if(Gate::denies('rmu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RmuResource($rmu->load(['rmu_feeder', 'created_by']));
    }

    public function update(UpdateRmuRequest $request, Rmu $rmu)
    {
        $rmu->update($request->all());

        return (new RmuResource($rmu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rmu $rmu)
    {
        abort_if(Gate::denies('rmu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
