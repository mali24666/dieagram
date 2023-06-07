<?php

namespace App\Http\Requests;

use App\Models\Billcon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillconRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('billcon_create');
    }

    public function rules()
    {
        return [
            'task_no_id' => [
                'integer',
            ],
            'job_1' => [
            ],
            'count_1' => [
                'numeric',
            ],
            'count_2' => [
                'numeric',
            ],
            'count_3' => [
                'numeric',
            ],
            'enjaz' => [
                'array',
            ],
            'enjaz.*' => [
            ],
            'price_1' => [
                'numeric',
            ],
            'price_2' => [
                'numeric',
            ],
            'price_3' => [
                'numeric',
            ],
            'note_1' => [
            ],
            'note_2' => [
            ],
            'note_3' => [
            ],
            'descount_1' => [
                'numeric',
            ],
            'descount_2' => [
                'numeric',
            ],
            'descount_3' => [
                'numeric',
            ],
            'descount_4' => [
                'numeric',
            ],
            'descount_5' => [
                'numeric',
            ],
            'descount_6' => [
                'numeric',
            ],
            'descount_7' => [
                'numeric',
            ],
            'descount_8' => [
                'numeric',
            ],
            'descount_9' => [
                'numeric',
            ],
            'descount_10' => [
                'numeric',
            ],
            'descount_11' => [
                'numeric',
            ],
            'created_by_id' => [
                'numeric',
            ],

            
        ];
    }
}
