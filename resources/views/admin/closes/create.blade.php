@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.close.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.closes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lices_no_id">{{ trans('cruds.close.fields.lices_no') }}</label>
                <select class="form-control select2 {{ $errors->has('lices_no') ? 'is-invalid' : '' }}" name="lices_no_id" id="lices_no_id">
                    @foreach($lices_nos as $id => $entry)
                        <option value="{{ $id }}" {{ old('lices_no_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lices_no'))
                    <span class="text-danger">{{ $errors->first('lices_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.lices_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="after_esfelt">{{ trans('cruds.close.fields.after_esfelt') }}</label>
                <div class="needsclick dropzone {{ $errors->has('after_esfelt') ? 'is-invalid' : '' }}" id="after_esfelt-dropzone">
                </div>
                @if($errors->has('after_esfelt'))
                    <span class="text-danger">{{ $errors->first('after_esfelt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.after_esfelt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="eng_sign">{{ trans('cruds.close.fields.eng_sign') }}</label>
                <div class="needsclick dropzone {{ $errors->has('eng_sign') ? 'is-invalid' : '' }}" id="eng_sign-dropzone">
                </div>
                @if($errors->has('eng_sign'))
                    <span class="text-danger">{{ $errors->first('eng_sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.eng_sign_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="etmam_al_amal">{{ trans('cruds.close.fields.etmam_al_amal') }}</label>
                <div class="needsclick dropzone {{ $errors->has('etmam_al_amal') ? 'is-invalid' : '' }}" id="etmam_al_amal-dropzone">
                </div>
                @if($errors->has('etmam_al_amal'))
                    <span class="text-danger">{{ $errors->first('etmam_al_amal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.etmam_al_amal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="eng_sign">شهادة الانجاز </label>
                <div class="needsclick dropzone {{ $errors->has('eng_sign') ? 'is-invalid' : '' }}" id="eng_sign-dropzone">
                </div>
                @if($errors->has('eng_sign'))
                    <span class="text-danger">{{ $errors->first('eng_sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.eng_sign_helper') }}</span>
            </div>
            <div class="form-group" style="background-color: rgba(158, 170, 181, 0.548)">
                <div class="form-check {{ $errors->has('check') ? 'is-invalid' : '' }}">
                    <input required type="hidden" name="check" value="0">
                    <input required class="form-check-input" type="checkbox" name="check" id="check" value="1" {{ old('check', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="check">تم الاطلاع علي موقع العمل ووجد انه مطابق للمواصفات </label>
                </div>
                @if($errors->has('check'))
                    <span class="text-danger">{{ $errors->first('check') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.close.fields.check_helper') }}</span>
            </div>
            <div class="form-group" style="background-color: rgba(158, 170, 181, 0.548)">
                <div class="form-check {{ $errors->has('check') ? 'is-invalid' : '' }}">
                    <input required class="form-check-input" type="checkbox" required > 
                    <label > تم استخراج شهادة الانجاز </label>    <br>       
                </div>
            </div>
            <div class="form-group" style="background-color: rgba(158, 170, 181, 0.548)">
                <div class="form-check {{ $errors->has('check') ? 'is-invalid' : '' }}">
                    <input required class="form-check-input" type="checkbox" required > 
                    <label > مرفق شهادة الانجاز </label>    <br>       
                </div>
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
    var uploadedAfterEsfeltMap = {}
Dropzone.options.afterEsfeltDropzone = {
    url: '{{ route('admin.closes.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="after_esfelt[]" value="' + response.name + '">')
      uploadedAfterEsfeltMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAfterEsfeltMap[file.name]
      }
      $('form').find('input[name="after_esfelt[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($close) && $close->after_esfelt)
      var files = {!! json_encode($close->after_esfelt) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="after_esfelt[]" value="' + file.file_name + '">')
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
    var uploadedEngSignMap = {}
Dropzone.options.engSignDropzone = {
    url: '{{ route('admin.closes.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="eng_sign[]" value="' + response.name + '">')
      uploadedEngSignMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEngSignMap[file.name]
      }
      $('form').find('input[name="eng_sign[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($close) && $close->eng_sign)
      var files = {!! json_encode($close->eng_sign) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="eng_sign[]" value="' + file.file_name + '">')
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
    var uploadedEtmamAlAmalMap = {}
Dropzone.options.etmamAlAmalDropzone = {
    url: '{{ route('admin.closes.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="etmam_al_amal[]" value="' + response.name + '">')
      uploadedEtmamAlAmalMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEtmamAlAmalMap[file.name]
      }
      $('form').find('input[name="etmam_al_amal[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($close) && $close->etmam_al_amal)
          var files =
            {!! json_encode($close->etmam_al_amal) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="etmam_al_amal[]" value="' + file.file_name + '">')
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


{{-- 