{{-- @extends('layouts.admin')
@section('content')
@can('diagram_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.diagrams.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.diagram.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.diagram.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
<div class="container">
    {{-- <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h2>Laravel AJAX Example</h2>
        </div>
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add">
                Add Todo
            </button>
        </div>
    </div> --}}
    <div>
        {{-- <table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="todos-list" name="todos-list">
                @foreach ($todo as $data)
                <tr id="todo{{$data->id}}">
                    <td>{{$data->id}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->description}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div class="modal fade" id="formModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title" value="">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter Description" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                        </button>
                        <input type="hidden" id="todo_id" name="todo_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
           <table class=" table table-bordered table-striped table-hover datatable datatable-Diagram">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ trans('cruds.diagram.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.station') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.feeder') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.diagram.fields.ct') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.trans') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diagrams as $key => $diagram)
                        <tr data-entry-id="{{ $diagram->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $diagram->id ?? '' }}
                            </td>
                            <td>
                                {{ $diagram->station->station_no ?? '' }}
                            </td>
                            <td>
                                @foreach($diagram->feeders as $key => $item)
                                    <span class="badge badge-info">{{ $item->station_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($diagram->cts as $key => $item)
                                    <span class="badge badge-info">{{ $item->ct_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($diagram->trans as $key => $item)
                                    <span class="badge badge-info">{{ $item->t_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('diagram_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.diagrams.show', $diagram->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('diagram_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.diagrams.edit', $diagram->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('diagram_delete')
                                    <form action="{{ route('admin.diagrams.destroy', $diagram->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModal').modal('show');
    });
    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
            description: jQuery('#description').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var todo_id = jQuery('#todo_id').val();
        var ajaxurl = 'todo';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                if (state == "add") {
                    jQuery('#todo-list').append(todo);
                } else {
                    jQuery("#todo" + todo_id).replaceWith(todo);
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('diagram_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.diagrams.massDestroy') }}",
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
  let table = $('.datatable-Diagram:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
            {{-- <table class=" table table-bordered table-striped table-hover datatable datatable-Diagram">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.station') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.feeder') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.ct') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagram.fields.trans') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diagrams as $key => $diagram)
                        <tr data-entry-id="{{ $diagram->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $diagram->id ?? '' }}
                            </td>
                            <td>
                                {{ $diagram->station->station_no ?? '' }}
                            </td>
                            <td>
                                @foreach($diagram->feeders as $key => $item)
                                    <span class="badge badge-info">{{ $item->station_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($diagram->cts as $key => $item)
                                    <span class="badge badge-info">{{ $item->ct_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($diagram->trans as $key => $item)
                                    <span class="badge badge-info">{{ $item->t_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('diagram_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.diagrams.show', $diagram->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('diagram_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.diagrams.edit', $diagram->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('diagram_delete')
                                    <form action="{{ route('admin.diagrams.destroy', $diagram->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table> --}} --}}
