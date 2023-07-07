<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAvrRequest;
use App\Http\Requests\StoreAvrRequest;
use App\Http\Requests\UpdateAvrRequest;
use App\Models\Avr;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvrController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('avr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $avrs = Avr::all();

        return view('admin.avrs.index', compact('avrs'));
    }

    public function create()
    {
        abort_if(Gate::denies('avr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.avrs.create');
    }

    public function store(StoreAvrRequest $request)
    {
        $avr = Avr::create($request->all());

        return redirect()->route('admin.avrs.index');
    }

    public function edit(Avr $avr)
    {
        abort_if(Gate::denies('avr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.avrs.edit', compact('avr'));
    }

    public function update(UpdateAvrRequest $request, Avr $avr)
    {
        $avr->update($request->all());

        return redirect()->route('admin.avrs.index');
    }

    public function show(Avr $avr)
    {
        abort_if(Gate::denies('avr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $avr->load('avrProjects', 'avrStations');

        return view('admin.avrs.show', compact('avr'));
    }

    public function destroy(Avr $avr)
    {
        abort_if(Gate::denies('avr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $avr->delete();

        return back();
    }

    public function massDestroy(MassDestroyAvrRequest $request)
    {
        $avrs = Avr::find(request('ids'));

        foreach ($avrs as $avr) {
            $avr->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
