<?php

namespace App\Http\Requests;

use App\Models\Transeformer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTranseformerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transeformer_create');
    }

    public function rules()
    {
        return [
            't_no' => [
                'string',
                'required',
            ],
            'kva_rating' => [
                'string',
                'nullable',
            ],
            'primary_voltage' => [
                'string',
                'nullable',
            ],
            'sec_voltage' => [
                'string',
                'nullable',
            ],
            'manuf_sno' => [
                'string',
                'nullable',
            ],
            'manufacturer' => [
                'string',
                'nullable',
            ],
            'manafac_year' => [
                'string',
                'nullable',
            ],
            'over_load' => [
                'string',
                'nullable',
            ],
            'rating' => [
                'string',
                'nullable',
            ],
            'manufacturer_serial' => [
                'string',
                'nullable',
            ],
            'circuits' => [
                'string',
                'nullable',
            ],
            'no_of_used_circuits' => [
                'string',
                'nullable',
            ],
            'manufacturer_minb' => [
                'string',
                'nullable',
            ],
            'lv_cable' => [
                'string',
                'nullable',
            ],
            'x_minb' => [
                'string',
                'nullable',
            ],
            'y_minb' => [
                'string',
                'nullable',
            ],
            'manuf' => [
                'string',
                'nullable',
            ],
            'left_ss' => [
                'string',
                'nullable',
            ],
            'right_ss' => [
                'string',
                'nullable',
            ],
            'serial_no' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'picture_befor' => [
                'array',
            ],
            'photo_after' => [
                'array',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'boxes.*' => [
                'integer',
            ],
            'boxes' => [
                'array',
            ],
            'transe_notes.*' => [
                'integer',
            ],
            'transe_notes' => [
                'array',
            ],
        ];
    }
}
