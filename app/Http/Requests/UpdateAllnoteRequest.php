<?php

namespace App\Http\Requests;

use App\Models\Allnote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAllnoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('allnote_edit');
    }

    public function rules()
    {
        return [
            't_notes' => [
                'string',
                'required',
                'unique:allnotes,t_notes,' . request()->route('allnote')->id,
            ],
        ];
    }
}
