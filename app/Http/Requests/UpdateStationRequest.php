<?php

namespace App\Http\Requests;

use App\Models\Station;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('station_edit');
    }

    public function rules()
    {
        return [
            'station_no' => [
                'string',
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'feeders.*' => [
                'integer',
            ],
            'feeders' => [
                'array',
            ],
            'trans.*' => [
                'integer',
            ],
            'trans' => [
                'array',
            ],
            'box_cosutomers.*' => [
                'integer',
            ],
            'box_cosutomers' => [
                'array',
            ],
            'ct_stations.*' => [
                'integer',
            ],
            'ct_stations' => [
                'array',
            ],
            'rmus.*' => [
                'integer',
            ],
            'rmus' => [
                'array',
            ],
            'auto_closers.*' => [
                'integer',
            ],
            'auto_closers' => [
                'array',
            ],
            'section_lazies.*' => [
                'integer',
            ],
            'section_lazies' => [
                'array',
            ],
            'avrs.*' => [
                'integer',
            ],
            'avrs' => [
                'array',
            ],
        ];
    }
}
