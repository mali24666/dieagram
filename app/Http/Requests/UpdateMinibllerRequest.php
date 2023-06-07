<?php

namespace App\Http\Requests;

use App\Models\Minibller;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMinibllerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minibller_edit');
    }

    public function rules()
    {
        return [
            'minibller_number' => [
                'string',
                'required',
            ],
            'minibller_x' => [
                'string',
                'nullable',
            ],
            'minibller_y' => [
                'string',
                'nullable',
            ],
            'minibllar_notes.*' => [
                'integer',
            ],
            'minibllar_notes' => [
                'array',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
        ];
    }
}
