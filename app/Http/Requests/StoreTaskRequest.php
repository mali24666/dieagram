<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
    }

    public function rules()
    {
        return [
            'lics_file' => [
                'array',
            ],
            'lics_no_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'copy' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'length_total' => [
                'numeric',
            ],
            'extract' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'city' => [
                'string',
                'required',
            ],
            'streat' => [
                'string',
                'nullable',
            ],
            'stuts' => [
                'required',
            ],
            'check_1' => [
                'required',
            ],
            'check_2' => [
                'required',
            ],
            'etmam' => [
                'string',
                'nullable',
            ],
            'kholow' => [
                'string',
                'nullable',
            ],

        ];
    }
}
