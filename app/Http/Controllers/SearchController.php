<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	 function index()
    {
     return view('property-explore');
    }

    function action(Request $request)
    {
    if($request->ajax())
    {
     $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('properties')
         ->where('property_address', 'like', '%'.$query.'%')
         ->orWhere('name', 'like', '%'.$query.'%')
         ->orWhere('near_by_landmarks', 'like', '%'.$query.'%')
         ->get();
         
      }
     } 
    }
}