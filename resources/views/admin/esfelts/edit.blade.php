@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.esfelt.title_singular') }}
    </div>
    {{-- اختيار المقاول خاص فقط بادارة الاسفلت  --}}
    
    <div class="card-body">
        <form method="POST" action="{{ route("admin.esfelts.update", [$esfelt->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            رقم الرخصة 
                                
            <br>
            {{ $esfelt->lics_no->name  }}

            <div class="form-group">
                <label for="city">{{ trans('cruds.esfelt.fields.city') }}</label>
                <input readonly class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $esfelt->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="length">{{ trans('cruds.esfelt.fields.length') }}</label>
                <input readonly class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="text" name="length" id="length" value="{{ old('length', $esfelt->length) }}">
                @if($errors->has('length'))
                    <span class="text-danger">{{ $errors->first('length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.length_helper') }}</span>
            </div>
            {{-- اختيار المقاول وشهادة الانجاز  --}}
        @can('choose_con')

            <div class="form-group">
                <label>{{ trans('cruds.esfelt.fields.cons') }}</label>
                <select   class="form-control {{ $errors->has('cons') ? 'is-invalid' : '' }}" name="cons" id="cons">
                    <option value disabled {{ old('cons', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Esfelt::CONS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cons', $esfelt->cons) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cons'))
                    <span class="text-danger">{{ $errors->first('cons') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.cons_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label>{{ trans('cruds.esfelt.fields.delivery') }}</label>
                <select class="form-control {{ $errors->has('delivery') ? 'is-invalid' : '' }}" name="delivery" id="delivery">
                    <option value disabled {{ old('delivery', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Esfelt::DELIVERY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery', $esfelt->delivery) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery'))
                    <span class="text-danger">{{ $errors->first('delivery') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.delivery_helper') }}</span>
            </div>    

        @endcan
        @can('for_con')

            {{-- بداية القسم الخاص بالمقاول    --}}
            <div class="form-group">
                <label>{{ trans('cruds.esfelt.fields.esfelt_stuts') }}</label>
                <select class="form-control {{ $errors->has('esfelt_stuts') ? 'is-invalid' : '' }}" name="esfelt_stuts" id="esfelt_stuts">
                    <option value disabled {{ old('esfelt_stuts', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Esfelt::ESFELT_STUTS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('esfelt_stuts', $esfelt->esfelt_stuts) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('esfelt_stuts'))
                    <span class="text-danger">{{ $errors->first('esfelt_stuts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.delivery_helper') }}</span>
            </div>    

            <div class="form-group">
                <label for="esfelt_pic">{{ trans('cruds.esfelt.fields.esfelt_pic') }}</label>
                <div class="needsclick dropzone {{ $errors->has('esfelt_pic') ? 'is-invalid' : '' }}" id="esfelt_pic-dropzone">
                </div>
                @if($errors->has('esfelt_pic'))
                    <span class="text-danger">{{ $errors->first('esfelt_pic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.esfelt_pic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="eng_sign">{{ trans('cruds.esfelt.fields.eng_sign') }}</label>
                <div class="needsclick dropzone {{ $errors->has('eng_sign') ? 'is-invalid' : '' }}" id="eng_sign-dropzone">
                </div>
                @if($errors->has('eng_sign'))
                    <span class="text-danger">{{ $errors->first('eng_sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.eng_sign_helper') }}</span>
            </div>
            {{-- @if ($esfelt_stuts ===1)
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

            @endif --}}
            <div class="form-group">
                <div class="form-check {{ $errors->has('check_2') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="check_2" value="0">
                    <input class="form-check-input" type="checkbox" name="check_2" id="check_2" value="1" {{ $esfelt->check_2 || old('check_2', 0) === 1 ? 'checked' : '' }}>
                    <label > اقر بانه تم تنفيذ اعمال السفلته حسب الشروط والمواصفات المطلوبة </label>  <br>        
            <br> <input class="form-check-input" type="checkbox" required>
                    <label >تم تنفيذ العمل حسب الفترة الزمنية المحدده دون تاخير 
                    <br> <input class="form-check-input" type="checkbox" required>
                    <label >مرفق صورة للموقع بعد تنفيذ العمل وصورة توقيع كروكي من الاستشاري 
                        <br> <input class="form-check-input" type="checkbox" required>
                    <label >تم انهاء جميع الاعمال ومتبقي فقط اصدار شهادة انجاز 

                @if($errors->has('check_2'))
                    <span class="text-danger">{{ $errors->first('check_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.check_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('check_1') ? 'is-invalid' : '' }}">
                    <input  class="form-check-input" type="checkbox" name="check_1" id="check_1" value="1" {{ $esfelt->check_1 || old('check_1', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="check_1">اتحمل كافة الاصلاحات  او اعادة السفلته متي ما طلبت الجهة المالكة للمشروع </label>
                </div>
                @if($errors->has('check_1'))
                    <span class="text-danger">{{ $errors->first('check_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.check_1_helper') }}</span>
            </div>

        @endcan

            <div class="form-group">
                <label for="note">{{ trans('cruds.esfelt.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $esfelt->note) }}</textarea>
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.esfelt.fields.note_helper') }}</span>
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
    var uploadedLicsesMap = {}
Dropzone.options.licsesDropzone = {
    url: '{{ route('admin.esfelts.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="licses[]" value="' + response.name + '">')
      uploadedLicsesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLicsesMap[file.name]
      }
      $('form').find('input[name="licses[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($esfelt) && $esfelt->licses)
          var files =
            {!! json_encode($esfelt->licses) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="licses[]" value="' + file.file_name + '">')
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
    var uploadedWorkDonePicMap = {}
Dropzone.options.workDonePicDropzone = {
    url: '{{ route('admin.esfelts.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="work_done_pic[]" value="' + response.name + '">')
      uploadedWorkDonePicMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedWorkDonePicMap[file.name]
      }
      $('form').find('input[name="work_done_pic[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($esfelt) && $esfelt->work_done_pic)
      var files = {!! json_encode($esfelt->work_done_pic) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="work_done_pic[]" value="' + file.file_name + '">')
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
    var uploadedEsfeltPicMap = {}
Dropzone.options.esfeltPicDropzone = {
    url: '{{ route('admin.esfelts.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="esfelt_pic[]" value="' + response.name + '">')
      uploadedEsfeltPicMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEsfeltPicMap[file.name]
      }
      $('form').find('input[name="esfelt_pic[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($esfelt) && $esfelt->esfelt_pic)
      var files = {!! json_encode($esfelt->esfelt_pic) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="esfelt_pic[]" value="' + file.file_name + '">')
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
    url: '{{ route('admin.esfelts.storeMedia') }}',
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
@if(isset($esfelt) && $esfelt->eng_sign)
      var files = {!! json_encode($esfelt->eng_sign) !!}
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
@endsection