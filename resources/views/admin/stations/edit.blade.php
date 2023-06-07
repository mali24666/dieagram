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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection