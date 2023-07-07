<?php

namespace App\Http\Requests;

use App\Models\Avr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAvrRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('avr_edit');
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
