@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.box.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boxes.update", [$box->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="minibller_no_id">{{ trans('cruds.box.fields.minibller_no') }}</label>
                <select class="form-control select2 {{ $errors->has('minibller_no') ? 'is-invalid' : '' }}" name="minibller_no_id" id="minibller_no_id">
                    @foreach($minibller_nos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('minibller_no_id') ? old('minibller_no_id') : $box->minibller_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('minibller_no'))
                    <span class="text-danger">{{ $errors->first('minibller_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.minibller_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="box_number">{{ trans('cruds.box.fields.box_number') }}</label>
                <input class="form-control {{ $errors->has('box_number') ? 'is-invalid' : '' }}" type="text" name="box_number" id="box_number" value="{{ old('box_number', $box->box_number) }}" required>
                @if($errors->has('box_number'))
                    <span class="text-danger">{{ $errors->first('box_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.box_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.box.fields.box_type') }}</label>
                <select class="form-control {{ $errors->has('box_type') ? 'is-invalid' : '' }}" name="box_type" id="box_type" required>
                    <option value disabled {{ old('box_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Box::BOX_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('box_type', $box->box_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('box_type'))
                    <span class="text-danger">{{ $errors->first('box_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.box_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="box_location">{{ trans('cruds.box.fields.box_location') }}</label>
                <input class="form-control {{ $errors->has('box_location') ? 'is-invalid' : '' }}" type="text" name="box_location" id="box_location" value="{{ old('box_location', $box->box_location) }}">
                @if($errors->has('box_location'))
                    <span class="text-danger">{{ $errors->first('box_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.box_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.box.fields.box_notes') }}</label>
                <select class="form-control {{ $errors->has('box_notes') ? 'is-invalid' : '' }}" name="box_notes" id="box_notes">
                    <option value disabled {{ old('box_notes', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Box::BOX_NOTES_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('box_notes', $box->box_notes) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('box_notes'))
                    <span class="text-danger">{{ $errors->first('box_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.box_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="box_photo">{{ trans('cruds.box.fields.box_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('box_photo') ? 'is-invalid' : '' }}" id="box_photo-dropzone">
                </div>
                @if($errors->has('box_photo'))
                    <span class="text-danger">{{ $errors->first('box_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.box.fields.box_photo_helper') }}</span>
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
    var uploadedBoxPhotoMap = {}
Dropzone.options.boxPhotoDropzone = {
    url: '{{ route('admin.boxes.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="box_photo[]" value="' + response.name + '">')
      uploadedBoxPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBoxPhotoMap[file.name]
      }
      $('form').find('input[name="box_photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($box) && $box->box_photo)
      var files = {!! json_encode($box->box_photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="box_photo[]" value="' + file.file_name + '">')
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