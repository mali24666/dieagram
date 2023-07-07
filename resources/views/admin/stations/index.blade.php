@extends('layouts.admin')
@section('content')
@can('station_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.stations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.station.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.station.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Station">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.station.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.station_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.feeders') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.trans') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.box_cosutomer') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.ct_station') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.rmu') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.auto_closer') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.section_lazy') }}
                        </th>
                        <th>
                            {{ trans('cruds.station.fields.avr') }}
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                @foreach($transeformers as $key => $item)
                                    <option value="{{ $item->t_no }}">{{ $item->t_no }}</option>
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
                                @foreach($cts as $key => $item)
                                    <option value="{{ $item->ct_no }}">{{ $item->ct_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($rmus as $key => $item)
                                    <option value="{{ $item->rmu_no }}">{{ $item->rmu_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($autoreclosers as $key => $item)
                                    <option value="{{ $item->auto_recloser_no }}">{{ $item->auto_recloser_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($section_lazies as $key => $item)
                                    <option value="{{ $item->section_lazey }}">{{ $item->section_lazey }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($avrs as $key => $item)
                                    <option value="{{ $item->avr_no }}">{{ $item->avr_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stations as $key => $station)
                        <tr data-entry-id="{{ $station->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $station->id ?? '' }}
                            </td>
                            <td>
                                {{ $station->station_no ?? '' }}
                            </td>
                            <td>
                                {{ $station->location ?? '' }}
                            </td>
                            <td>
                                @foreach($station->feeders as $key => $item)
                                    <span class="badge badge-info">
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.lines.fetchfeeder', $item->id) }}">
                                            {{ $item->line_no }}
                                        </a>
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->trans as $key => $item)
                                    <span class="badge badge-info">{{ $item->t_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->box_cosutomers as $key => $item)
                                    <span class="badge badge-info">{{ $item->box_number }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->ct_stations as $key => $item)
                                    <span class="badge badge-info">{{ $item->ct_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->rmus as $key => $item)
                                    <span class="badge badge-info">{{ $item->rmu_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->auto_closers as $key => $item)
                                    <span class="badge badge-info">{{ $item->auto_recloser_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->section_lazies as $key => $item)
                                    <span class="badge badge-info">{{ $item->section_lazey }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($station->avrs as $key => $item)
                                    <span class="badge badge-info">{{ $item->avr_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('station_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.stations.show', $station->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('station_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.stations.edit', $station->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('station_delete')
                                    <form action="{{ route('admin.stations.destroy', $station->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('station_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stations.massDestroy') }}",
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
  let table = $('.datatable-Station:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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