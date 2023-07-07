<?php

namespace App\Http\Requests;

use App\Models\Rmu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRmuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rmu_create');
    }

    public function rules()
    {
        return [
            'rmu_no' => [
                'string',
                'required',
                'unique:rmus',
            ],
        ];
    }
}
