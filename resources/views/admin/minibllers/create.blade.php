@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.minibller.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.minibllers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cb_number_id">{{ trans('cruds.minibller.fields.cb_number') }}</label>
                <select class="form-control select2 {{ $errors->has('cb_number') ? 'is-invalid' : '' }}" name="cb_number_id" id="cb_number_id">
                    @foreach($cb_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('cb_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cb_number'))
                    <span class="text-danger">{{ $errors->first('cb_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.cb_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="minibller_number">{{ trans('cruds.minibller.fields.minibller_number') }}</label>
                <input class="form-control {{ $errors->has('minibller_number') ? 'is-invalid' : '' }}" type="text" name="minibller_number" id="minibller_number" value="{{ old('minibller_number', '') }}" required>
                @if($errors->has('minibller_number'))
                    <span class="text-danger">{{ $errors->first('minibller_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.minibller_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minibller_x">{{ trans('cruds.minibller.fields.minibller_x') }}</label>
                <input class="form-control {{ $errors->has('minibller_x') ? 'is-invalid' : '' }}" type="text" name="minibller_x" id="minibller_x" value="{{ old('minibller_x', '') }}">
                @if($errors->has('minibller_x'))
                    <span class="text-danger">{{ $errors->first('minibller_x') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.minibller_x_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minibller_y">{{ trans('cruds.minibller.fields.minibller_y') }}</label>
                <input class="form-control {{ $errors->has('minibller_y') ? 'is-invalid' : '' }}" type="text" name="minibller_y" id="minibller_y" value="{{ old('minibller_y', '') }}">
                @if($errors->has('minibller_y'))
                    <span class="text-danger">{{ $errors->first('minibller_y') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.minibller_y_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minibller_photo">{{ trans('cruds.minibller.fields.minibller_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('minibller_photo') ? 'is-invalid' : '' }}" id="minibller_photo-dropzone">
                </div>
                @if($errors->has('minibller_photo'))
                    <span class="text-danger">{{ $errors->first('minibller_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.minibller_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minibllar_notes">{{ trans('cruds.minibller.fields.minibllar_notes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('minibllar_notes') ? 'is-invalid' : '' }}" name="minibllar_notes[]" id="minibllar_notes" multiple>
                    @foreach($minibllar_notes as $id => $minibllar_note)
                        <option value="{{ $id }}" {{ in_array($id, old('minibllar_notes', [])) ? 'selected' : '' }}>{{ $minibllar_note }}</option>
                    @endforeach
                </select>
                @if($errors->has('minibllar_notes'))
                    <span class="text-danger">{{ $errors->first('minibllar_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.minibllar_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.minibller.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.minibller.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minibller.fields.latitude_helper') }}</span>
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
    Dropzone.options.minibllerPhotoDropzone = {
    url: '{{ route('admin.minibllers.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="minibller_photo"]').remove()
      $('form').append('<input type="hidden" name="minibller_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="minibller_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($minibller) && $minibller->minibller_photo)
      var file = {!! json_encode($minibller->minibller_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="minibller_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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