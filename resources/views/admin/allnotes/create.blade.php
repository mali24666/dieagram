@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.allnote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.allnotes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="t_notes">{{ trans('cruds.allnote.fields.t_notes') }}</label>
                <input class="form-control {{ $errors->has('t_notes') ? 'is-invalid' : '' }}" type="text" name="t_notes" id="t_notes" value="{{ old('t_notes', '') }}" required>
                @if($errors->has('t_notes'))
                    <span class="text-danger">{{ $errors->first('t_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allnote.fields.t_notes_helper') }}</span>
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