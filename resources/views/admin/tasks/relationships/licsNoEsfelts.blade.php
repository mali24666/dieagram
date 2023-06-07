<div class="m-3">
    @can('esfelt_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.esfelts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.esfelt.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.esfelt.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-licsNoEsfelts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.lics_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.licses') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.work_done_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.city') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.length') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.lengtute') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.check_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.eng') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.cons') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.esfelt_pic') }}
                            </th>
                            <th>
                                {{ trans('cruds.esfelt.fields.eng_sign') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($esfelts as $key => $esfelt)
                            <tr data-entry-id="{{ $esfelt->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $esfelt->id ?? '' }}
                                </td>
                                <td>
                                    {{ $esfelt->lics_no->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($esfelt->licses as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($esfelt->work_done_pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $esfelt->city ?? '' }}
                                </td>
                                <td>
                                    {{ $esfelt->length ?? '' }}
                                </td>
                                <td>
                                    {{ $esfelt->lengtute ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $esfelt->check_1 ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $esfelt->check_1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $esfelt->eng->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Esfelt::CONS_SELECT[$esfelt->cons] ?? '' }}
                                </td>
                                <td>
                                    @foreach($esfelt->esfelt_pic as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($esfelt->eng_sign as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('esfelt_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.esfelts.show', $esfelt->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('esfelt_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.esfelts.edit', $esfelt->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('esfelt_delete')
                                        <form action="{{ route('admin.esfelts.destroy', $esfelt->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('esfelt_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.esfelts.massDestroy') }}",
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
  let table = $('.datatable-licsNoEsfelts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection