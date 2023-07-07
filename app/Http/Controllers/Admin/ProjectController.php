<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Autorecloser;
use App\Models\Avr;
use App\Models\Ct;
use App\Models\Line;
use App\Models\Project;
use App\Models\Rmu;
use App\Models\SectionLazy;
use App\Models\Station;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::with(['name', 'transefer', 'feeder', 'ct', 'rmu', 'autorecloser', 'sectionlazy', 'avr'])->get();

        $stations = Station::get();

        $transeformers = Transeformer::get();

        $lines = Line::get();

        $cts = Ct::get();

        $rmus = Rmu::get();

        $autoreclosers = Autorecloser::get();

        $section_lazies = SectionLazy::get();

        $avrs = Avr::get();

        return view('admin.projects.index', compact('autoreclosers', 'avrs', 'cts', 'lines', 'projects', 'rmus', 'section_lazies', 'stations', 'transeformers'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transefers = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cts = Ct::pluck('ct_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rmus = Rmu::pluck('rmu_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $autoreclosers = Autorecloser::pluck('auto_recloser_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sectionlazies = SectionLazy::pluck('section_lazey', 'id')->prepend(trans('global.pleaseSelect'), '');

        $avrs = Avr::pluck('avr_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.projects.create', compact('autoreclosers', 'avrs', 'cts', 'feeders', 'names', 'rmus', 'sectionlazies', 'transefers'));
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Station::pluck('station_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transefers = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feeders = Line::pluck('line_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cts = Ct::pluck('ct_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rmus = Rmu::pluck('rmu_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $autoreclosers = Autorecloser::pluck('auto_recloser_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sectionlazies = SectionLazy::pluck('section_lazey', 'id')->prepend(trans('global.pleaseSelect'), '');

        $avrs = Avr::pluck('avr_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project->load('name', 'transefer', 'feeder', 'ct', 'rmu', 'autorecloser', 'sectionlazy', 'avr');

        return view('admin.projects.edit', compact('autoreclosers', 'avrs', 'cts', 'feeders', 'names', 'project', 'rmus', 'sectionlazies', 'transefers'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->route('admin.projects.index');
    }

    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->load('name', 'transefer', 'feeder', 'ct', 'rmu', 'autorecloser', 'sectionlazy', 'avr');

        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectRequest $request)
    {
        $projects = Project::find(request('ids'));

        foreach ($projects as $project) {
            $project->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
