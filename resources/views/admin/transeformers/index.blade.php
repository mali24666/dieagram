@extends('layouts.admin')
@section('content')
@can('transeformer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transeformers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transeformer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transeformer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transeformer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.t_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.picture_befor') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.cb_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.feeder') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.box') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.transe_note') }}
                        </th>
                        <th>
                            {{ trans('cruds.transeformer.fields.updated_at') }}
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
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($cbs as $key => $item)
                                    <option value="{{ $item->trans_cb_fider_number }}">{{ $item->trans_cb_fider_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($lines as $key => $item)
                                    <option value="{{ $item->line_no }}">{{ $item->line_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($boxes as $key => $item)
                                    <option value="{{ $item->box_number }}">{{ $item->box_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($allnotes as $key => $item)
                                    <option value="{{ $item->t_notes }}">{{ $item->t_notes }}</option>
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
                <tbody>
                    @foreach($transeformers as $key => $transeformer)
                        <tr data-entry-id="{{ $transeformer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transeformer->t_no ?? '' }}
                            </td>
                            <td>
                                @foreach($transeformer->picture_befor as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $transeformer->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $transeformer->cb_no->trans_cb_fider_number ?? '' }}
                            </td>
                            <td>
                                {{ $transeformer->feeder->line_no ?? '' }}
                            </td>
                            <td>
                                @foreach($transeformer->boxes as $key => $item)
                                    <span class="badge badge-info">{{ $item->box_number }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($transeformer->transe_notes as $key => $item)
                                    <span class="badge badge-info">{{ $item->t_notes }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $transeformer->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('transeformer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transeformers.show', $transeformer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('transeformer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transeformers.edit', $transeformer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('transeformer_delete')
                                    <form action="{{ route('admin.transeformers.destroy', $transeformer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transeformer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transeformers.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-Transeformer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
})

</script>
@endsection