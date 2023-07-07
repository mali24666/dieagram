@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sectionLazy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.section-lazies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sectionLazy.fields.id') }}
                        </th>
                        <td>
                            {{ $sectionLazy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sectionLazy.fields.section_lazey') }}
                        </th>
                        <td>
                            {{ $sectionLazy->section_lazey }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.section-lazies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#sectionlazy_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#section_lazy_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sectionlazy_projects">
            @includeIf('admin.sectionLazies.relationships.sectionlazyProjects', ['projects' => $sectionLazy->sectionlazyProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="section_lazy_stations">
            @includeIf('admin.sectionLazies.relationships.sectionLazyStations', ['stations' => $sectionLazy->sectionLazyStations])
        </div>
    </div>
</div>

@endsection