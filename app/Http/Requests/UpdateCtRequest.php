<?php

namespace App\Http\Requests;

use App\Models\Ct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ct_edit');
    }

    public function rules()
    {
        return [
            'ct_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
