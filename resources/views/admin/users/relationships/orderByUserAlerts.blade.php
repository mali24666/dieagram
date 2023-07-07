<div class="m-3">
    @can('user_alert_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-alerts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userAlert.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userAlert.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderByUserAlerts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.alert_text') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.lices_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.alert_link') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.pic_after') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.eng_sign_photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.order_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userAlerts as $key => $userAlert)
                            <tr data-entry-id="{{ $userAlert->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $userAlert->id ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->alert_text ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->lices_no->name ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->alert_link ?? '' }}
                                </td>
                                <td>
                                    @foreach($userAlert->users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($userAlert->pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($userAlert->pic_after as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($userAlert->eng_sign_photo as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $userAlert->order_by->name ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('user_alert_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.user-alerts.show', $userAlert->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('user_alert_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.user-alerts.edit', $userAlert->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('user_alert_delete')
                                        <form action="{{ route('admin.user-alerts.destroy', $userAlert->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_alert_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-alerts.massDestroy') }}",
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
  let table = $('.datatable-orderByUserAlerts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection