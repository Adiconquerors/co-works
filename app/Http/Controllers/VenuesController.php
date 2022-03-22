<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;

class VenuesController extends Controller
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
       

       if( ! ( isAdmin() ||  isAgent() ) ){
        return redirect()->back();
       } 

        $data = 
      [
        'title'        => trans('others.add-new-venue'), 
        'items'         => Venue::get(),
        'active_class'  => trans('others.venues')
      ]; 

      return view('admin.venues.list',$data);
    }

      //Venue Filter  
    public function venueFilter(Request $request)
    {   
        
          $title      = trans('others.add-new-venue');

        if (request()->ajax())
        {

            $property_name = request('property_name');
            $property_address = request('property_address');
            $manager_email = request('manager_email');
            $manager_name = request('manager_name');
            $manager_phone = request('manager_phone');
            $active_class = trans('others.venues');
            $query = \App\Venue::query();
            
            $query->when($property_name, function ($q, $property_name)
            {
                return $q->where('venues.property_name', 'like', "%$property_name%");
            });

              $query->when($property_address, function ($q, $property_address)
            {
                return $q->where('venues.property_address', 'like', "%$property_address%");
            });

             $query->when($manager_name, function ($q, $manager_name)
            {
                return $q->where('venues.manager_name', 'like', "%$manager_name%");
            });

            $query->when($manager_email, function ($q, $manager_email)
            {
                return $q->where('venues.manager_email', 'like', "%$manager_email%");
            });

            $query->when($manager_phone, function ($q, $manager_phone)
            {
                return $q->where('venues.manager_phone', 'like', "%$manager_phone%");
            });



            $items = $query->get();
            

            return view('admin.venues.venue-list', compact('items', 'active_class','title'));

        }

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
        'record'        => FALSE, 
        'title'         => trans('others.add-venue'),
        'active_class'  => trans('others.venues')
      ];
        
        return view('admin.venues.add-edit',$data);
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
        'name'           => 'required',
        ]);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = Venue::create($request->all());

        return redirect()->route('venues.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        $record  = Venue::getRecordWithSlug($slug);
            
        $title        = trans('others.view-venue');
        $active_class = trans('others.venues');

        return view('admin.venues.show', compact('record','active_class','title'));            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {
   
    $record  = Venue::getRecordWithSlug($slug);
    $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.venues'),
        'title'         => trans('others.edit-venue'),
      ];
   
        return view('admin.venues.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slug )
    {
        $request->validate([
        'name'           => 'required',
        ]);

        $record  = Venue::getRecordWithSlug($slug);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record->update($request->all());

        return redirect()->route('venues.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record = Venue::getRecordWithSlug($slug);
        $record->delete(); 

        return redirect()->route('venues.index');
    }
}
