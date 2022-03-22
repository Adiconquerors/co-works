<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogSearchController extends Controller
{
      public function search(Request $request)
    {

        $search = $request->input('search', false);
        $term = $search['term'];

        if (!$term) {
            abort(500);
        }

        $return = [];

            $query = \App\Article::query();

            $fields = ['name', 'description'];

            if ( ! empty( $fields ) ) {
                foreach ($fields as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $term . '%');
                }

                $results = $query->get();

                

                foreach ($results as $result) {
                    $results_formated = $result->only($fields);
                   
                    $results_formated['fields'] = $fields;
                    $fields_formated = [];
                    foreach ($fields as $field) {
                        $fields_formated[$field] = title_case(str_replace('_', ' ', $field));
                    }
                    $results_formated['fields_formated'] = $fields_formated;

                   $return[] = $results_formated;
                }
            }
        

        return response()->json(['results' => $return]);
    }
}