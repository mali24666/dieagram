@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.update", [$project->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name_id">{{ trans('cruds.project.fields.name') }}</label>
                <select class="form-control select2 {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name_id" id="name_id">
                    @foreach($names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('name_id') ? old('name_id') : $project->name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="station">{{ trans('cruds.project.fields.station') }}</label>
                <input class="form-control {{ $errors->has('station') ? 'is-invalid' : '' }}" type="text" name="station" id="station" value="{{ old('station', $project->station) }}">
                @if($errors->has('station'))
                    <span class="text-danger">{{ $errors->first('station') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.station_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="top">{{ trans('cruds.project.fields.top') }}</label>
                <input class="form-control {{ $errors->has('top') ? 'is-invalid' : '' }}" type="text" name="top" id="top" value="{{ old('top', $project->top) }}">
                @if($errors->has('top'))
                    <span class="text-danger">{{ $errors->first('top') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.top_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="left">{{ trans('cruds.project.fields.left') }}</label>
                <input class="form-control {{ $errors->has('left') ? 'is-invalid' : '' }}" type="text" name="left" id="left" value="{{ old('left', $project->left) }}">
                @if($errors->has('left'))
                    <span class="text-danger">{{ $errors->first('left') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.left_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descreption">{{ trans('cruds.project.fields.descreption') }}</label>
                <input class="form-control {{ $errors->has('descreption') ? 'is-invalid' : '' }}" type="text" name="descreption" id="descreption" value="{{ old('descreption', $project->descreption) }}">
                @if($errors->has('descreption'))
                    <span class="text-danger">{{ $errors->first('descreption') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.descreption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transefer_id">{{ trans('cruds.project.fields.transefer') }}</label>
                <select class="form-control select2 {{ $errors->has('transefer') ? 'is-invalid' : '' }}" name="transefer_id" id="transefer_id">
                    @foreach($transefers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transefer_id') ? old('transefer_id') : $project->transefer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transefer'))
                    <span class="text-danger">{{ $errors->first('transefer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.transefer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="feeder_id">{{ trans('cruds.project.fields.feeder') }}</label>
                <select class="form-control select2 {{ $errors->has('feeder') ? 'is-invalid' : '' }}" name="feeder_id" id="feeder_id">
                    @foreach($feeders as $id => $entry)
                        <option value="{{ $id }}" {{ (old('feeder_id') ? old('feeder_id') : $project->feeder->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('feeder'))
                    <span class="text-danger">{{ $errors->first('feeder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.feeder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="second_feeder">{{ trans('cruds.project.fields.second_feeder') }}</label>
                <input class="form-control {{ $errors->has('second_feeder') ? 'is-invalid' : '' }}" type="text" name="second_feeder" id="second_feeder" value="{{ old('second_feeder', $project->second_feeder) }}">
                @if($errors->has('second_feeder'))
                    <span class="text-danger">{{ $errors->first('second_feeder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.second_feeder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ct_id">{{ trans('cruds.project.fields.ct') }}</label>
                <select class="form-control select2 {{ $errors->has('ct') ? 'is-invalid' : '' }}" name="ct_id" id="ct_id">
                    @foreach($cts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ct_id') ? old('ct_id') : $project->ct->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ct'))
                    <span class="text-danger">{{ $errors->first('ct') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.ct_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ct_postion">{{ trans('cruds.project.fields.ct_postion') }}</label>
                <input class="form-control {{ $errors->has('ct_postion') ? 'is-invalid' : '' }}" type="text" name="ct_postion" id="ct_postion" value="{{ old('ct_postion', $project->ct_postion) }}">
                @if($errors->has('ct_postion'))
                    <span class="text-danger">{{ $errors->first('ct_postion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.ct_postion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rmu_id">{{ trans('cruds.project.fields.rmu') }}</label>
                <select class="form-control select2 {{ $errors->has('rmu') ? 'is-invalid' : '' }}" name="rmu_id" id="rmu_id">
                    @foreach($rmus as $id => $entry)
                        <option value="{{ $id }}" {{ (old('rmu_id') ? old('rmu_id') : $project->rmu->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rmu'))
                    <span class="text-danger">{{ $errors->first('rmu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.rmu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="autorecloser_id">{{ trans('cruds.project.fields.autorecloser') }}</label>
                <select class="form-control select2 {{ $errors->has('autorecloser') ? 'is-invalid' : '' }}" name="autorecloser_id" id="autorecloser_id">
                    @foreach($autoreclosers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('autorecloser_id') ? old('autorecloser_id') : $project->autorecloser->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('autorecloser'))
                    <span class="text-danger">{{ $errors->first('autorecloser') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.autorecloser_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sectionlazy_id">{{ trans('cruds.project.fields.sectionlazy') }}</label>
                <select class="form-control select2 {{ $errors->has('sectionlazy') ? 'is-invalid' : '' }}" name="sectionlazy_id" id="sectionlazy_id">
                    @foreach($sectionlazies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sectionlazy_id') ? old('sectionlazy_id') : $project->sectionlazy->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sectionlazy'))
                    <span class="text-danger">{{ $errors->first('sectionlazy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.sectionlazy_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avr_id">{{ trans('cruds.project.fields.avr') }}</label>
                <select class="form-control select2 {{ $errors->has('avr') ? 'is-invalid' : '' }}" name="avr_id" id="avr_id">
                    @foreach($avrs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('avr_id') ? old('avr_id') : $project->avr->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('avr'))
                    <span class="text-danger">{{ $errors->first('avr') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.avr_helper') }}</span>
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