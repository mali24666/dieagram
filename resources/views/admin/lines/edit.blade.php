@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.line.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lines.update", [$line->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="station_id">{{ trans('cruds.line.fields.station') }}</label>
                <select class="form-control select2 {{ $errors->has('station') ? 'is-invalid' : '' }}" name="station_id" id="station_id">
                    @foreach($stations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('station_id') ? old('station_id') : $line->station->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('station'))
                    <span class="text-danger">{{ $errors->first('station') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.line.fields.station_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="line_no">{{ trans('cruds.line.fields.line_no') }}</label>
                <input class="form-control {{ $errors->has('line_no') ? 'is-invalid' : '' }}" type="text" name="line_no" id="line_no" value="{{ old('line_no', $line->line_no) }}">
                @if($errors->has('line_no'))
                    <span class="text-danger">{{ $errors->first('line_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.line.fields.line_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trans">{{ trans('cruds.line.fields.trans') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('trans') ? 'is-invalid' : '' }}" name="trans[]" id="trans" multiple>
                    @foreach($trans as $id => $tran)
                        <option value="{{ $id }}" {{ (in_array($id, old('trans', [])) || $line->trans->contains($id)) ? 'selected' : '' }}>{{ $tran }}</option>
                    @endforeach
                </select>
                @if($errors->has('trans'))
                    <span class="text-danger">{{ $errors->first('trans') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.line.fields.trans_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cts">{{ trans('cruds.line.fields.ct') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cts') ? 'is-invalid' : '' }}" name="cts[]" id="cts" multiple>
                    @foreach($cts as $id => $ct)
                        <option value="{{ $id }}" {{ (in_array($id, old('cts', [])) || $line->cts->contains($id)) ? 'selected' : '' }}>{{ $ct }}</option>
                    @endforeach
                </select>
                @if($errors->has('cts'))
                    <span class="text-danger">{{ $errors->first('cts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.line.fields.ct_helper') }}</span>
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