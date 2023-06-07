<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBillRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bills = Bill::with(['transformer'])->get();

        $transeformers = Transeformer::get();

        return view('admin.bills.index', compact('bills', 'transeformers'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transformers = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bills.create', compact('transformers'));
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());

        return redirect()->route('admin.bills.index');
    }

    public function edit(Bill $bill)
    {
        abort_if(Gate::denies('bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transformers = Transeformer::pluck('t_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill->load('transformer');

        return view('admin.bills.edit', compact('bill', 'transformers'));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());

        return redirect()->route('admin.bills.index');
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->load('transformer');

        return view('admin.bills.show', compact('bill'));
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillRequest $request)
    {
        Bill::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
