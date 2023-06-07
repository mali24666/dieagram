<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMinibllarnoteRequest;
use App\Http\Requests\StoreMinibllarnoteRequest;
use App\Http\Requests\UpdateMinibllarnoteRequest;
use App\Models\Minibllarnote;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinibllarnoteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('minibllarnote_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Minibllarnote::query()->select(sprintf('%s.*', (new Minibllarnote())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'minibllarnote_show';
                $editGate = 'minibllarnote_edit';
                $deleteGate = 'minibllarnote_delete';
                $crudRoutePart = 'minibllarnotes';

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
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.minibllarnotes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('minibllarnote_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minibllarnotes.create');
    }

    public function store(StoreMinibllarnoteRequest $request)
    {
        $minibllarnote = Minibllarnote::create($request->all());

        return redirect()->route('admin.minibllarnotes.index');
    }

    public function edit(Minibllarnote $minibllarnote)
    {
        abort_if(Gate::denies('minibllarnote_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minibllarnotes.edit', compact('minibllarnote'));
    }

    public function update(UpdateMinibllarnoteRequest $request, Minibllarnote $minibllarnote)
    {
        $minibllarnote->update($request->all());

        return redirect()->route('admin.minibllarnotes.index');
    }

    public function destroy(Minibllarnote $minibllarnote)
    {
        abort_if(Gate::denies('minibllarnote_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minibllarnote->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinibllarnoteRequest $request)
    {
        Minibllarnote::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
