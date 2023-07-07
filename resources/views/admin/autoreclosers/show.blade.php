@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.autorecloser.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.autoreclosers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.autorecloser.fields.id') }}
                        </th>
                        <td>
                            {{ $autorecloser->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.autorecloser.fields.auto_recloser_no') }}
                        </th>
                        <td>
                            {{ $autorecloser->auto_recloser_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.autoreclosers.index') }}">
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
            <a class="nav-link" href="#autorecloser_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#auto_closer_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="autorecloser_projects">
            @includeIf('admin.autoreclosers.relationships.autorecloserProjects', ['projects' => $autorecloser->autorecloserProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="auto_closer_stations">
            @includeIf('admin.autoreclosers.relationships.autoCloserStations', ['stations' => $autorecloser->autoCloserStations])
        </div>
    </div>
</div>

@endsection