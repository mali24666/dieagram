<?php

namespace App\Http\Requests;

use App\Models\Autorecloser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAutorecloserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('autorecloser_edit');
    }

    public function rules()
    {
        return [
            'auto_recloser_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
