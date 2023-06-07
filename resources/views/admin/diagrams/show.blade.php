@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.diagram.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diagrams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.diagram.fields.id') }}
                        </th>
                        <td>
                            {{ $diagram->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagram.fields.station') }}
                        </th>
                        <td>
                            {{ $diagram->station->station_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagram.fields.feeder') }}
                        </th>
                        <td>
                            @foreach($diagram->feeders as $key => $feeder)
                                <span class="label label-info">{{ $feeder->station_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagram.fields.ct') }}
                        </th>
                        <td>
                            @foreach($diagram->cts as $key => $ct)
                                <span class="label label-info">{{ $ct->ct_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagram.fields.trans') }}
                        </th>
                        <td>
                            @foreach($diagram->trans as $key => $trans)
                                <span class="label label-info">{{ $trans->t_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diagrams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection