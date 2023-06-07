@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.id') }}
                        </th>
                        <td>
                            {{ $bill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.ground') }}
                        </th>
                        <td>
                            {{ $bill->ground }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.line') }}
                        </th>
                        <td>
                            {{ $bill->line }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.power_detected') }}
                        </th>
                        <td>
                            {{ $bill->power_detected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.panal') }}
                        </th>
                        <td>
                            {{ $bill->panal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.reading') }}
                        </th>
                        <td>
                            {{ $bill->reading }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.transformer') }}
                        </th>
                        <td>
                            {{ $bill->transformer->t_no ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection