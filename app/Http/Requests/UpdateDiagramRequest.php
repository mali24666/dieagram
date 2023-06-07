<?php

namespace App\Http\Requests;

use App\Models\Diagram;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDiagramRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('diagram_edit');
    }

    public function rules()
    {
        return [];
    }
}
