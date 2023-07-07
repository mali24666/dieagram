<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRmuRequest;
use App\Http\Requests\StoreRmuRequest;
use App\Http\Requests\UpdateRmuRequest;
use App\Models\Line;
use App\Models\Rmu;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RmuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rmu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmus = Rmu::with(['rmu_feeder', 'created_by'])->get();

        $lines = Line::get();

        $users = User::get();

        return view('admin.rmus.index', compact('lines', 'rmus', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('rmu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmu_feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rmus.create', compact('rmu_feeders'));
    }

    public function store(StoreRmuRequest $request)
    {
        $rmu = Rmu::create($request->all());

        return redirect()->route('admin.rmus.index');
    }

    public function edit(Rmu $rmu)
    {
        abort_if(Gate::denies('rmu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmu_feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rmu->load('rmu_feeder', 'created_by');

        return view('admin.rmus.edit', compact('rmu', 'rmu_feeders'));
    }

    public function update(UpdateRmuRequest $request, Rmu $rmu)
    {
        $rmu->update($request->all());

        return redirect()->route('admin.rmus.index');
    }

    public function show(Rmu $rmu)
    {
        abort_if(Gate::denies('rmu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmu->load('rmu_feeder', 'created_by', 'rmuProjects', 'rmuStations');

        return view('admin.rmus.show', compact('rmu'));
    }

    public function destroy(Rmu $rmu)
    {
        abort_if(Gate::denies('rmu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rmu->delete();

        return back();
    }

    public function massDestroy(MassDestroyRmuRequest $request)
    {
        $rmus = Rmu::find(request('ids'));

        foreach ($rmus as $rmu) {
            $rmu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
