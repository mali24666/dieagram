<?php

namespace App\Http\Requests;

use App\Models\Rmu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRmuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rmu_edit');
    }

    public function rules()
    {
        return [
            'rmu_no' => [
                'string',
                'required',
                'unique:rmus,rmu_no,' . request()->route('rmu')->id,
            ],
        ];
    }
}
