<?php

namespace App\Http\Requests;

use App\Models\SectionLazy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSectionLazyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('section_lazy_edit');
    }

    public function rules()
    {
        return [
            'section_lazey' => [
                'string',
                'nullable',
            ],
        ];
    }
}
