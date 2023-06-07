<div class="m-3">
    @can('lic_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.lics.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.lic.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.lic.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-licsesNumberLics">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.department') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.license_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.datestary') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.date_end') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.longtude') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.path') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.license_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.stuts') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.e_length') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.t_length') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.wide') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.con') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.order_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.order_stauts') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.order_reject') }}
                            </th>
                            <th>
                                {{ trans('cruds.lic.fields.licses_number') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lics as $key => $lic)
                            <tr data-entry-id="{{ $lic->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $lic->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Lic::DEPARTMENT_SELECT[$lic->department] ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->license_no ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->datestary ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->date_end ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->city ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->longtude ?? '' }}
                                </td>
                                <td>
                                    @foreach($lic->path as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($lic->license_pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ App\Models\Lic::STUTS_SELECT[$lic->stuts] ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->e_length ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->t_length ?? '' }}
                                </td>
                                <td>
                                    {{ $lic->wide ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Lic::CON_SELECT[$lic->con] ?? '' }}
                                </td>
                                <td>
                                    @foreach($lic->order_pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ App\Models\Lic::ORDER_STAUTS_SELECT[$lic->order_stauts] ?? '' }}
                                </td>
                                <td>
                                    @foreach($lic->order_reject as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $lic->licses_number->extract_no ?? '' }}
                                </td>
                                <td>
                                    @can('lic_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.lics.show', $lic->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('lic_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.lics.edit', $lic->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('lic_delete')
                                        <form action="{{ route('admin.lics.destroy', $lic->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('lic_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lics.massDestroy') }}",
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
  let table = $('.datatable-licsesNumberLics:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection