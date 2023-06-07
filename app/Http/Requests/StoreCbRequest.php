<?php

namespace App\Http\Requests;

use App\Models\Cb;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCbRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cb_create');
    }

    public function rules()
    {
        return [
            'trans_cb_fider_number' => [
                'string',
                'required',
            ],
        ];
    }
}
