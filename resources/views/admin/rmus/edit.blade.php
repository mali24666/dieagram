@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rmu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rmus.update", [$rmu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="rmu_no">{{ trans('cruds.rmu.fields.rmu_no') }}</label>
                <input class="form-control {{ $errors->has('rmu_no') ? 'is-invalid' : '' }}" type="text" name="rmu_no" id="rmu_no" value="{{ old('rmu_no', $rmu->rmu_no) }}" required>
                @if($errors->has('rmu_no'))
                    <span class="text-danger">{{ $errors->first('rmu_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rmu.fields.rmu_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rmu_feeder_id">{{ trans('cruds.rmu.fields.rmu_feeder') }}</label>
                <select class="form-control select2 {{ $errors->has('rmu_feeder') ? 'is-invalid' : '' }}" name="rmu_feeder_id" id="rmu_feeder_id">
                    @foreach($rmu_feeders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('rmu_feeder_id') ? old('rmu_feeder_id') : $rmu->rmu_feeder->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rmu_feeder'))
                    <span class="text-danger">{{ $errors->first('rmu_feeder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rmu.fields.rmu_feeder_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection