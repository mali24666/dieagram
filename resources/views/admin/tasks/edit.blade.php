@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.task.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tasks.update", [$task->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="lics_file">{{ trans('cruds.task.fields.lics_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lics_file') ? 'is-invalid' : '' }}" id="lics_file-dropzone">
                </div>
                @if($errors->has('lics_file'))
                    <span class="text-danger">{{ $errors->first('lics_file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.lics_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lics_no_id">{{ trans('cruds.task.fields.lics_no') }}</label>
                <select class="form-control select2 {{ $errors->has('lics_no') ? 'is-invalid' : '' }}" name="lics_no_id" id="lics_no_id" required>
                    @foreach($lics_nos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lics_no_id') ? old('lics_no_id') : $task->lics_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lics_no'))
                    <span class="text-danger">{{ $errors->first('lics_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.lics_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.task.fields.name') }}</label>
                <input readonly class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="copy">{{ trans('cruds.task.fields.copy') }}</label>
                <input class="form-control {{ $errors->has('copy') ? 'is-invalid' : '' }}" type="number" name="copy" id="copy" value="{{ old('copy', $task->copy) }}" step="1">
                @if($errors->has('copy'))
                    <span class="text-danger">{{ $errors->first('copy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.copy_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.task.fields.start_time') }}</label>
                <input readonly class="form-control date {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $task->start_time) }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                <input readonly class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="length_total">{{ trans('cruds.task.fields.length_total') }}</label>
                <input readonly class="form-control {{ $errors->has('length_total') ? 'is-invalid' : '' }}" type="number" name="length_total" id="length_total" value="{{ old('length_total', $task->length_total) }}" step="0.01">
                @if($errors->has('length_total'))
                    <span class="text-danger">{{ $errors->first('length_total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.length_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extract">{{ trans('cruds.task.fields.extract') }}</label>
                <input readonly class="form-control date {{ $errors->has('extract') ? 'is-invalid' : '' }}" type="text" name="extract" id="extract" value="{{ old('extract', $task->extract) }}">
                @if($errors->has('extract'))
                    <span class="text-danger">{{ $errors->first('extract') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.extract_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.task.fields.city') }}</label>
                <input readonly class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $task->city) }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="streat">اصدرت بواسطة  </label>
                <input readonly class="form-control {{ $errors->has('streat') ? 'is-invalid' : '' }}" type="text" name="streat" id="streat" value="{{ old('streat', $task->streat) }}">
                @if($errors->has('streat'))
                    <span class="text-danger">{{ $errors->first('streat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.streat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.task.fields.stuts') }}</label>
                <select class="form-control {{ $errors->has('stuts') ? 'is-invalid' : '' }}" name="stuts" id="stuts" required>
                    <option value disabled {{ old('stuts', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Task::STUTS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('stuts', $task->stuts) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('stuts'))
                    <span class="text-danger">{{ $errors->first('stuts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.stuts_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required">{{ trans('cruds.task.fields.station') }}</label>
                <select class="form-control {{ $errors->has('station') ? 'is-invalid' : '' }}" name="station" id="station" required>
                    <option value disabled {{ old('station', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Task::STATION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('station', $task->station) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('station'))
                    <span class="text-danger">{{ $errors->first('station') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.station_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="etmam">رقم طلب اصدار شهادة اتمام الاعمال </label>
                <input  class="form-control {{ $errors->has('etmam') ? 'is-invalid' : '' }}" type="text" name="etmam" id="etmam" value="{{ old('etmam', $task->etmam) }}" >
                @if($errors->has('etmam'))
                    <span class="text-danger">{{ $errors->first('etmam') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="kholow">رقم طلب شهادة اخلاء طرف  </label>
                <input  class="form-control {{ $errors->has('kholow') ? 'is-invalid' : '' }}" type="text" name="kholow" id="city" value="{{ old('kholow', $task->kholow) }}" >
                @if($errors->has('kholow'))
                    <span class="text-danger">{{ $errors->first('kholow') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                    @foreach($assigned_tos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_to_id') ? old('assigned_to_id') : $task->assigned_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to'))
                    <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
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
    var uploadedLicsFileMap = {}
Dropzone.options.licsFileDropzone = {
    url: '{{ route('admin.tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="lics_file[]" value="' + response.name + '">')
      uploadedLicsFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLicsFileMap[file.name]
      }
      $('form').find('input[name="lics_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($task) && $task->lics_file)
          var files =
            {!! json_encode($task->lics_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="lics_file[]" value="' + file.file_name + '">')
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