<div class="m-3">
    @can('line_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.lines.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.line.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.line.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-endPointLines">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.line.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.line.fields.start_point_station') }}
                            </th>
                            <th>
                                {{ trans('cruds.station.fields.location') }}
                            </th>
                            <th>
                                {{ trans('cruds.line.fields.end_point') }}
                            </th>
                            <th>
                                {{ trans('cruds.transeformer.fields.serial_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.transeformer.fields.latitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.transeformer.fields.longitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.line.fields.start_point_tran') }}
                            </th>
                            <th>
                                {{ trans('cruds.line.fields.line_no') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lines as $key => $line)
                            <tr data-entry-id="{{ $line->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $line->id ?? '' }}
                                </td>
                                <td>
                                    {{ $line->start_point_station->station_no ?? '' }}
                                </td>
                                <td>
                                    {{ $line->start_point_station->location ?? '' }}
                                </td>
                                <td>
                                    {{ $line->end_point->t_no ?? '' }}
                                </td>
                                <td>
                                    {{ $line->end_point->serial_no ?? '' }}
                                </td>
                                <td>
                                    {{ $line->end_point->latitude ?? '' }}
                                </td>
                                <td>
                                    {{ $line->end_point->longitude ?? '' }}
                                </td>
                                <td>
                                    {{ $line->start_point_tran->t_no ?? '' }}
                                </td>
                                <td>
                                    {{ $line->line_no ?? '' }}
                                </td>
                                <td>
                                    @can('line_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.lines.show', $line->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('line_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.lines.edit', $line->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('line_delete')
                                        <form action="{{ route('admin.lines.destroy', $line->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lines.massDestroy') }}",
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
  let table = $('.datatable-endPointLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection