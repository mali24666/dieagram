<?php

namespace App\Http\Requests;

use App\Models\Rmu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRmuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rmu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rmus,id',
        ];
    }
}
