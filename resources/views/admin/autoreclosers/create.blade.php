@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.autorecloser.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.autoreclosers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="auto_recloser_no">{{ trans('cruds.autorecloser.fields.auto_recloser_no') }}</label>
                <input class="form-control {{ $errors->has('auto_recloser_no') ? 'is-invalid' : '' }}" type="text" name="auto_recloser_no" id="auto_recloser_no" value="{{ old('auto_recloser_no', '') }}">
                @if($errors->has('auto_recloser_no'))
                    <span class="text-danger">{{ $errors->first('auto_recloser_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.autorecloser.fields.auto_recloser_no_helper') }}</span>
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