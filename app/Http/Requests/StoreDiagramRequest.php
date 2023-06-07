<?php

namespace App\Http\Requests;

use App\Models\Diagram;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDiagramRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('diagram_create');
    }

    public function rules()
    {
        return [];
    }
}
