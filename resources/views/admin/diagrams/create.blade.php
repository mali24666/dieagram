@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.diagram.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.diagrams.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="station_id">{{ trans('cruds.diagram.fields.station') }}</label>
                <select class="form-control select2 {{ $errors->has('station') ? 'is-invalid' : '' }}" name="station_id" id="station_id">
                    @foreach($stations as $id => $entry)
                        <option value="{{ $id }}" {{ old('station_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('station'))
                    <span class="text-danger">{{ $errors->first('station') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.diagram.fields.station_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="feeders">{{ trans('cruds.diagram.fields.feeder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('feeders') ? 'is-invalid' : '' }}" name="feeders[]" id="feeders" multiple>
                    @foreach($feeders as $id => $feeder)
                        <option value="{{ $id }}" {{ in_array($id, old('feeders', [])) ? 'selected' : '' }}>{{ $feeder }}</option>
                    @endforeach
                </select>
                @if($errors->has('feeders'))
                    <span class="text-danger">{{ $errors->first('feeders') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.diagram.fields.feeder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cts">{{ trans('cruds.diagram.fields.ct') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cts') ? 'is-invalid' : '' }}" name="cts[]" id="cts" multiple>
                    @foreach($cts as $id => $ct)
                        <option value="{{ $id }}" {{ in_array($id, old('cts', [])) ? 'selected' : '' }}>{{ $ct }}</option>
                    @endforeach
                </select>
                @if($errors->has('cts'))
                    <span class="text-danger">{{ $errors->first('cts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.diagram.fields.ct_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trans">{{ trans('cruds.diagram.fields.trans') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('trans') ? 'is-invalid' : '' }}" name="trans[]" id="trans" multiple>
                    @foreach($trans as $id => $tran)
                        <option value="{{ $id }}" {{ in_array($id, old('trans', [])) ? 'selected' : '' }}>{{ $tran }}</option>
                    @endforeach
                </select>
                @if($errors->has('trans'))
                    <span class="text-danger">{{ $errors->first('trans') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.diagram.fields.trans_helper') }}</span>
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