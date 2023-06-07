@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.allnote.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allnotes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.allnote.fields.id') }}
                        </th>
                        <td>
                            {{ $allnote->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allnote.fields.t_notes') }}
                        </th>
                        <td>
                            {{ $allnote->t_notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allnotes.index') }}">
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
            <a class="nav-link" href="#transe_note_transeformers" role="tab" data-toggle="tab">
                {{ trans('cruds.transeformer.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="transe_note_transeformers">
            @includeIf('admin.allnotes.relationships.transeNoteTranseformers', ['transeformers' => $allnote->transeNoteTranseformers])
        </div>
    </div>
</div>

@endsection