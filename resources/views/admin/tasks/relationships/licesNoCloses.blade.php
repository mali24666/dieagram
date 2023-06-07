<div class="m-3">
    @can('close_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.closes.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.close.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.close.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-licesNoCloses">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.close.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.close.fields.lices_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.close.fields.after_esfelt') }}
                            </th>
                            <th>
                                {{ trans('cruds.close.fields.eng_sign') }}
                            </th>
                            <th>
                                {{ trans('cruds.close.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.close.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($closes as $key => $close)
                            <tr data-entry-id="{{ $close->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $close->id ?? '' }}
                                </td>
                                <td>
                                    {{ $close->lices_no->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($close->after_esfelt as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($close->eng_sign as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $close->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $close->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('close_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.closes.show', $close->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('close_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.closes.edit', $close->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('close_delete')
                                        <form action="{{ route('admin.closes.destroy', $close->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('close_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.closes.massDestroy') }}",
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
  let table = $('.datatable-licesNoCloses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection