<?php

namespace App\Http\Requests;

use App\Models\Cb;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCbRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cb_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cbs,id',
        ];
    }
}
