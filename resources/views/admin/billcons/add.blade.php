@extends('layouts.admin')
@section('content')

<div class="card" dir="rtl">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.billcon.title_singular') }}
    </div>

    <div class="card-body" dir="rtl">

        <form method="POST" action="{{ route("admin.billcons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="container" dir="rtl">
              <table lass="table" class="table table-bordered border-primary table-hover  table-striped text-center" >
                <tr>
                  <th  scope="row">
                    <label for="task_no_id">{{ trans('cruds.billcon.fields.task_no') }}</label>
                  <br> <p name="task_no_id" value="{{$task_nos->id }}">{{ $task_nos->name }}</p> 
                  <div class="form-group" hidden>
                    <label for="task_no_id">{{ trans('cruds.billcon.fields.mokusa') }}</label>
                    <select  class="form-control select2 {{ $errors->has('task_no_id') ? 'is-invalid' : '' }}" name="task_no_id" id="task_no_id">
                        {{-- @foreach($mokusas as $id => $entry) --}}
                        <option value="{{$task_nos->id }}">{{$task_nos->name }}</option>                   
                        {{-- @endforeach --}}
                    </select>
                    @if($errors->has('mokusa'))
                        <span class="text-danger">{{ $errors->first('mokusa') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.billcon.fields.mokusa_helper') }}</span>

                  </th>
                  <th  scope="row">
                    <label for="created_by_id">{{ trans('cruds.billcon.fields.created_by') }}</label>
                    <span class="help-block">{{ trans('cruds.billcon.fields.created_by_helper') }}</span>
                    <p value="{{$add->id }}">{{$add->name }}</p>
                    <div  hidden>
                      <select   class="form-control select2 {{ $errors->has('created_by_id') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id">
                        {{-- @foreach($mokusas as $id => $entry) --}}
                        <option value="{{$add->id }}">{{$add->name }}</option>                   
                        {{-- @endforeach --}}
                    </select>

                  </th>
                  <th  scope="row">
                    اجمالي طول الرخصه : <br>
                    {{$task_nos->length_total }}
                  </th>
                </tr>
              </table>
              </div>

              {{-- اختيار رقم المقايسة وهو اختيار مخفي  --}}
            <div class="form-group" hidden>
                <label for="mokusa_id">{{ trans('cruds.billcon.fields.mokusa') }}</label>
                <select  class="form-control select2 {{ $errors->has('mokusa') ? 'is-invalid' : '' }}" name="mokusa_id" id="mokusa_id">
                    {{-- @foreach($mokusas as $id => $entry) --}}
                    <option value="{{$task_nos->lics_no_id }}">{{$task_nos->lics_no_id }}</option>                   
                    {{-- @endforeach --}}
                </select>
                @if($errors->has('mokusa'))
                    <span class="text-danger">{{ $errors->first('mokusa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.billcon.fields.mokusa_helper') }}</span>
            </div>


              <div class="card" dir="rtl">
                <div class="card-body" dir="rtl">
                    <table lass="table" class="table table-bordered border-primary table-hover  table-striped text-center" >
                      <thead>
                              <th colspan="12">
                                <h4>  بيان الااعمال </h4>
                              </th>
                          </thead>
                          <tbody>
                              <tr >
                                  <th scope="row">م </th>
                                  <th scope="row">توصيف البند طبقا لتنفيذ علي الطبيعه  </th>
                                  <th scope="row">الكمية </th>
                                  <th scope="row">السعر </th>
                                  <th scope="row">الاجمالي </th>
                                  <th scope="row">ملاحظات  </th>
  
                              </tr>   
                              <tr >
                                  <th scope="row">1 </th>
                                  <th scope="row">
                                    <select class="form-control {{ $errors->has('job_1') ? 'is-invalid' : '' }}" name="job_1" id="job_1" required>
                                        <option value disabled {{ old('job_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('job_1', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('job_1'))
                                        <span class="text-danger">{{ $errors->first('job_1') }}</span>
                                    @endif
                           
                                </th>
                                  <th 
                                  scope="row">
                                  <input oninput="multiplyBy()" class="form-control type="number" name="count_1" id="count_1" value= 0 >
                                  @if($errors->has('count_1'))
                                      <span class="text-danger">{{ $errors->first('count_1') }}</span>
                                  @endif
                
                                </th>
                                  <th scope="row">
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="price_1" id="price_1"value= 0   >
                                    @if($errors->has('price_1'))
                                        <span class="text-danger">{{ $errors->first('price_1') }}</span>
                                    @endif

                                  </th>
                                  <th scope="row"><span id = "result"></span>           
                                  </th>
                                  <th scope="row">
                                    <input class="form-control  type="text" name="note_1" id="note_1" >
                                    @if($errors->has('note_1'))
                                        <span class="text-danger">{{ $errors->first('note_1') }}</span>
                                    @endif
                                  </th>
                              </tr>     
                              <tr >
                                <th scope="row">2 </th>
                                <th scope="row">
                                  <select class="form-control {{ $errors->has('job_1') ? 'is-invalid' : '' }}" name="job_2" id="job_1" required>
                                      <option value disabled {{ old('job_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                      @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                          <option value="{{ $key }}" {{ old('job_1', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                      @endforeach
                                  </select>
                                  @if($errors->has('job_1'))
                                      <span class="text-danger">{{ $errors->first('job_1') }}</span>
                                  @endif
                         
                              </th>
                                <th 
                                scope="row">
                                <input oninput="multiplyBy()" class="form-control type="number" name="count_2" id="count_2" value= 0  >
                                @if($errors->has('count_2'))
                                    <span class="text-danger">{{ $errors->first('count_2') }}</span>
                                @endif
              
                              </th>
                                <th scope="row">
                                  <input oninput="multiplyBy()" class="form-control  type="number" name="price_2" id="price_2"value= 0  >
                                  @if($errors->has('price_2'))
                                      <span class="text-danger">{{ $errors->first('price_2') }}</span>
                                  @endif

                                </th>
                                <th scope="row"><span id = "resul2"> </th>
                                <th scope="row">
                                  <input class="form-control  type="text" name="note_2" id="note_2" >
                                  @if($errors->has('note_2'))
                                      <span class="text-danger">{{ $errors->first('note_2') }}</span>
                                  @endif
                                </th>
                            </tr>  
                            <tr >
                              <th scope="row">3 </th>
                              <th scope="row">
                                <select class="form-control {{ $errors->has('job_3') ? 'is-invalid' : '' }}" name="job_3" id="job_3" >
                                    <option value disabled {{ old('job_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('job_1', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('job_1'))
                                    <span class="text-danger">{{ $errors->first('job_1') }}</span>
                                @endif
                       
                            </th>
                              <th 
                              scope="row">
                              <input oninput="multiplyBy()" class="form-control type="number" name="count_3" id="count_3" value= 0  >
                              @if($errors->has('count_3'))
                                  <span class="text-danger">{{ $errors->first('count_3') }}</span>
                              @endif
            
                            </th>
                              <th scope="row">
                                <input oninput="multiplyBy()" class="form-control  type="number" name="price_3" id="price_3"value= 0   >
                                @if($errors->has('price_3'))
                                    <span class="text-danger">{{ $errors->first('price_3') }}</span>
                                @endif

                              </th>
                              <th scope="row"> <span id = "resul3"></th>
                              <th scope="row">
                                <input class="form-control  type="text" name="note_3" id="note_3" >
                                @if($errors->has('note_3'))
                                    <span class="text-danger">{{ $errors->first('note_3') }}</span>
                                @endif
                              </th>
                          </tr>            
  
                              <tr >
                                  <th colspan="row"> </th>
                                  <th colspan="3"> الاجمالي</th>
                                  <td colspan="row">    <span id = "totall"></span>   </th>
                              </tr>   
                              <tr >
                                <th > </th>
                                <td colspan="3"> خصم ضمان اعمال 5%</td>
                                <td colspan="row"> 
                                  <input oninput="multiplyBy()" class="form-control  type="number" name="descount_1" id="descount_1"value= 0 >
                                  @if($errors->has('descount_1'))
                                  @endif
                                </td>
                            </tr>   

                              <tr >
                                  <th >                 
                                  </th>
                                  <td colspan="3"> خصم دفعات سابقه </td>
                                  <td colspan="row"> 
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_2" id="descount_2"value= 0 >
                                    @if($errors->has('descount_2'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">   خصومات اخري</td>
                                  <td colspan="row"> 
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_3" id="descount_3" value= 0   >
                                    @if($errors->has('descount_3'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">   خصم خرسانة </td>
                                  <td colspan="row">
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_4" id="descount_4"value= 0  >
                                    @if($errors->has('descount_4'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">   تنظيف مقع   </td>
                                  <td colspan="row"> 
                                    <input oninput="multiplyBy()"  class="form-control  type="number" name="descount_5" id="descount_5"value= 0  >
                                    @if($errors->has('descount_5'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">    ترحيل مخلفات   </td>
                                  <td colspan="row"> 
                                    <input oninput="multiplyBy()"  class="form-control  type="number" name="descount_6" id="descount_6" value= 0  >
                                    @if($errors->has('descount_6'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">امن وسلامه </td>
                                  <td colspan="row">
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_7" id="descount_7"value= 0   >
                                    @if($errors->has('descount_7'))
                                    @endif

                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">صب خرسانة مع اجرة العماله </td>
                                  <td colspan="row">
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_8" id="descount_8" value= 0   >
                                    @if($errors->has('descount_8'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">اجمالي الاستقطاعات </td>
                                  <td colspan="row">
                                    <span id = "descount_9"></span> 
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">ضريبة القيمة المضافة 15%</td>
                                  <td colspan="row">
                                    <input oninput="multiplyBy()" class="form-control  type="number" name="descount_10" id="descount_10" value= 0  >
                                    @if($errors->has('descount_10'))
                                    @endif
                                  </td>
                              </tr>   
                              <tr >
                                  <th > </th>
                                  <td colspan="3">المستحق صرفه </td>
                                  <td colspan="row">
                                    <span id = "descount_11"></span> 

                                  </td>
                              </tr>   
                          </tbody>
                        </table>
    
    
            <div class="col">
                <br>
            </div>
          </div>
          <div class="form-group">
        </div>
          <div class="col">

            {{-- <input type="button" oninput="multiplyBy()" Value="اظهار قيمة المستخلص " />
             </div> --}}

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

      </form>
  </div>
</div>
@endsection

@section('scripts')
<script>

function multiplyBy()
{
 let count_1 =parseInt( document.getElementById("count_1").value);
 let count_2 = parseInt( document.getElementById("count_2").value);
 let count_3 =parseInt( document.getElementById("count_3").value);

 let price_1 =parseInt( document.getElementById("price_1").value);
 let price_2 =parseInt( document.getElementById("price_2").value);
 let price_3 = parseInt(document.getElementById("price_3").value);

let result =parseInt(price_1 * count_1);
let resul2 =parseInt(price_2 * count_2);
let resul3 =parseInt(price_3 * count_3);

let descount_1 = parseInt(document.getElementById("descount_1").value);
let descount_2 =parseInt( document.getElementById("descount_2").value);
let descount_3 =parseInt( document.getElementById("descount_3").value);
let descount_4 =parseInt( document.getElementById("descount_4").value);
let descount_5 =parseInt( document.getElementById("descount_5").value);
let descount_6 =parseInt( document.getElementById("descount_6").value);
let descount_7 =parseInt( document.getElementById("descount_7").value);
let descount_8 =parseInt( document.getElementById("descount_8").value);
let descount_10 =parseInt( document.getElementById("descount_10").value);

let descount_9 =(descount_1)+(descount_2)+(descount_3)+(descount_4)+(descount_5)+(descount_6)+(descount_7)+(descount_8);
        document.getElementById("result").innerHTML = result;
        document.getElementById("resul2").innerHTML = resul2;
        document.getElementById("resul3").innerHTML = resul3;
        let totall =parseInt(result + resul2 +resul3);

        document.getElementById("totall").innerHTML = totall;
        // document.getElementById("result").innerHTML = totall;

        document.getElementById("descount_9").innerHTML = descount_9;

        
        // document.getElementById("descount_9").innerHTML = descount_1 + descount_2 + descount_3;
      //  let descount_10a =parseInt(descount_10);
      //  let totalla =parseInt(totall);
      //  let descount_9a =parseInt(descount_9);
       let descount_12= descount_10 + descount_9;
        // let descount_11 =(totall*1)-(descount_9*1)-(descount_10*1);
        // let descount_12a =parseInt(descount_12);
        let descount_11A = totall - descount_12 ;

        // descount_11 =typeof(descount_11A);
        document.getElementById("descount_11").innerHTML = descount_11A;

}


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