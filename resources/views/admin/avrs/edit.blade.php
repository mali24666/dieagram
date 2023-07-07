@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.avr.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.avrs.update", [$avr->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="avr_no">{{ trans('cruds.avr.fields.avr_no') }}</label>
                <input class="form-control {{ $errors->has('avr_no') ? 'is-invalid' : '' }}" type="text" name="avr_no" id="avr_no" value="{{ old('avr_no', $avr->avr_no) }}">
                @if($errors->has('avr_no'))
                    <span class="text-danger">{{ $errors->first('avr_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.avr.fields.avr_no_helper') }}</span>
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