<?php

namespace App\Http\Requests;

use App\Models\Close;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCloseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('close_edit');
    }

    public function rules()
    {
        return [
            'after_esfelt' => [
                'array',
            ],
            'eng_sign' => [
                'array',
            ],
        ];
    }
}
