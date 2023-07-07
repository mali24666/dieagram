<?php

namespace App\Http\Requests;

use App\Models\Autorecloser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAutorecloserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('autorecloser_create');
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
