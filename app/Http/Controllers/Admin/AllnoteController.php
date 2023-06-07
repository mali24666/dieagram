<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllnoteRequest;
use App\Http\Requests\StoreAllnoteRequest;
use App\Http\Requests\UpdateAllnoteRequest;
use App\Models\Allnote;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AllnoteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('allnote_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Allnote::query()->select(sprintf('%s.*', (new Allnote)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'allnote_show';
                $editGate      = 'allnote_edit';
                $deleteGate    = 'allnote_delete';
                $crudRoutePart = 'allnotes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('t_notes', function ($row) {
                return $row->t_notes ? $row->t_notes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.allnotes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('allnote_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allnotes.create');
    }

    public function store(StoreAllnoteRequest $request)
    {
        $allnote = Allnote::create($request->all());

        return redirect()->route('admin.allnotes.index');
    }

    public function edit(Allnote $allnote)
    {
        abort_if(Gate::denies('allnote_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allnotes.edit', compact('allnote'));
    }

    public function update(UpdateAllnoteRequest $request, Allnote $allnote)
    {
        $allnote->update($request->all());

        return redirect()->route('admin.allnotes.index');
    }

    public function destroy(Allnote $allnote)
    {
        abort_if(Gate::denies('allnote_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allnote->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllnoteRequest $request)
    {
        $allnotes = Allnote::find(request('ids'));

        foreach ($allnotes as $allnote) {
            $allnote->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
