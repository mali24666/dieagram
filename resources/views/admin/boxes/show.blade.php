@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.box.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boxes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.id') }}
                        </th>
                        <td>
                            {{ $box->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.minibller_no') }}
                        </th>
                        <td>
                            {{ $box->minibller_no->trans_cb_fider_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.box_number') }}
                        </th>
                        <td>
                            {{ $box->box_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.box_type') }}
                        </th>
                        <td>
                            {{ App\Models\Box::BOX_TYPE_SELECT[$box->box_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.box_location') }}
                        </th>
                        <td>
                            {{ $box->box_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.box_notes') }}
                        </th>
                        <td>
                            {{ App\Models\Box::BOX_NOTES_SELECT[$box->box_notes] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.box_photo') }}
                        </th>
                        <td>
                            @foreach($box->box_photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.box.fields.trans_box') }}
                        </th>
                        <td>
                            {{ $box->trans_box->t_no ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boxes.index') }}">
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
            <a class="nav-link" href="#box_cosutomer_stations" role="tab" data-toggle="tab">
                {{ trans('cruds.station.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="box_cosutomer_stations">
            @includeIf('admin.boxes.relationships.boxCosutomerStations', ['stations' => $box->boxCosutomerStations])
        </div>
    </div>
</div>

@endsection