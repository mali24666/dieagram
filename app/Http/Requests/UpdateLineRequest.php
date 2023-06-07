<?php

namespace App\Http\Requests;

use App\Models\Line;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('line_edit');
    }

    public function rules()
    {
        return [
            'line_no' => [
                'string',
                'nullable',
            ],
            'trans.*' => [
                'integer',
            ],
            'trans' => [
                'array',
            ],
            'cts.*' => [
                'integer',
            ],
            'cts' => [
                'array',
            ],
        ];
    }
}
