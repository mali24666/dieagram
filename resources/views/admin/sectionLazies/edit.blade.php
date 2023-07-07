@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sectionLazy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.section-lazies.update", [$sectionLazy->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="section_lazey">{{ trans('cruds.sectionLazy.fields.section_lazey') }}</label>
                <input class="form-control {{ $errors->has('section_lazey') ? 'is-invalid' : '' }}" type="text" name="section_lazey" id="section_lazey" value="{{ old('section_lazey', $sectionLazy->section_lazey) }}">
                @if($errors->has('section_lazey'))
                    <span class="text-danger">{{ $errors->first('section_lazey') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sectionLazy.fields.section_lazey_helper') }}</span>
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