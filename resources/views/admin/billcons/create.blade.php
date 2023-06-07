@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.billcon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.billcons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="task_no_id">{{ trans('cruds.billcon.fields.task_no') }}</label>
                <select class="form-control select2 {{ $errors->has('task_no') ? 'is-invalid' : '' }}" name="task_no_id" id="task_no_id" required>
                    @foreach($task_nos as $id => $entry)
                        <option value="{{ $id }}" {{ old('task_no_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('task_no'))
                    <span class="text-danger">{{ $errors->first('task_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.task_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mokusa_id">{{ trans('cruds.billcon.fields.mokusa') }}</label>
                <select class="form-control select2 {{ $errors->has('mokusa') ? 'is-invalid' : '' }}" name="mokusa_id" id="mokusa_id">
                    @foreach($mokusas as $id => $entry)
                        <option value="{{ $id }}" {{ old('mokusa_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mokusa'))
                    <span class="text-danger">{{ $errors->first('mokusa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.mokusa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="created_by_id">{{ trans('cruds.billcon.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id">
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('created_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <span class="text-danger">{{ $errors->first('created_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.created_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.billcon.fields.job_1') }}</label>
                <select class="form-control {{ $errors->has('job_1') ? 'is-invalid' : '' }}" name="job_1" id="job_1" required>
                    <option value disabled {{ old('job_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_1', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_1'))
                    <span class="text-danger">{{ $errors->first('job_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.job_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.billcon.fields.job_2') }}</label>
                <select class="form-control {{ $errors->has('job_2') ? 'is-invalid' : '' }}" name="job_2" id="job_2">
                    <option value disabled {{ old('job_2', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Billcon::JOB_2_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_2', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_2'))
                    <span class="text-danger">{{ $errors->first('job_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.job_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.billcon.fields.job_3') }}</label>
                <select class="form-control {{ $errors->has('job_3') ? 'is-invalid' : '' }}" name="job_3" id="job_3">
                    <option value disabled {{ old('job_3', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Billcon::JOB_3_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_3', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_3'))
                    <span class="text-danger">{{ $errors->first('job_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.job_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="count_1">{{ trans('cruds.billcon.fields.count_1') }}</label>
                <input class="form-control {{ $errors->has('count_1') ? 'is-invalid' : '' }}" type="number" name="count_1" id="count_1" value="{{ old('count_1', '') }}" step="0.01">
                @if($errors->has('count_1'))
                    <span class="text-danger">{{ $errors->first('count_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.count_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="count_2">{{ trans('cruds.billcon.fields.count_2') }}</label>
                <input class="form-control {{ $errors->has('count_2') ? 'is-invalid' : '' }}" type="number" name="count_2" id="count_2" value="{{ old('count_2', '') }}" step="0.01">
                @if($errors->has('count_2'))
                    <span class="text-danger">{{ $errors->first('count_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.count_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="count_3">{{ trans('cruds.billcon.fields.count_3') }}</label>
                <input class="form-control {{ $errors->has('count_3') ? 'is-invalid' : '' }}" type="number" name="count_3" id="count_3" value="{{ old('count_3', '') }}" step="0.01">
                @if($errors->has('count_3'))
                    <span class="text-danger">{{ $errors->first('count_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.count_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="totall">{{ trans('cruds.billcon.fields.totall') }}</label>
                <input class="form-control {{ $errors->has('totall') ? 'is-invalid' : '' }}" type="number" name="totall" id="totall" value="{{ old('totall', '') }}" step="0.01">
                @if($errors->has('totall'))
                    <span class="text-danger">{{ $errors->first('totall') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.totall_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="totall_2">{{ trans('cruds.billcon.fields.totall_2') }}</label>
                <input class="form-control {{ $errors->has('totall_2') ? 'is-invalid' : '' }}" type="number" name="totall_2" id="totall_2" value="{{ old('totall_2', '') }}" step="0.01">
                @if($errors->has('totall_2'))
                    <span class="text-danger">{{ $errors->first('totall_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.totall_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="totall_3">{{ trans('cruds.billcon.fields.totall_3') }}</label>
                <input class="form-control {{ $errors->has('totall_3') ? 'is-invalid' : '' }}" type="number" name="totall_3" id="totall_3" value="{{ old('totall_3', '') }}" step="0.01">
                @if($errors->has('totall_3'))
                    <span class="text-danger">{{ $errors->first('totall_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.totall_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="totall_4">{{ trans('cruds.billcon.fields.totall_4') }}</label>
                <input class="form-control {{ $errors->has('totall_4') ? 'is-invalid' : '' }}" type="number" name="totall_4" id="totall_4" value="{{ old('totall_4', '') }}" step="0.01">
                @if($errors->has('totall_4'))
                    <span class="text-danger">{{ $errors->first('totall_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.totall_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="enjaz">{{ trans('cruds.billcon.fields.enjaz') }}</label>
                <div class="needsclick dropzone {{ $errors->has('enjaz') ? 'is-invalid' : '' }}" id="enjaz-dropzone">
                </div>
                @if($errors->has('enjaz'))
                    <span class="text-danger">{{ $errors->first('enjaz') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.enjaz_helper') }}</span>
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
    var uploadedEnjazMap = {}
Dropzone.options.enjazDropzone = {
    url: '{{ route('admin.billcons.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="enjaz[]" value="' + response.name + '">')
      uploadedEnjazMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEnjazMap[file.name]
      }
      $('form').find('input[name="enjaz[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($billcon) && $billcon->enjaz)
          var files =
            {!! json_encode($billcon->enjaz) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="enjaz[]" value="' + file.file_name + '">')
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