@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userAlert.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-alerts.update", [$userAlert->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lices_no_id">{{ trans('cruds.userAlert.fields.lices_no') }}</label>
                <select class="form-control select2 {{ $errors->has('lices_no') ? 'is-invalid' : '' }}" name="lices_no_id" id="lices_no_id" required>
                    @foreach($lices_nos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lices_no_id') ? old('lices_no_id') : $userAlert->lices_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lices_no'))
                    <span class="text-danger">{{ $errors->first('lices_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.lices_no_helper') }}</span>
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