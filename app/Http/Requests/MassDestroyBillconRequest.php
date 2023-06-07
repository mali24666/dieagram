<?php

namespace App\Http\Requests;

use App\Models\Billcon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBillconRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('billcon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:billcons,id',
        ];
    }
}
