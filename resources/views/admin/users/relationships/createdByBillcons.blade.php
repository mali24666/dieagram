<div class="m-3">
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
            {{ trans('cruds.billcon.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-createdByBillcons">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.task_no') }}
                            </th>
                            <th>
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
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.enjaz') }}
                            </th>
                            <th>
                                {{ trans('cruds.task.fields.enjaz_stuts') }}
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
                            <th>
                                {{ trans('cruds.lic.fields.e_length') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.sarameek') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.created_by') }}
                            </th>
                            <th>
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
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.totall') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.totall_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.totall_3') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.totall_4') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.enjaz') }}
                            </th>
                            <th>
                                {{ trans('cruds.billcon.fields.account_department') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($billcons as $key => $billcon)
                            <tr data-entry-id="{{ $billcon->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $billcon->id ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->name ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->length_total ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->city ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->move_to_con_date ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->esfelt_done ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->task_no->enjaz ?? '' }}
                                </td>
                                <td>
                                    @if($billcon->task_no)
                                        {{ $billcon->task_no::ENJAZ_STUTS_SELECT[$billcon->task_no->enjaz_stuts] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $billcon->task_no->con ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->mokusa->license_no ?? '' }}
                                </td>
                                <td>
                                    @if($billcon->mokusa)
                                        {{ $billcon->mokusa::DEPARTMENT_SELECT[$billcon->mokusa->department] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @if($billcon->mokusa)
                                        {{ $billcon->mokusa::STUTS_SELECT[$billcon->mokusa->stuts] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $billcon->mokusa->e_length ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->mokusa->sarameek ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->created_by->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Billcon::JOB_1_SELECT[$billcon->job_1] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Billcon::JOB_2_SELECT[$billcon->job_2] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Billcon::JOB_3_SELECT[$billcon->job_3] ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->count_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->count_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->count_3 ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->totall ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->totall_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->totall_3 ?? '' }}
                                </td>
                                <td>
                                    {{ $billcon->totall_4 ?? '' }}
                                </td>
                                <td>
                                    @foreach($billcon->enjaz as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ App\Models\Billcon::ACCOUNT_DEPARTMENT_SELECT[$billcon->account_department] ?? '' }}
                                </td>
                                <td>
                                    @can('billcon_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.billcons.show', $billcon->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('billcon_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.billcons.edit', $billcon->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('billcon_delete')
                                        <form action="{{ route('admin.billcons.destroy', $billcon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('billcon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.billcons.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-createdByBillcons:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection