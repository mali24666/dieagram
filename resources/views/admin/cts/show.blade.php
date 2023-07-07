@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ct.fields.id') }}
                        </th>
                        <td>
                            {{ $ct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ct.fields.ct_no') }}
                        </th>
                        <td>
                            {{ $ct->ct_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ct.fields.point_1') }}
                        </th>
                        <td>
                            {{ $ct->point_1->line_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ct.fields.point_2') }}
                        </th>
                        <td>
                            {{ $ct->point_2->line_no ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cts.index') }}">
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
            <a class="nav-link" href="#ct_diagrams" role="tab" data-toggle="tab">
                {{ trans('cruds.diagram.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ct_station_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ct_diagrams">
            @includeIf('admin.cts.relationships.ctDiagrams', ['diagrams' => $ct->ctDiagrams])
        </div>
        <div class="tab-pane" role="tabpanel" id="ct_station_stations">
            @includeIf('admin.cts.relationships.ctStationStations', ['stations' => $ct->ctStationStations])
        </div>
    </div>
</div>

@endsection