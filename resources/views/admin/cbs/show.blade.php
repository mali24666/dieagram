@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cb.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cbs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cb.fields.id') }}
                        </th>
                        <td>
                            {{ $cb->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cb.fields.transe') }}
                        </th>
                        <td>
                            {{ $cb->transe->t_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cb.fields.trans_cb_fider_number') }}
                        </th>
                        <td>
                            {{ $cb->trans_cb_fider_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cbs.index') }}">
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
            <a class="nav-link" href="#cb_number_minibllers" role="tab" data-toggle="tab">
                {{ trans('cruds.minibller.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#cb_no_transeformers" role="tab" data-toggle="tab">
                {{ trans('cruds.transeformer.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="cb_number_minibllers">
            @includeIf('admin.cbs.relationships.cbNumberMinibllers', ['minibllers' => $cb->cbNumberMinibllers])
        </div>
        <div class="tab-pane" role="tabpanel" id="cb_no_transeformers">
            @includeIf('admin.cbs.relationships.cbNoTranseformers', ['transeformers' => $cb->cbNoTranseformers])
        </div>
    </div>
</div>

@endsection