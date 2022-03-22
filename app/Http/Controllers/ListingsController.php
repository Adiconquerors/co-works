<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Country;
use App\City;
use App\Venue;
use App\MicroMarket;
use App\PropertyStatus;
use App\SpaceType;
use App\Amenity;

use Illuminate\Http\Request;

class ListingsController extends Controller
{
   public function __construct()
    { 
     $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = 
      [
        'title'        => trans('others.add-new-property'), 
        'items'        => Listing::paginate(5),
        'property_status'=> Listing::where( 'propertystatus_id', 1),
        'active_class' => trans('others.listings')
      ]; 

      return view( 'admin.listings.list',$data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    $data = 
    [
      'record'         => FALSE, 
      'title'          =>  trans('others.add-new-property'),
      'micro_markets'  => MicroMarket::pluck('name','id')->toArray(),
      'countries'      => Country::pluck('name','id')->toArray(),
      'cities'         => City::pluck('name','id')->toArray(),
      'venues'         => Venue::pluck('name','id')->toArray(),
      'property_status'=> PropertyStatus::pluck('name','id')->toArray(),
      'space_types'    => SpaceType::pluck('name','id')->toArray(),

      'active_class'   => trans('others.listings')
    ];
        
        return view('admin.listings.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'property_name'     => 'bail|required',
            'micromarket_id'    => 'bail|required',
            'country_id'        => 'bail|required',
            'city_id'           => 'bail|required',
            'venue_id'          => 'bail|required',
            'propertystatus_id' => 'bail|required',
            'spacetypes_id'     => 'bail|required',
        ]);
        
        $record = Listing::create($request->all());
        $this->processUpload($request,$record,"image");

        return redirect()->route('listings.index');
    }


     public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/listings/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {
     
     $record  = Listing::getRecordWithSlug($slug);

     $data = 
      [
        'record'         => $record,
        'micro_markets'  => MicroMarket::pluck('name','id')->toArray(),
        'property_status'=> PropertyStatus::pluck('name','id')->toArray(),
        'space_types'    => SpaceType::pluck('name','id')->toArray(),
        'countries'      => Country::pluck('name','id')->toArray(),
        'cities'         => City::pluck('name','id')->toArray(),
        'venues'         => Venue::pluck('name','id')->toArray(),
        'active_class'   => trans('others.listings'),
        'title'          => trans('others.edit-property'),
      ];
   
        return view('admin.listings.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slug )
    {
        $request->validate([
            'property_name'     => 'bail|required',
            'micromarket_id'    => 'bail|required',
            'country_id'        => 'bail|required',
            'city_id'           => 'bail|required',
            'venue_id'          => 'bail|required',
            'propertystatus_id' => 'bail|required',
            'spacetypes_id'     => 'bail|required',
       ]);

        $record  = Listing::getRecordWithSlug($slug);
        $record->update($request->all());
         $this->processUpload($request,$record,"image");

        return redirect()->route('listings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {
         $record = Listing::getRecordWithSlug($slug);
         $record->delete(); 

         return redirect()->route('listings.index');
    }

    public function fetchData( $parent_id )
    {
     
     $spacetypes_id = $request->parent_id;

     $properties = \App\Listing::where('spacetypes_id', $spacetypes_id)->paginate(10);

     $listings = view('home-pages.explore-list',$properties);

     return json_encode( ['status' => 'success', 'html' => $listings] );

    }
}
