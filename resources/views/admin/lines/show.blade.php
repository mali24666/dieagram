@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.line.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.id') }}
                        </th>
                        <td>
                            {{ $line->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.station') }}
                        </th>
                        <td>
                            {{ $line->station->station_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.line_no') }}
                        </th>
                        <td>
                            {{ $line->line_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.trans') }}
                        </th>
                        <td>
                            @foreach($line->trans as $key => $trans)
                                <span class="label label-info">{{ $trans->t_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.line.fields.ct') }}
                        </th>
                        <td>
                            @foreach($line->cts as $key => $ct)
                                <span class="label label-info">{{ $ct->ct_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lines.index') }}">
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
            <a class="nav-link" href="#point1_cts" role="tab" data-toggle="tab">
                {{ trans('cruds.ct.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#point2_cts" role="tab" data-toggle="tab">
                {{ trans('cruds.ct.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#feeder_transeformers" role="tab" data-toggle="tab">
                {{ trans('cruds.transeformer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#feeder_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#rmu_feeder_rmus" role="tab" data-toggle="tab">
                {{ trans('cruds.rmu.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#feeders_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="point1_cts">
            @includeIf('admin.lines.relationships.point1Cts', ['cts' => $line->point1Cts])
        </div>
        <div class="tab-pane" role="tabpanel" id="point2_cts">
            @includeIf('admin.lines.relationships.point2Cts', ['cts' => $line->point2Cts])
        </div>
        <div class="tab-pane" role="tabpanel" id="feeder_transeformers">
            @includeIf('admin.lines.relationships.feederTranseformers', ['transeformers' => $line->feederTranseformers])
        </div>
        <div class="tab-pane" role="tabpanel" id="feeder_projects">
            @includeIf('admin.lines.relationships.feederProjects', ['projects' => $line->feederProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="rmu_feeder_rmus">
            @includeIf('admin.lines.relationships.rmuFeederRmus', ['rmus' => $line->rmuFeederRmus])
        </div>
        <div class="tab-pane" role="tabpanel" id="feeders_stations">
            @includeIf('admin.lines.relationships.feedersStations', ['stations' => $line->feedersStations])
        </div>
    </div>
</div>

@endsection