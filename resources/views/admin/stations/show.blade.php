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
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.trans') }}
                        </th>
                        <td>
                            @foreach($station->trans as $key => $trans)
                                <span class="label label-info">{{ $trans->t_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.box_cosutomer') }}
                        </th>
                        <td>
                            @foreach($station->box_cosutomers as $key => $box_cosutomer)
                                <span class="label label-info">{{ $box_cosutomer->box_number }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.ct_station') }}
                        </th>
                        <td>
                            @foreach($station->ct_stations as $key => $ct_station)
                                <span class="label label-info">{{ $ct_station->ct_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.rmu') }}
                        </th>
                        <td>
                            @foreach($station->rmus as $key => $rmu)
                                <span class="label label-info">{{ $rmu->rmu_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.auto_closer') }}
                        </th>
                        <td>
                            @foreach($station->auto_closers as $key => $auto_closer)
                                <span class="label label-info">{{ $auto_closer->auto_recloser_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.section_lazy') }}
                        </th>
                        <td>
                            @foreach($station->section_lazies as $key => $section_lazy)
                                <span class="label label-info">{{ $section_lazy->section_lazey }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.station.fields.avr') }}
                        </th>
                        <td>
                            @foreach($station->avrs as $key => $avr)
                                <span class="label label-info">{{ $avr->avr_no }}</span>
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
            <a class="nav-link" href="#name_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
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
        <div class="tab-pane" role="tabpanel" id="name_projects">
            @includeIf('admin.stations.relationships.nameProjects', ['projects' => $station->nameProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="feeder_diagrams">
            @includeIf('admin.stations.relationships.feederDiagrams', ['diagrams' => $station->feederDiagrams])
        </div>
    </div>
</div>

@endsection