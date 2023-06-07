@extends('layouts.admin')
@section('content')

<div class="card" dir="rtl" >
    <div class="card-header" dir="rtl">
        تعديل مستخلص 
    </div>

    <div class="card-body" dir="rtl">
        <form dir="rtl"  method="POST" action="{{ route("admin.billcons.update", [$billcon->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <table lass="table" class="table table-bordered border-primary table-hover" >
                    <tr >
                        <td colspan="2">
                            <label class="required" for="task_no_id">{{ trans('cruds.billcon.fields.task_no') }}</label>

                        </td>
                        <td >
                            <select class="form-control select2 {{ $errors->has('task_no') ? 'is-invalid' : '' }}" name="task_no_id" id="task_no_id" required>
                                @foreach($task_nos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('task_no_id') ? old('task_no_id') : $billcon->task_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('task_no'))
                                <span class="text-danger">{{ $errors->first('task_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.billcon.fields.task_no_helper') }}</span>
            
                        </td>
                        <td colspan="2">
                            <label for="mokusa_id">{{ trans('cruds.billcon.fields.mokusa') }}</label>
 
                        </td>
                        <td colspan="2">
                            <select class="form-control select2 {{ $errors->has('mokusa') ? 'is-invalid' : '' }}" name="mokusa_id" id="mokusa_id">
                                @foreach($mokusas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('mokusa_id') ? old('mokusa_id') : $billcon->mokusa->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mokusa'))
                                <span class="text-danger">{{ $errors->first('mokusa') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.billcon.fields.mokusa_helper') }}</span>
            
                        </td>
                        <td colspan="2">
                            <label for="created_by_id">{{ trans('cruds.billcon.fields.created_by') }}</label>

                        </td>
                        <td colspan="2">
                            <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id">
                                @foreach($created_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('created_by_id') ? old('created_by_id') : $billcon->created_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('created_by'))
                                <span class="text-danger">{{ $errors->first('created_by') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.billcon.fields.created_by_helper') }}</span>
            
                        </td>

                    </tr>
                </table>

    </div>
</div>
<div class="card" dir="rtl">

        <table lass="table" class="table table-bordered border-primary table-hover" >
            <thead  class="table-warning">
                <tr >
                    <th scope="row"> </th>
                    <td colspan="5">البند</td>
                    <td colspan="2">الكمية </td>
                    <td colspan="2">السعر </td>
                    <td colspan="2">الاجمالي </td>
                    <td colspan="2">ملاحظات </td>

                </tr>
              </thead>
            <tbody>
                <tr >
                    <th scope="row"> 1</th>
                    <td colspan="5">
                        <div class="form-group">
                            <select readonly class="form-control {{ $errors->has('job_1') ? 'is-invalid' : '' }}" name="job_1" id="job_1" required>
                                <option value disabled {{ old('job_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_1', $billcon->job_1) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_1'))
                                <span class="text-danger">{{ $errors->first('job_1') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.billcon.fields.job_1_helper') }}</span>
                        </div>
        
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('count_1') ? 'is-invalid' : '' }}"  name="count_1" id="count_1" value="{{ old('count_1', $billcon->count_1) }}" >
                            @if($errors->has('count_1'))
                                <span class="text-danger">{{ $errors->first('count_1') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.billcon.fields.count_1_helper') }}</span>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('price_1') ? 'is-invalid' : '' }}" name="price_1" id="price_1" value="{{ old('price_1', $billcon->price_1) }}" >
                            @if($errors->has('price_1'))
                                <span class="text-danger">{{ $errors->first('price_1') }}</span>
                            @endif
                        </div>
        
                    </td>
                    <td colspan="2">
                        <input readonly class="form-control {{ $errors->has('totall') ? 'is-invalid' : '' }}"  name="totall" id="count_2" value="{{ old('totall', $billcon->totall) }}" >

                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('note_1') ? 'is-invalid' : '' }}" name="note_1" id="note_1" value="{{ old('note_1', $billcon->note_1) }}" >
                            @if($errors->has('note_1'))
                                <span class="text-danger">{{ $errors->first('price_1') }}</span>
                            @endif
                        </div>
        
                    </td>

                </tr>
                <tr >
                    <th scope="row"> 2</th>
                    <td colspan="5">
                        <div class="form-group">
                            <select readonly class="form-control {{ $errors->has('job_2') ? 'is-invalid' : '' }}" name="job_2" id="job_2" >
                                <option value disabled {{ old('job_2', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_2', $billcon->job_2) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_2'))
                                <span class="text-danger">{{ $errors->first('job_1') }}</span>
                            @endif
                        </div>
        
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('count_2') ? 'is-invalid' : '' }}"  name="count_2" id="count_2" value="{{ old('count_2', $billcon->count_2) }}" >
                            @if($errors->has('count_2'))
                                <span class="text-danger">{{ $errors->first('count_1') }}</span>
                            @endif
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('price_2') ? 'is-invalid' : '' }}" name="price_2" id="price_2" value="{{ old('price_2', $billcon->price_2) }}" >
                            @if($errors->has('price_2'))
                                <span class="text-danger">{{ $errors->first('price_1') }}</span>
                            @endif
                        </div>
        
                    </td>
                    <td colspan="2">
                        <input readonly class="form-control {{ $errors->has('totall_2') ? 'is-invalid' : '' }}"  name="totall_2" id="totall_2" value="{{ old('totall_2', $billcon->totall_2) }}" >

                    </td>
                </td>
                <td colspan="2">
                    <div class="form-group">
                        <input readonly class="form-control {{ $errors->has('note_1') ? 'is-invalid' : '' }}" name="note_1" id="note_1" value="{{ old('note_1', $billcon->note_1) }}" >
                        @if($errors->has('note_1'))
                            <span class="text-danger">{{ $errors->first('price_1') }}</span>
                        @endif
                    </div>
                </td>
                </tr>
                <tr >
                    <th scope="row"> 3</th>
                    <td colspan="5">
                        <div class="form-group">
                            <select readonly class="form-control {{ $errors->has('job_3') ? 'is-invalid' : '' }}" name="job_3" id="job_1" >
                                <option value disabled {{ old('job_3', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_3', $billcon->job_3) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_1'))
                                <span class="text-danger">{{ $errors->first('job_1') }}</span>
                            @endif
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('count_3') ? 'is-invalid' : '' }}"  name="count_3" id="count_3" value="{{ old('count_3', $billcon->count_3) }}" >
                            @if($errors->has('count_3'))
                                <span class="text-danger">{{ $errors->first('count_3') }}</span>
                            @endif
                        </div>
        
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <input readonly class="form-control {{ $errors->has('price_3') ? 'is-invalid' : '' }}" name="price_3" id="price_3" value="{{ old('price_3', $billcon->price_3) }}" >
                            @if($errors->has('price_3'))
                                <span class="text-danger">{{ $errors->first('price_1') }}</span>
                            @endif
                        </div>
        
                <td colspan="2">
                    <input readonly class="form-control {{ $errors->has('totall_3') ? 'is-invalid' : '' }}"  name="totall_3" id="totall_3" value="{{ old('totall_3', $billcon->totall_3) }}" >

                </td>
                <td colspan="2">
                    <div class="form-group">
                        <input readonly class="form-control {{ $errors->has('note_1') ? 'is-invalid' : '' }}" name="note_1" id="note_1" value="{{ old('note_1', $billcon->note_1) }}" >
                        @if($errors->has('note_1'))
                            <span class="text-danger">{{ $errors->first('price_1') }}</span>
                        @endif
                    </div>
    
                </td>

                </tr>
                <tr >
                    <th > </th>
                    <th colspan="8"> الاجمالي</th>
                    <td colspan="2">
                        <input  readonly class="form-control {{ $errors->has('totall_4') ? 'is-invalid' : '' }}"  name="totall_4" id="totall_4" value="{{ old('totall_4', $billcon->totall_4) }}" >
                    </th>
                </tr>   

                <tr >
                    <th > </th>
                    <td colspan="8"> خصم ضمان اعمال 5%</td>
                    <td colspan="2"> 
                      <input readonly class="form-control  type="number" name="descount_1" id="descount_1"value="{{ old('count_3', $billcon->descount_1) }}" >
                      @if($errors->has('descount_1'))
                      @endif
                    </td>
                </tr>   

                  <tr >
                      <th >                 
                      </th>
                      <td colspan="8"> خصم دفعات سابقه </td>
                      <td colspan="2"> 
                        <input readonly  class="form-control  type="number" name="descount_2" id="descount_2"value="{{ old('count_3', $billcon->descount_2) }}">
                        @if($errors->has('descount_2'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">   خصومات اخري</td>
                      <td colspan="2"> 
                        <input readonly class="form-control  type="number" name="descount_3" id="descount_3"value="{{ old('count_3', $billcon->descount_3) }}" >
                        @if($errors->has('descount_3'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">   خصم خرسانة </td>
                      <td colspan="2">
                        <input readonly class="form-control  type="number" name="descount_4" id="descount_4"value="{{ old('count_3', $billcon->descount_4) }}" >
                        @if($errors->has('descount_4'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">   تنظيف مقع   </td>
                      <td colspan="2"> 
                        <input readonly class="form-control  type="number" name="descount_5" id="descount_5" value="{{ old('count_3', $billcon->descount_5) }}" >
                        @if($errors->has('descount_5'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">    ترحيل مخلفات   </td>
                      <td colspan="2"> 
                        <input readonly class="form-control  type="number" name="descount_6" id="descount_6"value="{{ old('count_3', $billcon->descount_6) }}">
                        @if($errors->has('descount_6'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">امن وسلامه </td>
                      <td colspan="2">
                        <input readonly class="form-control  type="number" name="descount_7" id="descount_7"value="{{ old('count_3', $billcon->descount_7) }}" >
                        @if($errors->has('descount_7'))
                        @endif

                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">صب خرسانة مع اجرة العماله </td>
                      <td colspan="2">
                        <input readonly class="form-control  type="number" name="descount_8" id="descount_8"value="{{ old('count_3', $billcon->descount_8) }}" >
                        @if($errors->has('descount_8'))
                        @endif
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">اجمالي الاستقطاعات </td>
                      <td colspan="2">
                        <input readonly class="form-control {{ $errors->has('descount_9') ? 'is-invalid' : '' }}"  name="descount_9" id="descount_9" value="{{ old('descount_9', $billcon->descount_9) }}" >

                        <span id = "descount_9"></span> 
                      </td>
                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">ضريبة القيمة المضافة 15%</td>
                      <td colspan="2">
                        <input readonly class="form-control  type="number" name="descount_10" id="descount_10"value="{{ old('count_3', $billcon->descount_10) }}"  >
                        @if($errors->has('descount_10'))
                        @endif
                      </td>

                  </tr>   
                  <tr >
                      <th > </th>
                      <td colspan="8">المستحق صرفه </td>
                      <td colspan="2">
                        <input readonly class="form-control {{ $errors->has('descount_11') ? 'is-invalid' : '' }}"  name="descount_11" id="descount_11" value="{{ old('descount_11', $billcon->descount_11) }}" >

                      </td>
                  </tr>   

            </tbody>
        </table>

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
                <label>{{ trans('cruds.billcon.fields.account_department') }}</label>
                <select class="form-control {{ $errors->has('account_department') ? 'is-invalid' : '' }}" name="account_department" id="account_department">
                    <option value disabled {{ old('account_department', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Billcon::ACCOUNT_DEPARTMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('account_department', $billcon->account_department) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_department'))
                    <span class="text-danger">{{ $errors->first('account_department') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.account_department_helper') }}</span>
            </div>
            <div class="form-group" >
                <button  class="btn btn-primary" type="submit">
                                       حفظ التغيرات 
                </button>
            </div>
        </form>
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