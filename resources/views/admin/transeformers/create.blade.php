@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transeformer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transeformers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="t_no">{{ trans('cruds.transeformer.fields.t_no') }}</label>
                <input class="form-control {{ $errors->has('t_no') ? 'is-invalid' : '' }}" type="text" name="t_no" id="t_no" value="{{ old('t_no', '') }}" required>
                @if($errors->has('t_no'))
                    <span class="text-danger">{{ $errors->first('t_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.t_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kva_rating">{{ trans('cruds.transeformer.fields.kva_rating') }}</label>
                <input class="form-control {{ $errors->has('kva_rating') ? 'is-invalid' : '' }}" type="text" name="kva_rating" id="kva_rating" value="{{ old('kva_rating', '') }}">
                @if($errors->has('kva_rating'))
                    <span class="text-danger">{{ $errors->first('kva_rating') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.kva_rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_voltage">{{ trans('cruds.transeformer.fields.primary_voltage') }}</label>
                <input class="form-control {{ $errors->has('primary_voltage') ? 'is-invalid' : '' }}" type="text" name="primary_voltage" id="primary_voltage" value="{{ old('primary_voltage', '') }}">
                @if($errors->has('primary_voltage'))
                    <span class="text-danger">{{ $errors->first('primary_voltage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.primary_voltage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sec_voltage">{{ trans('cruds.transeformer.fields.sec_voltage') }}</label>
                <input class="form-control {{ $errors->has('sec_voltage') ? 'is-invalid' : '' }}" type="text" name="sec_voltage" id="sec_voltage" value="{{ old('sec_voltage', '') }}">
                @if($errors->has('sec_voltage'))
                    <span class="text-danger">{{ $errors->first('sec_voltage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.sec_voltage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manuf_sno">{{ trans('cruds.transeformer.fields.manuf_sno') }}</label>
                <input class="form-control {{ $errors->has('manuf_sno') ? 'is-invalid' : '' }}" type="text" name="manuf_sno" id="manuf_sno" value="{{ old('manuf_sno', '') }}">
                @if($errors->has('manuf_sno'))
                    <span class="text-danger">{{ $errors->first('manuf_sno') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manuf_sno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manufacturer">{{ trans('cruds.transeformer.fields.manufacturer') }}</label>
                <input class="form-control {{ $errors->has('manufacturer') ? 'is-invalid' : '' }}" type="text" name="manufacturer" id="manufacturer" value="{{ old('manufacturer', '') }}">
                @if($errors->has('manufacturer'))
                    <span class="text-danger">{{ $errors->first('manufacturer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manufacturer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manafac_year">{{ trans('cruds.transeformer.fields.manafac_year') }}</label>
                <input class="form-control {{ $errors->has('manafac_year') ? 'is-invalid' : '' }}" type="text" name="manafac_year" id="manafac_year" value="{{ old('manafac_year', '') }}">
                @if($errors->has('manafac_year'))
                    <span class="text-danger">{{ $errors->first('manafac_year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manafac_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="over_load">{{ trans('cruds.transeformer.fields.over_load') }}</label>
                <input class="form-control {{ $errors->has('over_load') ? 'is-invalid' : '' }}" type="text" name="over_load" id="over_load" value="{{ old('over_load', '') }}">
                @if($errors->has('over_load'))
                    <span class="text-danger">{{ $errors->first('over_load') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.over_load_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rating">{{ trans('cruds.transeformer.fields.rating') }}</label>
                <input class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}" type="text" name="rating" id="rating" value="{{ old('rating', '') }}">
                @if($errors->has('rating'))
                    <span class="text-danger">{{ $errors->first('rating') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manufacturer_serial">{{ trans('cruds.transeformer.fields.manufacturer_serial') }}</label>
                <input class="form-control {{ $errors->has('manufacturer_serial') ? 'is-invalid' : '' }}" type="text" name="manufacturer_serial" id="manufacturer_serial" value="{{ old('manufacturer_serial', '') }}">
                @if($errors->has('manufacturer_serial'))
                    <span class="text-danger">{{ $errors->first('manufacturer_serial') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manufacturer_serial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="circuits">{{ trans('cruds.transeformer.fields.circuits') }}</label>
                <input class="form-control {{ $errors->has('circuits') ? 'is-invalid' : '' }}" type="text" name="circuits" id="circuits" value="{{ old('circuits', '') }}">
                @if($errors->has('circuits'))
                    <span class="text-danger">{{ $errors->first('circuits') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.circuits_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_used_circuits">{{ trans('cruds.transeformer.fields.no_of_used_circuits') }}</label>
                <input class="form-control {{ $errors->has('no_of_used_circuits') ? 'is-invalid' : '' }}" type="text" name="no_of_used_circuits" id="no_of_used_circuits" value="{{ old('no_of_used_circuits', '') }}">
                @if($errors->has('no_of_used_circuits'))
                    <span class="text-danger">{{ $errors->first('no_of_used_circuits') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.no_of_used_circuits_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manufacturer_minb">{{ trans('cruds.transeformer.fields.manufacturer_minb') }}</label>
                <input class="form-control {{ $errors->has('manufacturer_minb') ? 'is-invalid' : '' }}" type="text" name="manufacturer_minb" id="manufacturer_minb" value="{{ old('manufacturer_minb', '') }}">
                @if($errors->has('manufacturer_minb'))
                    <span class="text-danger">{{ $errors->first('manufacturer_minb') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manufacturer_minb_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lv_cable">{{ trans('cruds.transeformer.fields.lv_cable') }}</label>
                <input class="form-control {{ $errors->has('lv_cable') ? 'is-invalid' : '' }}" type="text" name="lv_cable" id="lv_cable" value="{{ old('lv_cable', '') }}">
                @if($errors->has('lv_cable'))
                    <span class="text-danger">{{ $errors->first('lv_cable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.lv_cable_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="x_minb">{{ trans('cruds.transeformer.fields.x_minb') }}</label>
                <input class="form-control {{ $errors->has('x_minb') ? 'is-invalid' : '' }}" type="text" name="x_minb" id="x_minb" value="{{ old('x_minb', '') }}">
                @if($errors->has('x_minb'))
                    <span class="text-danger">{{ $errors->first('x_minb') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.x_minb_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="y_minb">{{ trans('cruds.transeformer.fields.y_minb') }}</label>
                <input class="form-control {{ $errors->has('y_minb') ? 'is-invalid' : '' }}" type="text" name="y_minb" id="y_minb" value="{{ old('y_minb', '') }}">
                @if($errors->has('y_minb'))
                    <span class="text-danger">{{ $errors->first('y_minb') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.y_minb_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manuf">{{ trans('cruds.transeformer.fields.manuf') }}</label>
                <input class="form-control {{ $errors->has('manuf') ? 'is-invalid' : '' }}" type="text" name="manuf" id="manuf" value="{{ old('manuf', '') }}">
                @if($errors->has('manuf'))
                    <span class="text-danger">{{ $errors->first('manuf') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.manuf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="left_ss">{{ trans('cruds.transeformer.fields.left_ss') }}</label>
                <input class="form-control {{ $errors->has('left_ss') ? 'is-invalid' : '' }}" type="text" name="left_ss" id="left_ss" value="{{ old('left_ss', '') }}">
                @if($errors->has('left_ss'))
                    <span class="text-danger">{{ $errors->first('left_ss') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.left_ss_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="right_ss">{{ trans('cruds.transeformer.fields.right_ss') }}</label>
                <input class="form-control {{ $errors->has('right_ss') ? 'is-invalid' : '' }}" type="text" name="right_ss" id="right_ss" value="{{ old('right_ss', '') }}">
                @if($errors->has('right_ss'))
                    <span class="text-danger">{{ $errors->first('right_ss') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.right_ss_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serial_no">{{ trans('cruds.transeformer.fields.serial_no') }}</label>
                <input class="form-control {{ $errors->has('serial_no') ? 'is-invalid' : '' }}" type="text" name="serial_no" id="serial_no" value="{{ old('serial_no', '') }}">
                @if($errors->has('serial_no'))
                    <span class="text-danger">{{ $errors->first('serial_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.serial_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.transeformer.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="picture_befor">{{ trans('cruds.transeformer.fields.picture_befor') }}</label>
                <div class="needsclick dropzone {{ $errors->has('picture_befor') ? 'is-invalid' : '' }}" id="picture_befor-dropzone">
                </div>
                @if($errors->has('picture_befor'))
                    <span class="text-danger">{{ $errors->first('picture_befor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.picture_befor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo_after">{{ trans('cruds.transeformer.fields.photo_after') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo_after') ? 'is-invalid' : '' }}" id="photo_after-dropzone">
                </div>
                @if($errors->has('photo_after'))
                    <span class="text-danger">{{ $errors->first('photo_after') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.photo_after_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cb_no_id">{{ trans('cruds.transeformer.fields.cb_no') }}</label>
                <select class="form-control select2 {{ $errors->has('cb_no') ? 'is-invalid' : '' }}" name="cb_no_id" id="cb_no_id">
                    @foreach($cb_nos as $id => $entry)
                        <option value="{{ $id }}" {{ old('cb_no_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cb_no'))
                    <span class="text-danger">{{ $errors->first('cb_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.cb_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.transeformer.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.transeformer.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="feeder_id">{{ trans('cruds.transeformer.fields.feeder') }}</label>
                <select class="form-control select2 {{ $errors->has('feeder') ? 'is-invalid' : '' }}" name="feeder_id" id="feeder_id">
                    @foreach($feeders as $id => $entry)
                        <option value="{{ $id }}" {{ old('feeder_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('feeder'))
                    <span class="text-danger">{{ $errors->first('feeder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.feeder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boxes">{{ trans('cruds.transeformer.fields.box') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boxes') ? 'is-invalid' : '' }}" name="boxes[]" id="boxes" multiple>
                    @foreach($boxes as $id => $box)
                        <option value="{{ $id }}" {{ in_array($id, old('boxes', [])) ? 'selected' : '' }}>{{ $box }}</option>
                    @endforeach
                </select>
                @if($errors->has('boxes'))
                    <span class="text-danger">{{ $errors->first('boxes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.box_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transe_notes">{{ trans('cruds.transeformer.fields.transe_note') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('transe_notes') ? 'is-invalid' : '' }}" name="transe_notes[]" id="transe_notes" multiple>
                    @foreach($transe_notes as $id => $transe_note)
                        <option value="{{ $id }}" {{ in_array($id, old('transe_notes', [])) ? 'selected' : '' }}>{{ $transe_note }}</option>
                    @endforeach
                </select>
                @if($errors->has('transe_notes'))
                    <span class="text-danger">{{ $errors->first('transe_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transeformer.fields.transe_note_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedPictureBeforMap = {}
Dropzone.options.pictureBeforDropzone = {
    url: '{{ route('admin.transeformers.storeMedia') }}',
    maxFilesize: 3, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="picture_befor[]" value="' + response.name + '">')
      uploadedPictureBeforMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPictureBeforMap[file.name]
      }
      $('form').find('input[name="picture_befor[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($transeformer) && $transeformer->picture_befor)
      var files = {!! json_encode($transeformer->picture_befor) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="picture_befor[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
<script>
    var uploadedPhotoAfterMap = {}
Dropzone.options.photoAfterDropzone = {
    url: '{{ route('admin.transeformers.storeMedia') }}',
    maxFilesize: 3, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo_after[]" value="' + response.name + '">')
      uploadedPhotoAfterMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoAfterMap[file.name]
      }
      $('form').find('input[name="photo_after[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($transeformer) && $transeformer->photo_after)
      var files = {!! json_encode($transeformer->photo_after) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo_after[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection