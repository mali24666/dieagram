<?php

namespace App\Http\Requests;

use App\Models\Avr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAvrRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('avr_create');
    }

    public function rules()
    {
        return [
            'avr_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
