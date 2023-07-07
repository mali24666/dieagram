<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCtRequest;
use App\Http\Requests\UpdateCtRequest;
use App\Http\Resources\Admin\CtResource;
use App\Models\Ct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CtApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ct_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CtResource(Ct::with(['point_1', 'point_2'])->get());
    }

    public function store(StoreCtRequest $request)
    {
        $ct = Ct::create($request->all());

        return (new CtResource($ct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ct $ct)
    {
        abort_if(Gate::denies('ct_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CtResource($ct->load(['point_1', 'point_2']));
    }

    public function update(UpdateCtRequest $request, Ct $ct)
    {
        $ct->update($request->all());

        return (new CtResource($ct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ct $ct)
    {
        abort_if(Gate::denies('ct_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
