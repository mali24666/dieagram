@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rmu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rmus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rmu.fields.id') }}
                        </th>
                        <td>
                            {{ $rmu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rmu.fields.rmu_no') }}
                        </th>
                        <td>
                            {{ $rmu->rmu_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rmu.fields.rmu_feeder') }}
                        </th>
                        <td>
                            {{ $rmu->rmu_feeder->line_no ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rmus.index') }}">
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
            <a class="nav-link" href="#rmu_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#rmu_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="rmu_projects">
            @includeIf('admin.rmus.relationships.rmuProjects', ['projects' => $rmu->rmuProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="rmu_stations">
            @includeIf('admin.rmus.relationships.rmuStations', ['stations' => $rmu->rmuStations])
        </div>
    </div>
</div>

@endsection