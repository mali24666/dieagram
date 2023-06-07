<?php

namespace App\Http\Requests;

use App\Models\Esfelt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEsfeltRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('esfelt_edit');
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
            'esfelt_pic' => [
                'array',
            ],
            'eng_sign' => [
                'array',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            // 'type' => [
            //     'required',
            // ],
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