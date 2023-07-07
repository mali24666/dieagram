<div class="m-3">
    @can('contractor_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.contractors.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.contractor.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.contractor.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userContractors">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.alert_text') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.lices_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.lices_file') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.tradic_lices') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.stc') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.site_ready') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.date_time') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.contractor.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contractors as $key => $contractor)
                            <tr data-entry-id="{{ $contractor->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $contractor->id ?? '' }}
                                </td>
                                <td>
                                    {{ $contractor->alert_text ?? '' }}
                                </td>
                                <td>
                                    @foreach($contractor->users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $contractor->lices_no->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($contractor->lices_file as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($contractor->tradic_lices as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($contractor->stc as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($contractor->pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $contractor->site_ready ?? '' }}
                                </td>
                                <td>
                                    {{ $contractor->date_time ?? '' }}
                                </td>
                                <td>
                                    {{ $contractor->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $contractor->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('contractor_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.contractors.show', $contractor->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('contractor_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.contractors.edit', $contractor->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('contractor_delete')
                                        <form action="{{ route('admin.contractors.destroy', $contractor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contractor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contractors.massDestroy') }}",
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
  let table = $('.datatable-userContractors:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection