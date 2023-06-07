<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'Transeformer'  => 'cruds.transeformer.title',
        'Cb'            => 'cruds.cb.title',
        'Minibller'     => 'cruds.minibller.title',
        'Box'           => 'cruds.box.title',
        'Bill'          => 'cruds.bill.title',
        'Minibllarnote' => 'cruds.minibllarnote.title',
        'Lic'           => 'cruds.lic.title',
        'Task'          => 'cruds.task.title',
        'Esfelt'        => 'cruds.esfelt.title',
        'Close'         => 'cruds.close.title',
        'Station'       => 'cruds.station.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || ! isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
