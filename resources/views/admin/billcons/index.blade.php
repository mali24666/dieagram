@extends('layouts.admin')
@section('content')
@can('billcon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.billcons.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.billcon.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
            المستخلصات 
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Billcon">
            <thead>
                <tr>
                    <th width="10"> 
                    </th>
                    <th>
                        رقم المستخلص 

                    </th>    
                    <th>
                        &nbsp;

                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.task_no') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.task.fields.length_total') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.move_to_con_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.esfelt_done') }}
                    </th> --}}
                    <th>
                            اجمالي اطوال الرخصه                     </th>
                    <th>
                            الموقع 
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.con') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.mokusa') }}
                    </th>
                    <th>
                        {{ trans('cruds.lic.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.lic.fields.stuts') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.lic.fields.e_length') }}
                    </th>
                    <th>
                        {{ trans('cruds.lic.fields.sarameek') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.billcon.fields.created_by') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.billcon.fields.job_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.job_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.job_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.count_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.count_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.count_3') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.billcon.fields.totall') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.totall_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.totall_3') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.billcon.fields.totall_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.billcon.fields.account_department') }}
                    </th>

                    <th>
                        {{ trans('cruds.billcon.fields.enjaz') }}
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>   
                          <input class="search" type="text" placeholder="{{ trans('global.search') }}">

                    </td>

                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">

                        {{-- <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($tasks as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}
                    </td>
                    {{-- <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td> --}}
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Task::CONS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>                  
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">

                        {{-- <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($lics as $key => $item)
                                <option value="{{ $item->license_no }}">{{ $item->license_no }}</option>
                            @endforeach
                        </select> --}}
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Lic::DEPARTMENT_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Lic::STUTS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
    
                    </td>
                    {{-- <td>
                    </td>
                    <td>
                    </td> --}}
                   <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                   {{--   <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Billcon::JOB_1_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Billcon::JOB_2_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Billcon::JOB_3_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>--}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>  
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Billcon::ACCOUNT_DEPARTMENT_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>

                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('billcon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.billcons.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.billcons.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'actions', name: '{{ trans('global.actions') }}' },    

{ data: 'task_no_name', name: 'task_no.name' },
{ data: 'task_no.length_total', name: 'task_no.length_total' },

{ data: 'task_no.city', name: 'task_no.city' },
// { data: 'task_no.move_to_con_date', name: 'task_no.move_to_con_date' },
// { data: 'task_no.esfelt_done', name: 'task_no.esfelt_done' },
// { data: 'task_no.enjaz', name: 'task_no.enjaz' },
// { data: 'task_no.enjaz_stuts', name: 'task_no.enjaz_stuts' },
{ data: 'task_no.con', name: 'task_no.con' },
{ data: 'mokusa_license_no', name: 'mokusa.license_no' },
{ data: 'mokusa.department', name: 'mokusa.department' },
{ data: 'mokusa.stuts', name: 'mokusa.stuts' },
// { data: 'mokusa.e_length', name: 'mokusa.e_length' },
// { data: 'mokusa.sarameek', name: 'mokusa.sarameek' },
{ data: 'created_by_name', name: 'created_by.name' },
// { data: 'job_1', name: 'job_1' },
// { data: 'job_2', name: 'job_2' },
// { data: 'job_3', name: 'job_3' },
// { data: 'count_1', name: 'count_1' },
// { data: 'count_2', name: 'count_2' },
// { data: 'count_3', name: 'count_3' },
// { data: 'totall', name: 'totall' },
// { data: 'totall_2', name: 'totall_2' },
// { data: 'totall_3', name: 'totall_3' },
{ data: 'descount_11', name: 'descount_11' },
{ data: 'account_department', name: 'account_department' },
{ data: 'enjaz', name: 'enjaz', sortable: false, searchable: false },
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Billcon').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection