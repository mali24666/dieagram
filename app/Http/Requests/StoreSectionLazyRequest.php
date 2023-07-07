<?php

namespace App\Http\Requests;

use App\Models\SectionLazy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSectionLazyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('section_lazy_create');
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
