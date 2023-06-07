<?php

namespace App\Http\Requests;

use App\Models\Minibllarnote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMinibllarnoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minibllarnote_create');
    }

    public function rules()
    {
        return [
            'notes' => [
                'string',
                'required',
                'unique:minibllarnotes',
            ],
        ];
    }
}
