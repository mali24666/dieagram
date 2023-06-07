@extends('layouts.admin')
@section('content')
@can('lic_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lics.create') }}">
طلب رخصة جديده             </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
قائمة بجميع الطلبات     </div>

<div class="card-body">
    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Lic">
        <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.lic.fields.created_at') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.department') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.license_no') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.esnad') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.city') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.stuts') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.order_stauts') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.naseg_no') }}
                </th>
                <th>
                    {{ trans('cruds.lic.fields.task_number') }}
                </th>
                <th>
طالب الرخصه                 </th>
                <th>
                    {{ trans('cruds.lic.fields.updated_at') }}
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                    <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                </td>
                <td>
                </td>
                <td>
                    <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                </td>
                <td>
                    <select class="search" strict="true">
                        <option value>{{ trans('global.all') }}</option>
                        @foreach(App\Models\Lic::STUTS_SELECT as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="search" strict="true">
                        <option value>{{ trans('global.all') }}</option>
                        @foreach(App\Models\Lic::ORDER_STAUTS_SELECT as $key => $item)
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
                    <select class="search">
                        <option value>{{ trans('global.all') }}</option>
                        @foreach($users as $key => $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('lic_delete')
let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
let deleteButton = {
text: deleteButtonTrans,
url: "{{ route('admin.lics.massDestroy') }}",
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
ajax: "{{ route('admin.lics.index') }}",
columns: [
  { data: 'placeholder', name: 'placeholder' },
{ data: 'created_at', name: 'created_at' },
{ data: 'department', name: 'department' },
{ data: 'license_no', name: 'license_no' },
{ data: 'esnad', name: 'esnad' },
{ data: 'city', name: 'city' },
{ data: 'stuts', name: 'stuts' },
{ data: 'order_stauts', name: 'order_stauts' },
{ data: 'naseg_no', name: 'naseg_no' },
{ data: 'task_number', name: 'task_number' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'updated_at', name: 'updated_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
],
orderCellsTop: true,
order: [[ 1, 'desc' ]],
pageLength: 35,
};
let table = $('.datatable-Lic').DataTable(dtOverrideGlobals);
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