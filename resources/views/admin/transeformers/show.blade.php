@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transeformer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transeformers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.id') }}
                        </th>
                        <td>
                            {{ $transeformer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.t_no') }}
                        </th>
                        <td>
                            {{ $transeformer->t_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.kva_rating') }}
                        </th>
                        <td>
                            {{ $transeformer->kva_rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.primary_voltage') }}
                        </th>
                        <td>
                            {{ $transeformer->primary_voltage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.sec_voltage') }}
                        </th>
                        <td>
                            {{ $transeformer->sec_voltage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manuf_sno') }}
                        </th>
                        <td>
                            {{ $transeformer->manuf_sno }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manufacturer') }}
                        </th>
                        <td>
                            {{ $transeformer->manufacturer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manafac_year') }}
                        </th>
                        <td>
                            {{ $transeformer->manafac_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.over_load') }}
                        </th>
                        <td>
                            {{ $transeformer->over_load }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.rating') }}
                        </th>
                        <td>
                            {{ $transeformer->rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manufacturer_serial') }}
                        </th>
                        <td>
                            {{ $transeformer->manufacturer_serial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.circuits') }}
                        </th>
                        <td>
                            {{ $transeformer->circuits }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.no_of_used_circuits') }}
                        </th>
                        <td>
                            {{ $transeformer->no_of_used_circuits }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manufacturer_minb') }}
                        </th>
                        <td>
                            {{ $transeformer->manufacturer_minb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.lv_cable') }}
                        </th>
                        <td>
                            {{ $transeformer->lv_cable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.x_minb') }}
                        </th>
                        <td>
                            {{ $transeformer->x_minb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.y_minb') }}
                        </th>
                        <td>
                            {{ $transeformer->y_minb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.manuf') }}
                        </th>
                        <td>
                            {{ $transeformer->manuf }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.left_ss') }}
                        </th>
                        <td>
                            {{ $transeformer->left_ss }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.right_ss') }}
                        </th>
                        <td>
                            {{ $transeformer->right_ss }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.serial_no') }}
                        </th>
                        <td>
                            {{ $transeformer->serial_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.type') }}
                        </th>
                        <td>
                            {{ $transeformer->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.picture_befor') }}
                        </th>
                        <td>
                            @foreach($transeformer->picture_befor as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.photo_after') }}
                        </th>
                        <td>
                            @foreach($transeformer->photo_after as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.created_at') }}
                        </th>
                        <td>
                            {{ $transeformer->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.cb_no') }}
                        </th>
                        <td>
                            {{ $transeformer->cb_no->trans_cb_fider_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.latitude') }}
                        </th>
                        <td>
                            {{ $transeformer->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.longitude') }}
                        </th>
                        <td>
                            {{ $transeformer->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.feeder') }}
                        </th>
                        <td>
                            {{ $transeformer->feeder->line_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.transe_note') }}
                        </th>
                        <td>
                            @foreach($transeformer->transe_notes as $key => $transe_note)
                                <span class="label label-info">{{ $transe_note->t_notes }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transeformer.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $transeformer->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transeformers.index') }}">
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
            <a class="nav-link" href="#transe_cbs" role="tab" data-toggle="tab">
                {{ trans('cruds.cb.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#transformer_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#trans_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.line.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#trans_diagrams" role="tab" data-toggle="tab">
                {{ trans('cruds.diagram.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="transe_cbs">
            @includeIf('admin.transeformers.relationships.transeCbs', ['cbs' => $transeformer->transeCbs])
        </div>
        <div class="tab-pane" role="tabpanel" id="transformer_bills">
            @includeIf('admin.transeformers.relationships.transformerBills', ['bills' => $transeformer->transformerBills])
        </div>
        <div class="tab-pane" role="tabpanel" id="trans_lines">
            @includeIf('admin.transeformers.relationships.transLines', ['lines' => $transeformer->transLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="trans_diagrams">
            @includeIf('admin.transeformers.relationships.transDiagrams', ['diagrams' => $transeformer->transDiagrams])
        </div>
    </div>
</div>

@endsection