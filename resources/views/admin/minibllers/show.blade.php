@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.minibller.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minibllers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.id') }}
                        </th>
                        <td>
                            {{ $minibller->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.cb_number') }}
                        </th>
                        <td>
                            {{ $minibller->cb_number->trans_cb_fider_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.minibller_number') }}
                        </th>
                        <td>
                            {{ $minibller->minibller_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.minibller_x') }}
                        </th>
                        <td>
                            {{ $minibller->minibller_x }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.minibller_y') }}
                        </th>
                        <td>
                            {{ $minibller->minibller_y }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.minibller_photo') }}
                        </th>
                        <td>
                            @if($minibller->minibller_photo)
                                <a href="{{ $minibller->minibller_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $minibller->minibller_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.minibllar_notes') }}
                        </th>
                        <td>
                            @foreach($minibller->minibllar_notes as $key => $minibllar_notes)
                                <span class="label label-info">{{ $minibllar_notes->notes }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.longitude') }}
                        </th>
                        <td>
                            {{ $minibller->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibller.fields.latitude') }}
                        </th>
                        <td>
                            {{ $minibller->latitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minibllers.index') }}">
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
            <a class="nav-link" href="#minibller_no_boxes" role="tab" data-toggle="tab">
                {{ trans('cruds.box.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="minibller_no_boxes">
            @includeIf('admin.minibllers.relationships.minibllerNoBoxes', ['boxes' => $minibller->minibllerNoBoxes])
        </div>
    </div>
</div>

@endsection