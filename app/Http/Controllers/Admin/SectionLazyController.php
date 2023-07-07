<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySectionLazyRequest;
use App\Http\Requests\StoreSectionLazyRequest;
use App\Http\Requests\UpdateSectionLazyRequest;
use App\Models\SectionLazy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionLazyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('section_lazy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sectionLazies = SectionLazy::all();

        return view('admin.sectionLazies.index', compact('sectionLazies'));
    }

    public function create()
    {
        abort_if(Gate::denies('section_lazy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sectionLazies.create');
    }

    public function store(StoreSectionLazyRequest $request)
    {
        $sectionLazy = SectionLazy::create($request->all());

        return redirect()->route('admin.section-lazies.index');
    }

    public function edit(SectionLazy $sectionLazy)
    {
        abort_if(Gate::denies('section_lazy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sectionLazies.edit', compact('sectionLazy'));
    }

    public function update(UpdateSectionLazyRequest $request, SectionLazy $sectionLazy)
    {
        $sectionLazy->update($request->all());

        return redirect()->route('admin.section-lazies.index');
    }

    public function show(SectionLazy $sectionLazy)
    {
        abort_if(Gate::denies('section_lazy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sectionLazy->load('sectionlazyProjects', 'sectionLazyStations');

        return view('admin.sectionLazies.show', compact('sectionLazy'));
    }

    public function destroy(SectionLazy $sectionLazy)
    {
        abort_if(Gate::denies('section_lazy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sectionLazy->delete();

        return back();
    }

    public function massDestroy(MassDestroySectionLazyRequest $request)
    {
        $sectionLazies = SectionLazy::find(request('ids'));

        foreach ($sectionLazies as $sectionLazy) {
            $sectionLazy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
