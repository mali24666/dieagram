<div class="m-3">
    @can('minibller_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.minibllers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.minibller.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.minibller.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-minibllarNotesMinibllers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.cb_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.minibller_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.minibller_x') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.minibller_y') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.minibller_photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.minibllar_notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.longitude') }}
                            </th>
                            <th>
                                {{ trans('cruds.minibller.fields.latitude') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($minibllers as $key => $minibller)
                            <tr data-entry-id="{{ $minibller->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $minibller->id ?? '' }}
                                </td>
                                <td>
                                    {{ $minibller->cb_number->trans_cb_fider_number ?? '' }}
                                </td>
                                <td>
                                    {{ $minibller->minibller_number ?? '' }}
                                </td>
                                <td>
                                    {{ $minibller->minibller_x ?? '' }}
                                </td>
                                <td>
                                    {{ $minibller->minibller_y ?? '' }}
                                </td>
                                <td>
                                    @if($minibller->minibller_photo)
                                        <a href="{{ $minibller->minibller_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $minibller->minibller_photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($minibller->minibllar_notes as $key => $item)
                                        <span class="badge badge-info">{{ $item->notes }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $minibller->longitude ?? '' }}
                                </td>
                                <td>
                                    {{ $minibller->latitude ?? '' }}
                                </td>
                                <td>
                                    @can('minibller_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.minibllers.show', $minibller->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('minibller_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.minibllers.edit', $minibller->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('minibller_delete')
                                        <form action="{{ route('admin.minibllers.destroy', $minibller->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('minibller_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.minibllers.massDestroy') }}",
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
  let table = $('.datatable-minibllarNotesMinibllers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection