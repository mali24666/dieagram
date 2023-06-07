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
        ];
    }
}
