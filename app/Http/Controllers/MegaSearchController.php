<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MegaSearchController extends Controller
{
    protected $models = [
        'Property'  => 'Property',
        'Article'   => 'Article',
        'Template' =>'Template',
        'InternalNotification' =>'InternalNotification',
        'MasterSetting' =>'MasterSetting',
    ];

    public function search(Request $request)
    {

        $search = $request->input('search', false);
        $term = $search['term'];

        if (!$term) {
            abort(500);
        }

        $return = [];
        foreach ($this->models as $modelString => $translation) {
            if($modelString == 'Template'){
                $model = 'App\\' . 'EmailTemplate';    
            }else{
                $model = 'App\\' . $modelString;    
            }

            $query = $model::query();

            $fields = $model::$searchable;

            if ( ! empty( $fields ) ) {
                foreach ($fields as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $term . '%');
                }

                $results = $query->get();

                foreach ($results as $result) {
                    $results_formated = $result->only($fields);
                    $results_formated['model'] = $translation;
                    $results_formated['fields'] = $fields;
                    $fields_formated = [];
                    foreach ($fields as $field) {
                        $fields_formated[$field] = title_case(str_replace('_', ' ', $field));
                    }
                    $results_formated['fields_formated'] = $fields_formated;

                    if($modelString == 'Property'){
                         $results_formated['url'] = url('/' .'property-show-show/'. $result->slug);
                    }else if($modelString == 'MasterSetting'){
                         $results_formated['url'] = url('/' .'admin/master_settings/'. $result->id);
                    }
                    else{

                    $results_formated['url'] = url('/' . str_plural(snake_case($modelString)) . '/' . $result->id);
                    }

                    $return[] = $results_formated;
                }
            }
        }

        return response()->json(['results' => $return]);
    }
	
	
}
