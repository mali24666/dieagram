@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bill.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bills.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ground">{{ trans('cruds.bill.fields.ground') }}</label>
                <input class="form-control {{ $errors->has('ground') ? 'is-invalid' : '' }}" type="text" name="ground" id="ground" value="{{ old('ground', '') }}">
                @if($errors->has('ground'))
                    <span class="text-danger">{{ $errors->first('ground') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.ground_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="line">{{ trans('cruds.bill.fields.line') }}</label>
                <input class="form-control {{ $errors->has('line') ? 'is-invalid' : '' }}" type="text" name="line" id="line" value="{{ old('line', '') }}">
                @if($errors->has('line'))
                    <span class="text-danger">{{ $errors->first('line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="power_detected">{{ trans('cruds.bill.fields.power_detected') }}</label>
                <input class="form-control {{ $errors->has('power_detected') ? 'is-invalid' : '' }}" type="text" name="power_detected" id="power_detected" value="{{ old('power_detected', '') }}">
                @if($errors->has('power_detected'))
                    <span class="text-danger">{{ $errors->first('power_detected') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.power_detected_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="panal">{{ trans('cruds.bill.fields.panal') }}</label>
                <input class="form-control {{ $errors->has('panal') ? 'is-invalid' : '' }}" type="text" name="panal" id="panal" value="{{ old('panal', '') }}">
                @if($errors->has('panal'))
                    <span class="text-danger">{{ $errors->first('panal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.panal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reading">{{ trans('cruds.bill.fields.reading') }}</label>
                <input class="form-control {{ $errors->has('reading') ? 'is-invalid' : '' }}" type="text" name="reading" id="reading" value="{{ old('reading', '') }}">
                @if($errors->has('reading'))
                    <span class="text-danger">{{ $errors->first('reading') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.reading_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transformer_id">{{ trans('cruds.bill.fields.transformer') }}</label>
                <select class="form-control select2 {{ $errors->has('transformer') ? 'is-invalid' : '' }}" name="transformer_id" id="transformer_id">
                    @foreach($transformers as $id => $entry)
                        <option value="{{ $id }}" {{ old('transformer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transformer'))
                    <span class="text-danger">{{ $errors->first('transformer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bill.fields.transformer_helper') }}</span>
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