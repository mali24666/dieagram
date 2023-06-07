@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.station.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.id') }}
                        </th>
                        <td>
                            {{ $station->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.station_no') }}
                        </th>
                        <td>
                            {{ $station->station_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.location') }}
                        </th>
                        <td>
                            {{ $station->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.feeders') }}
                        </th>
                        <td>
                            @foreach($station->feeders as $key => $feeders)
                                <span class="label label-info">{{ $feeders->line_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stations.index') }}">
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
            <a class="nav-link" href="#station_diagrams" role="tab" data-toggle="tab">
                {{ trans('cruds.diagram.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#station_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.line.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#feeder_diagrams" role="tab" data-toggle="tab">
                {{ trans('cruds.diagram.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="station_diagrams">
            @includeIf('admin.stations.relationships.stationDiagrams', ['diagrams' => $station->stationDiagrams])
        </div>
        <div class="tab-pane" role="tabpanel" id="station_lines">
            @includeIf('admin.stations.relationships.stationLines', ['lines' => $station->stationLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="feeder_diagrams">
            @includeIf('admin.stations.relationships.feederDiagrams', ['diagrams' => $station->feederDiagrams])
        </div>
    </div>
</div>

@endsection