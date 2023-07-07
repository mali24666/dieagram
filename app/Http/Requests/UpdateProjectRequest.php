<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_edit');
    }

    public function rules()
    {
        return [
            'station' => [
                'string',
                'nullable',
            ],
            'top' => [
                'string',
                'nullable',
            ],
            'left' => [
                'string',
                'nullable',
            ],
            'descreption' => [
                'string',
                'nullable',
            ],
            'second_feeder' => [
                'string',
                'nullable',
            ],
            'ct_postion' => [
                'string',
                'nullable',
            ],
        ];
    }
}
