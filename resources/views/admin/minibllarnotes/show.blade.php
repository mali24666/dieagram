@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.minibllarnote.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minibllarnotes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.minibllarnote.fields.id') }}
                        </th>
                        <td>
                            {{ $minibllarnote->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minibllarnote.fields.notes') }}
                        </th>
                        <td>
                            {{ $minibllarnote->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minibllarnotes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#minibllar_notes_minibllers" role="tab" data-toggle="tab">
                {{ trans('cruds.minibller.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="minibllar_notes_minibllers">
            @includeIf('admin.minibllarnotes.relationships.minibllarNotesMinibllers', ['minibllers' => $minibllarnote->minibllarNotesMinibllers])
        </div>
    </div>
</div>

@endsection