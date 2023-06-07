<?php

namespace App\Http\Requests;

use App\Models\Esfelt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEsfeltRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('esfelt_create');
    }

    public function rules()
    {
        return [
            'licses' => [
                'array',
            ],
            'work_done_pic' => [
                'array',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'length' => [
                'string',
                'nullable',
            ],
            'lengtute' => [
                'string',
                'nullable',
            ],
            'check_1' => [
                'required',
            ],
            'esfelt_pic' => [
                'array',
            ],
            'eng_sign' => [
                'array',
            ],
            'delivery' => [
                'string',
                'nullable',
            ],
            'esfelt_stuts' => [
                'string',
                'nullable',
            ],
            'lics_no_id' => [
                'string',
                'nullable',
            ],

        ];
    }
}
