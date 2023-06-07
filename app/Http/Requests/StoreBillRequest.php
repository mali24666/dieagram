<?php

namespace App\Http\Requests;

use App\Models\Bill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_create');
    }

    public function rules()
    {
        return [
            'ground' => [
                'string',
                'nullable',
            ],
            'line' => [
                'string',
                'nullable',
            ],
            'power_detected' => [
                'string',
                'nullable',
            ],
            'panal' => [
                'string',
                'nullable',
            ],
            'reading' => [
                'string',
                'nullable',
            ],
        ];
    }
}
