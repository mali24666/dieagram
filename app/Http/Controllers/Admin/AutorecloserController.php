<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAutorecloserRequest;
use App\Http\Requests\StoreAutorecloserRequest;
use App\Http\Requests\UpdateAutorecloserRequest;
use App\Models\Autorecloser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutorecloserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('autorecloser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $autoreclosers = Autorecloser::all();

        return view('admin.autoreclosers.index', compact('autoreclosers'));
    }

    public function create()
    {
        abort_if(Gate::denies('autorecloser_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.autoreclosers.create');
    }

    public function store(StoreAutorecloserRequest $request)
    {
        $autorecloser = Autorecloser::create($request->all());

        return redirect()->route('admin.autoreclosers.index');
    }

    public function edit(Autorecloser $autorecloser)
    {
        abort_if(Gate::denies('autorecloser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.autoreclosers.edit', compact('autorecloser'));
    }

    public function update(UpdateAutorecloserRequest $request, Autorecloser $autorecloser)
    {
        $autorecloser->update($request->all());

        return redirect()->route('admin.autoreclosers.index');
    }

    public function show(Autorecloser $autorecloser)
    {
        abort_if(Gate::denies('autorecloser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $autorecloser->load('autorecloserProjects', 'autoCloserStations');

        return view('admin.autoreclosers.show', compact('autorecloser'));
    }

    public function destroy(Autorecloser $autorecloser)
    {
        abort_if(Gate::denies('autorecloser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $autorecloser->delete();

        return back();
    }

    public function massDestroy(MassDestroyAutorecloserRequest $request)
    {
        $autoreclosers = Autorecloser::find(request('ids'));

        foreach ($autoreclosers as $autorecloser) {
            $autorecloser->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
