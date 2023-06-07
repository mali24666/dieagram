@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cb.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cbs.update", [$cb->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="transe_id">{{ trans('cruds.cb.fields.transe') }}</label>
                <select class="form-control select2 {{ $errors->has('transe') ? 'is-invalid' : '' }}" name="transe_id" id="transe_id">
                    @foreach($transes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transe_id') ? old('transe_id') : $cb->transe->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transe'))
                    <span class="text-danger">{{ $errors->first('transe') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cb.fields.transe_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trans_cb_fider_number">{{ trans('cruds.cb.fields.trans_cb_fider_number') }}</label>
                <input class="form-control {{ $errors->has('trans_cb_fider_number') ? 'is-invalid' : '' }}" type="text" name="trans_cb_fider_number" id="trans_cb_fider_number" value="{{ old('trans_cb_fider_number', $cb->trans_cb_fider_number) }}" required>
                @if($errors->has('trans_cb_fider_number'))
                    <span class="text-danger">{{ $errors->first('trans_cb_fider_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cb.fields.trans_cb_fider_number_helper') }}</span>
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