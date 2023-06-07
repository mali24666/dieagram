@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cts.update", [$ct->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ct_no">{{ trans('cruds.ct.fields.ct_no') }}</label>
                <input class="form-control {{ $errors->has('ct_no') ? 'is-invalid' : '' }}" type="text" name="ct_no" id="ct_no" value="{{ old('ct_no', $ct->ct_no) }}">
                @if($errors->has('ct_no'))
                    <span class="text-danger">{{ $errors->first('ct_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ct.fields.ct_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="point_1_id">{{ trans('cruds.ct.fields.point_1') }}</label>
                <select class="form-control select2 {{ $errors->has('point_1') ? 'is-invalid' : '' }}" name="point_1_id" id="point_1_id">
                    @foreach($point_1s as $id => $entry)
                        <option value="{{ $id }}" {{ (old('point_1_id') ? old('point_1_id') : $ct->point_1->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('point_1'))
                    <span class="text-danger">{{ $errors->first('point_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ct.fields.point_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="point_2_id">{{ trans('cruds.ct.fields.point_2') }}</label>
                <select class="form-control select2 {{ $errors->has('point_2') ? 'is-invalid' : '' }}" name="point_2_id" id="point_2_id">
                    @foreach($point_2s as $id => $entry)
                        <option value="{{ $id }}" {{ (old('point_2_id') ? old('point_2_id') : $ct->point_2->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('point_2'))
                    <span class="text-danger">{{ $errors->first('point_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ct.fields.point_2_helper') }}</span>
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