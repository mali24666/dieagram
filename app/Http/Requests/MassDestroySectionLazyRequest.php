<?php

namespace App\Http\Requests;

use App\Models\SectionLazy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySectionLazyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('section_lazy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:section_lazies,id',
        ];
    }
}
