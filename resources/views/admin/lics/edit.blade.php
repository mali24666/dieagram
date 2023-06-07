@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lic.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lics.update", [$lic->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="license_no">{{ trans('cruds.lic.fields.license_no') }}</label>
                <input readonly class="form-control {{ $errors->has('license_no') ? 'is-invalid' : '' }}" type="text" name="license_no" id="license_no" value="{{ old('license_no', $lic->license_no) }}">
                @if($errors->has('license_no'))
                    <span class="text-danger">{{ $errors->first('license_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.license_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="esnad">{{ trans('cruds.lic.fields.esnad') }}</label>
                <input readonly class="form-control date {{ $errors->has('esnad') ? 'is-invalid' : '' }}" type="text" name="esnad" id="esnad" value="{{ old('esnad', $lic->esnad) }}" required>
                @if($errors->has('esnad'))
                    <span class="text-danger">{{ $errors->first('esnad') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.esnad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="datestary">{{ trans('cruds.lic.fields.datestary') }}</label>
                <input readonly class="form-control date {{ $errors->has('datestary') ? 'is-invalid' : '' }}" type="text" name="datestary" id="datestary" value="{{ old('datestary', $lic->datestary) }}">
                @if($errors->has('datestary'))
                    <span class="text-danger">{{ $errors->first('datestary') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.datestary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_end">{{ trans('cruds.lic.fields.date_end') }}</label>
                <input readonly class="form-control date {{ $errors->has('date_end') ? 'is-invalid' : '' }}" type="text" name="date_end" id="date_end" value="{{ old('date_end', $lic->date_end) }}">
                @if($errors->has('date_end'))
                    <span class="text-danger">{{ $errors->first('date_end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.date_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.lic.fields.city') }}</label>
                <input readonly class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $lic->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longtude">{{ trans('cruds.lic.fields.longtude') }}</label>
                <input readonly class="form-control {{ $errors->has('longtude') ? 'is-invalid' : '' }}" type="text" name="longtude" id="longtude" value="{{ old('longtude', $lic->longtude) }}">
                @if($errors->has('longtude'))
                    <span class="text-danger">{{ $errors->first('longtude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.longtude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="path">{{ trans('cruds.lic.fields.path') }}</label>
                <div class="needsclick dropzone {{ $errors->has('path') ? 'is-invalid' : '' }}" id="path-dropzone">
                </div>
                @if($errors->has('path'))
                    <span class="text-danger">{{ $errors->first('path') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.path_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="license_pic">{{ trans('cruds.lic.fields.license_pic') }}</label>
                <div class="needsclick dropzone {{ $errors->has('license_pic') ? 'is-invalid' : '' }}" id="license_pic-dropzone">
                </div>
                @if($errors->has('license_pic'))
                    <span class="text-danger">{{ $errors->first('license_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.license_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.lic.fields.stuts') }}</label>
                <select readonly class="form-control {{ $errors->has('stuts') ? 'is-invalid' : '' }}" name="stuts" id="stuts">
                    <option value disabled {{ old('stuts', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Lic::STUTS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('stuts', $lic->stuts) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('stuts'))
                    <span class="text-danger">{{ $errors->first('stuts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.stuts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_length">{{ trans('cruds.lic.fields.e_length') }}</label>
                <input readonly class="form-control {{ $errors->has('e_length') ? 'is-invalid' : '' }}" type="number" name="e_length" id="e_length" value="{{ old('e_length', $lic->e_length) }}" step="1">
                @if($errors->has('e_length'))
                    <span class="text-danger">{{ $errors->first('e_length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.e_length_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="t_length">{{ trans('cruds.lic.fields.t_length') }}</label>
                <input readonly class="form-control {{ $errors->has('t_length') ? 'is-invalid' : '' }}" type="number" name="t_length" id="t_length" value="{{ old('t_length', $lic->t_length) }}" step="1">
                @if($errors->has('t_length'))
                    <span class="text-danger">{{ $errors->first('t_length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.t_length_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wide">{{ trans('cruds.lic.fields.wide') }}</label>
                <input readonly class="form-control {{ $errors->has('wide') ? 'is-invalid' : '' }}" type="text" name="wide" id="wide" value="{{ old('wide', $lic->wide) }}">
                @if($errors->has('wide'))
                    <span class="text-danger">{{ $errors->first('wide') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.wide_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deep">{{ trans('cruds.lic.fields.deep') }}</label>
                <input readonly class="form-control {{ $errors->has('deep') ? 'is-invalid' : '' }}" type="text" name="deep" id="deep" value="{{ old('deep', $lic->deep) }}">
                @if($errors->has('deep'))
                    <span class="text-danger">{{ $errors->first('deep') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.deep_helper') }}</span>
            </div>
                                {{-- نهاية قسم الخاص بالمهندس  --}}
@can('head_eng_aprove')
    
            <div class="form-group">
                <label for="head_eng_id">{{ trans('cruds.lic.fields.head_eng') }}</label>
                <select class="form-control select2 {{ $errors->has('head_eng_id') ? 'is-invalid' : '' }}" name="head_eng_id" id="head_eng_id">
                    <option value="{{$add->id }}">{{$add->name }}</option>
                </select>
                @if($errors->has('head_eng'))
                    <span class="text-danger">{{ $errors->first('head_eng') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.head_eng_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('eng_check') ? 'is-invalid' : '' }}">
                    <select class="form-control select2 {{ $errors->has('eng_check') ? 'is-invalid' : '' }}" name="eng_check" id="eng_check">
                        <option value="1">غير موافق </option>
                        <option value="2"> موافق </option>
                    </select>
                    </div>
                @if($errors->has('eng_check'))
                    <span class="text-danger">{{ $errors->first('eng_check') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.eng_check_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

            @endcan

                                {{-- نهاية القسم الخاص بموافقة مدير الفرع  --}}
    
            <div class="form-group">
                <label>{{ trans('cruds.lic.fields.order_stauts') }}</label>
                <select class="form-control {{ $errors->has('order_stauts') ? 'is-invalid' : '' }}" name="order_stauts" id="order_stauts">
                    <option value disabled {{ old('order_stauts', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Lic::ORDER_STAUTS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('order_stauts', $lic->order_stauts) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('order_stauts'))
                    <span class="text-danger">{{ $errors->first('order_stauts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.order_stauts_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="order_pic">{{ trans('cruds.lic.fields.order_pic') }}</label>
                <div class="needsclick dropzone {{ $errors->has('order_pic') ? 'is-invalid' : '' }}" id="order_pic-dropzone">
                </div>
                @if($errors->has('order_pic'))
                    <span class="text-danger">{{ $errors->first('order_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.order_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="naseg_no">{{ trans('cruds.lic.fields.naseg_no') }}</label>
                <input class="form-control {{ $errors->has('naseg_no') ? 'is-invalid' : '' }}" type="number" name="naseg_no" id="naseg_no" value="{{ old('naseg_no', $lic->naseg_no) }}" step="0.01">
                @if($errors->has('naseg_no'))
                    <span class="text-danger">{{ $errors->first('naseg_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.naseg_no_helper') }}</span>
            </div>
               <div class="form-group">
                <label for="order_reject">{{ trans('cruds.lic.fields.order_reject') }}</label>
                <div class="needsclick dropzone {{ $errors->has('order_reject') ? 'is-invalid' : '' }}" id="order_reject-dropzone">
                </div>
                @if($errors->has('order_reject'))
                    <span class="text-danger">{{ $errors->first('order_reject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.order_reject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.lic.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    <option value="{{$add->id }}">{{$add->name }}</option>
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lic.fields.user_helper') }}</span>
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
    var uploadedPathMap = {}
Dropzone.options.pathDropzone = {
    url: '{{ route('admin.lics.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="path[]" value="' + response.name + '">')
      uploadedPathMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPathMap[file.name]
      }
      $('form').find('input[name="path[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lic) && $lic->path)
      var files = {!! json_encode($lic->path) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="path[]" value="' + file.file_name + '">')
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
    var uploadedLicensePicMap = {}
Dropzone.options.licensePicDropzone = {
    url: '{{ route('admin.lics.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="license_pic[]" value="' + response.name + '">')
      uploadedLicensePicMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLicensePicMap[file.name]
      }
      $('form').find('input[name="license_pic[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lic) && $lic->license_pic)
      var files = {!! json_encode($lic->license_pic) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="license_pic[]" value="' + file.file_name + '">')
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
    var uploadedOrderPicMap = {}
Dropzone.options.orderPicDropzone = {
    url: '{{ route('admin.lics.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="order_pic[]" value="' + response.name + '">')
      uploadedOrderPicMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedOrderPicMap[file.name]
      }
      $('form').find('input[name="order_pic[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lic) && $lic->order_pic)
      var files = {!! json_encode($lic->order_pic) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="order_pic[]" value="' + file.file_name + '">')
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
    var uploadedOrderRejectMap = {}
Dropzone.options.orderRejectDropzone = {
    url: '{{ route('admin.lics.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="order_reject[]" value="' + response.name + '">')
      uploadedOrderRejectMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedOrderRejectMap[file.name]
      }
      $('form').find('input[name="order_reject[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lic) && $lic->order_reject)
      var files = {!! json_encode($lic->order_reject) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="order_reject[]" value="' + file.file_name + '">')
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