@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.station.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.stations.update", [$station->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="station_no">{{ trans('cruds.station.fields.station_no') }}</label>
                <input class="form-control {{ $errors->has('station_no') ? 'is-invalid' : '' }}" type="text" name="station_no" id="station_no" value="{{ old('station_no', $station->station_no) }}">
                @if($errors->has('station_no'))
                    <span class="text-danger">{{ $errors->first('station_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.station_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.station.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $station->location) }}">
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="feeders">{{ trans('cruds.station.fields.feeders') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('feeders') ? 'is-invalid' : '' }}" name="feeders[]" id="feeders" multiple>
                    @foreach($feeders as $id => $feeder)
                        <option value="{{ $id }}" {{ (in_array($id, old('feeders', [])) || $station->feeders->contains($id)) ? 'selected' : '' }}>{{ $feeder }}</option>
                    @endforeach
                </select>
                @if($errors->has('feeders'))
                    <span class="text-danger">{{ $errors->first('feeders') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.feeders_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trans">{{ trans('cruds.station.fields.trans') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('trans') ? 'is-invalid' : '' }}" name="trans[]" id="trans" multiple>
                    @foreach($trans as $id => $tran)
                        <option value="{{ $id }}" {{ (in_array($id, old('trans', [])) || $station->trans->contains($id)) ? 'selected' : '' }}>{{ $tran }}</option>
                    @endforeach
                </select>
                @if($errors->has('trans'))
                    <span class="text-danger">{{ $errors->first('trans') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.trans_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="box_cosutomers">{{ trans('cruds.station.fields.box_cosutomer') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('box_cosutomers') ? 'is-invalid' : '' }}" name="box_cosutomers[]" id="box_cosutomers" multiple>
                    @foreach($box_cosutomers as $id => $box_cosutomer)
                        <option value="{{ $id }}" {{ (in_array($id, old('box_cosutomers', [])) || $station->box_cosutomers->contains($id)) ? 'selected' : '' }}>{{ $box_cosutomer }}</option>
                    @endforeach
                </select>
                @if($errors->has('box_cosutomers'))
                    <span class="text-danger">{{ $errors->first('box_cosutomers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.box_cosutomer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ct_stations">{{ trans('cruds.station.fields.ct_station') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('ct_stations') ? 'is-invalid' : '' }}" name="ct_stations[]" id="ct_stations" multiple>
                    @foreach($ct_stations as $id => $ct_station)
                        <option value="{{ $id }}" {{ (in_array($id, old('ct_stations', [])) || $station->ct_stations->contains($id)) ? 'selected' : '' }}>{{ $ct_station }}</option>
                    @endforeach
                </select>
                @if($errors->has('ct_stations'))
                    <span class="text-danger">{{ $errors->first('ct_stations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.ct_station_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rmus">{{ trans('cruds.station.fields.rmu') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('rmus') ? 'is-invalid' : '' }}" name="rmus[]" id="rmus" multiple>
                    @foreach($rmus as $id => $rmu)
                        <option value="{{ $id }}" {{ (in_array($id, old('rmus', [])) || $station->rmus->contains($id)) ? 'selected' : '' }}>{{ $rmu }}</option>
                    @endforeach
                </select>
                @if($errors->has('rmus'))
                    <span class="text-danger">{{ $errors->first('rmus') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.rmu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="auto_closers">{{ trans('cruds.station.fields.auto_closer') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('auto_closers') ? 'is-invalid' : '' }}" name="auto_closers[]" id="auto_closers" multiple>
                    @foreach($auto_closers as $id => $auto_closer)
                        <option value="{{ $id }}" {{ (in_array($id, old('auto_closers', [])) || $station->auto_closers->contains($id)) ? 'selected' : '' }}>{{ $auto_closer }}</option>
                    @endforeach
                </select>
                @if($errors->has('auto_closers'))
                    <span class="text-danger">{{ $errors->first('auto_closers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.auto_closer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_lazies">{{ trans('cruds.station.fields.section_lazy') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('section_lazies') ? 'is-invalid' : '' }}" name="section_lazies[]" id="section_lazies" multiple>
                    @foreach($section_lazies as $id => $section_lazy)
                        <option value="{{ $id }}" {{ (in_array($id, old('section_lazies', [])) || $station->section_lazies->contains($id)) ? 'selected' : '' }}>{{ $section_lazy }}</option>
                    @endforeach
                </select>
                @if($errors->has('section_lazies'))
                    <span class="text-danger">{{ $errors->first('section_lazies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.section_lazy_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avrs">{{ trans('cruds.station.fields.avr') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('avrs') ? 'is-invalid' : '' }}" name="avrs[]" id="avrs" multiple>
                    @foreach($avrs as $id => $avr)
                        <option value="{{ $id }}" {{ (in_array($id, old('avrs', [])) || $station->avrs->contains($id)) ? 'selected' : '' }}>{{ $avr }}</option>
                    @endforeach
                </select>
                @if($errors->has('avrs'))
                    <span class="text-danger">{{ $errors->first('avrs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.station.fields.avr_helper') }}</span>
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