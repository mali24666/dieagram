<table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Lic">
    <tr>

        @can($viewGate)
            <td>  <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
                {{ trans('global.view') }}
            </a>
        </td> 

        @endcan
        @can($editGate)
        <td> 
            <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
                {{ trans('global.edit') }}
            </a>
        </td> 

        @endcan
        @can($addGate)
        <td> 
            <a class="btn btn-xs btn-success" href="{{ route('admin.tasks.add', $row->id) }}">
                اصدار رخصة 
            </a>
        </td> 

        @endcan

        @can($deleteGate)
        <td> 
            <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
            </form>
        </td> 
        @endcan
    </tr>
</table>