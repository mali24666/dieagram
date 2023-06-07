<div class="m-3">
    @can('extract_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.extracts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.extract.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.extract.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-engSignExtracts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.extract_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.extract_file') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.order') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.work_done') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.lics_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.eng_sign') }}
                            </th>
                            <th>
                                {{ trans('cruds.licsdone.fields.enddate') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.lics_end') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.con') }}
                            </th>
                            <th>
                                {{ trans('cruds.extract.fields.created_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($extracts as $key => $extract)
                            <tr data-entry-id="{{ $extract->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $extract->id ?? '' }}
                                </td>
                                <td>
                                    {{ $extract->extract_no ?? '' }}
                                </td>
                                <td>
                                    @foreach($extract->extract_file as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $extract->order->license_no ?? '' }}
                                </td>
                                <td>
                                    @foreach($extract->work_done as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ App\Models\Extract::LICS_STATUS_SELECT[$extract->lics_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $extract->eng_sign->eng_sign ?? '' }}
                                </td>
                                <td>
                                    {{ $extract->eng_sign->enddate ?? '' }}
                                </td>
                                <td>
                                    {{ $extract->lics_end ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Extract::CON_SELECT[$extract->con] ?? '' }}
                                </td>
                                <td>
                                    {{ $extract->created_at ?? '' }}
                                </td>
                                <td>
                                    @can('extract_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.extracts.show', $extract->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('extract_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.extracts.edit', $extract->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('extract_delete')
                                        <form action="{{ route('admin.extracts.destroy', $extract->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('extract_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.extracts.massDestroy') }}",
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
  let table = $('.datatable-engSignExtracts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection