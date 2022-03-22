<?php

namespace App\Http\Controllers;

use App\SpaceType;
use App\Property;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
	 public function explore()
    {
     $properties = '';
     $items  = Property::paginate(5);
     return view('home-pages.explore', compact('properties','items'));
    }



}