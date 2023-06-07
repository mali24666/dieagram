@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.id') }}
                        </th>
                        <td>
                            {{ $lic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.created_at') }}
                        </th>
                        <td>
                            {{ $lic->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.department') }}
                        </th>
                        <td>
                            {{ App\Models\Lic::DEPARTMENT_SELECT[$lic->department] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.license_no') }}
                        </th>
                        <td>
                            {{ $lic->license_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.esnad') }}
                        </th>
                        <td>
                            {{ $lic->esnad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.datestary') }}
                        </th>
                        <td>
                            {{ $lic->datestary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.date_end') }}
                        </th>
                        <td>
                            {{ $lic->date_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.city') }}
                        </th>
                        <td>
                            {{ $lic->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.longtude') }}
                        </th>
                        <td>
                            {{ $lic->longtude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.path') }}
                        </th>
                        <td>
                            @foreach($lic->path as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.license_pic') }}
                        </th>
                        <td>
                            @foreach($lic->license_pic as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.stuts') }}
                        </th>
                        <td>
                            {{ App\Models\Lic::STUTS_SELECT[$lic->stuts] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.e_length') }}
                        </th>
                        <td>
                            {{ $lic->e_length }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.t_length') }}
                        </th>
                        <td>
                            {{ $lic->t_length }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.wide') }}
                        </th>
                        <td>
                            {{ $lic->wide }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.deep') }}
                        </th>
                        <td>
                            {{ $lic->deep }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.created_by') }}
                        </th>
                        <td>
                            {{ $lic->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            مدير الفرع        
                        </th>
                        <td>
                            {{ $lic->head_eng->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           حالة الموافقة علي الطلب 
                        </th>
                        <td>
                            {{ App\Models\Lic::eng_check[$lic->eng_check] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.order_stauts') }}
                        </th>
                        <td>
                            {{ App\Models\Lic::ORDER_STAUTS_SELECT[$lic->order_stauts] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.order_pic') }}
                        </th>
                        <td>
                            @foreach($lic->order_pic as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.order_reject') }}
                        </th>
                        <td>
                            @foreach($lic->order_reject as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.user') }}
                        </th>
                        <td>
                            {{ $lic->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lic.fields.licses_number') }}
                        </th>
                        <td>
                            {{ $lic->licses_number->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lics.index') }}">
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
            <a class="nav-link" href="#lics_no_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lics_no_tasks">
            @includeIf('admin.lics.relationships.licsNoTasks', ['tasks' => $lic->licsNoTasks])
        </div>
    </div>
</div>
<div class="form-group">
    <a class="btn btn-success" href="{{ route('admin.tasks.add' , $lic->id) }}">اضافة رخصة للطلب اعلاه </a>
       
</div>


@endsection