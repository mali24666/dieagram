@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="form-group">
    <div class="card-body" dir="rtl">
        <div class="row"  style="background-color: yellow">
            <div class="col">
            </div>
            <div class="col">
                ادارة                            
            </div>
            <div class="col">
                {{ App\Models\Lic::DEPARTMENT_SELECT[ $billcon->mokusa->department] ?? '' }}
            </div>
            <div class="col">
            </div>

        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="form-group">
    <div class="card-body" dir="rtl">
        <table lass="table" class="table table-bordered border-primary table-hover  table-striped text-center" >
            <tr >
                <th scope="row"> رقم المستخلص  :  <br> {{ $billcon->id }}</th>
                <th scope="row"> رقم التصريح :{{ $billcon->task_no->name }} </th>
                <th scope="row">رقم  المقايسه    : <br> {{ $billcon->mokusa->license_no ?? '' }} </th>
                <th scope="row">نوع الرخصة ; <br>  {{ App\Models\Lic::STUTS_SELECT[ $billcon->mokusa->stuts] ?? '' }} </th>
                <th scope="row"> اسم المشروع   : {{ $billcon->note_1 }} </th>
                <th scope="row"> تاريخ اصدار شهادة الانجاز:    @foreach($billcon->enjaz as $key => $media)
                    <a href="{{ $media->getUrl() }}" target="_blank">
                        {{ $billcon->task_no->enjaz }}
                    </a>
                @endforeach
                </th>

                <td>
                </td>

            </tr>  
            <tr >
                <th scope="row">  اسم المقاول  :<br>  {{ App\Models\Task::CONS_SELECT[ $billcon->task_no->con] ?? '' }}</th>
                <th scope="row">   الموقع  : <br> {{ $billcon->task_no->city }}</th>
                <th scope="row"> تاريخ المستخلص :<br> {{ $billcon->created_at }}</th>
                <th scope="row">اجمالي طول الرخصه  :<br> {{ $billcon->task_no->length_total }} </th>
                <th colspan="3"> 
                    للاعمال المنجزة من تاريخ                         {{ $billcon->task_no->start_time }}
                    الي تاريخ                         {{ $billcon->task_no->due_date  }}


                </th>

            </tr>   

        </table>

    </div>
</div>
</div>

  </div>
        <div class="card" dir="rtl">
            <div class="card-body" dir="rtl">
                <table lass="table" class="table table-bordered border-primary table-hover  table-striped text-center" >
                    <thead >
                            <th colspan="12">
                              <h4>  بيان الااعمال </h4>
                            </th>
                            <tr class="table-warning">
                                <th scope="row">م </th>
                                <th scope="row">توصيف البند طبقا لتنفيذ علي الطبيعه  </th>
                                <th scope="row">الكمية </th>
                                <th scope="row">السعر </th>
                                <th scope="row">الاجمالي </th>
                                <th colspan="6">ملاحظات  </th>

                            </tr>   
                        </thead>
                        <tbody>

                            <tr >
                                <th scope="row">1 </th>
                                <th scope="row">
                                    {{ App\Models\Billcon::JOB_1_SELECT[$billcon->job_1] ?? '' }}
                                </th>
                                <th scope="row">{{ $billcon->count_1 }} </th>
                                <th scope="row">{{ $billcon->price_1 }} </th>
                                <th scope="row">{{ $billcon->totall }} </th>
                                <th colspan="6">{{ $billcon->note_1 }} </th>

                            </tr>            
                            <tr >
                                <th scope="row">2 </th>
                                <th scope="row"> {{ App\Models\Billcon::JOB_2_SELECT[$billcon->job_2] ?? '' }} </td>
                                <th scope="row">{{ $billcon->count_2 }} </th>
                                <th scope="row">{{ $billcon->price_2 }} </th>
                                <th scope="row">{{ $billcon->totall_2 }} </th>
                                <td colspan="6">{{ $billcon->note_2 }} </td>

                            </tr>            
                            <tr >
                                <th scope="row">3 </th>
                                <th colspan="row"> {{ App\Models\Billcon::JOB_3_SELECT[$billcon->job_3] ?? '' }} </td>
                                <th colspan="row"> {{ $billcon->count_3 }} </th>
                                <th colspan="row">{{ $billcon->price_3 }} </th>
                                <th colspan="row">{{ $billcon->totall_3 }} </th>
                                <th colspan="6">{{ $billcon->note_3 }} </th>

                            </tr>            
                            <tr >
                                <th colspan="row"> </th>
                                <th colspan="3"> الاجمالي</th>
                                <td colspan="row">{{ $billcon->totall_4}} </th>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3"> خصم ضمان اعمال 5%</td>
                                <td colspan="row">{{ $billcon->descount_1}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3"> خصم دفعات سابقه </td>
                                <td colspan="row">{{ $billcon->descount_2}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">   خصومات اخري</td>
                                <td colspan="row">{{ $billcon->descount_3}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">   خصم خرسانة </td>
                                <td colspan="row">{{ $billcon->descount_4}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">   تنظيف مقع   </td>
                                <td colspan="row">{{ $billcon->descount_5}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">    ترحيل مخلفات   </td>
                                <td colspan="row">{{ $billcon->descount_6}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">امن وسلامه </td>
                                <td colspan="row">{{ $billcon->descount_7}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">صب خرسانة مع اجرة العماله </td>
                                <td colspan="row">{{ $billcon->descount_8}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3">اجمالي الاستقطاعات </td>
                                <td colspan="row">{{ $billcon->descount_9}} </td>
                            </tr>   
                            <tr >
                                <th > </th>
                                <td colspan="3"> ضريبة القيمة المضافة  </td>
                                <td colspan="row">{{ $billcon->descount_10}} </td>
                            </tr>   

                            <tr >
                                <th > </th>
                                <td colspan="3">المستحق صرفه </td>
                                <td colspan="row">{{ $billcon->descount_11}} </td>
                            </tr>   
                        </tbody>
                    </table>
                    <table lass="table" class="table table-bordered border-primary table-hover  table-striped text-center" >
                        <thead >    
                            <tr >
                                <th scope="row">قسم الاسفلت  </th>
                                <td scope="row"> المهندس المنفذ</td>
                                <td scope="row">المدير المباشر  </td>
                                <td scope="row">المدير التنفيذي </td>
                                <td scope="row">الادارة المالية  </td>
                                <td scope="row"> المدير العام   </td>
                            </tr>   
                        </thead>
                        <tbody>
                            <tr >
                                
                                <th scope="row">{{ $billcon->created_by->name ?? '' }}</th>
                                <td scope="row">{{ $billcon->created_by->name ?? '' }}</td>
                                <td scope="row">   </td>
                                <td scope="row">  </td>
                                <td scope="row">   </td>
                                <td scope="row">     </td>
                            </tr>
                            <tr >
                                <th scope="row">   </th>
                                <td scope="row">  </td>
                                <td scope="row">   </td>
                                <td scope="row">  </td>
                                <td scope="row">   </td>
                                <td scope="row">     </td>
                            </tr>   

            </div>
        </tbody>
    </table>
@endsection
