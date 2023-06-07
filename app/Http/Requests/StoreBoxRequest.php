<?php

namespace App\Http\Requests;

use App\Models\Box;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('box_create');
    }

    public function rules()
    {
        return [
            'box_number' => [
                'string',
                'required',
            ],
            'box_type' => [
                'required',
            ],
            'box_location' => [
                'string',
                'nullable',
            ],
            'box_photo' => [
                'array',
            ],
        ];
    }
}
