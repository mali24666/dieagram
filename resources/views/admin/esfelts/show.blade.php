@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.esfelt.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.esfelts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.id') }}
                        </th>
                        <td>
                            {{ $esfelt->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.lics_no') }}
                        </th>
                        <td>
                            {{ $esfelt->lics_no->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.licses') }}
                        </th>
                        <td>
                            @foreach($esfelt->licses as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.work_done_pic') }}
                        </th>
                        <td>
                            @foreach($esfelt->work_done_pic as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.city') }}
                        </th>
                        <td>
                            {{ $esfelt->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.length') }}
                        </th>
                        <td>
                            {{ $esfelt->length }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.lengtute') }}
                        </th>
                        <td>
                            {{ $esfelt->lengtute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.check_1') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $esfelt->check_1 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.eng') }}
                        </th>
                        <td>
                            {{ $esfelt->eng->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.cons') }}
                        </th>
                        <td>
                            {{ App\Models\Esfelt::CONS_SELECT[$esfelt->cons] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.esfelt_pic') }}
                        </th>
                        <td>
                            @foreach($esfelt->esfelt_pic as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.eng_sign') }}
                        </th>
                        <td>
                            @foreach($esfelt->eng_sign as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.created_at') }}
                        </th>
                        <td>
                            {{ $esfelt->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.esfelt_stuts') }}
                        </th>
                        <td>
                            {{ App\Models\Esfelt::ESFELT_STUTS_SELECT[$esfelt->esfelt_stuts] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.note') }}
                        </th>
                        <td>
                            {{ $esfelt->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.link') }}
                        </th>
                        <td>
                            {{ $esfelt->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Esfelt::TYPE_SELECT[$esfelt->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.delivery') }}
                        </th>
                        <td>
                            {{ App\Models\Esfelt::DELIVERY_SELECT[$esfelt->delivery] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.note') }}
                        </th>
                        <td>
                            {{ $esfelt->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.esfelt.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $esfelt->updated_at }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.esfelts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection