<?php

namespace App\Http\Controllers;

use App\Amenity;
use App\Icon;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
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
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }    



       
     $data = 
      [
        'title'        => trans('others.add-amenity'), 
        'items'        => Amenity::with(['icon'])->get(),
        'active_class' => trans('others.amenities'),
      ]; 

      return view( 'admin.amenities.list',$data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

    
        $data = 
      [
        'record'        => FALSE, 
        'title'         => trans('others.add-amenity'),
        'items'        => Amenity::get(),
        'icons'         => Icon::pluck('name','id')->toArray(),
        'active_class'  => trans('others.amenities'),
      ];
        
        return view('admin.amenities.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }     


        $rules = [
        'name'           => 'required',
        'icon_id'        => 'required',

        ];

        $custom_messages = [
            'icon_id.required' => trans('others.sel-dropdown'),
        ];

      $request->validate( $rules , $custom_messages );
        
        $record = Amenity::create($request->all());

        flashMessage( 'success', 'create' );
        return redirect()->route('amenities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


       $record  = Amenity::getRecordWithSlug($slug);

        $title        = trans('others.view-amenity');
        $active_class = trans('others.amenities');

        return view('admin.amenities.show', compact('record','active_class','title'));      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

       
        $record  = Amenity::getRecordWithSlug($slug);

    $data = 
      [
        'record'        => $record,
        'icons'         => Icon::pluck('name','id')->toArray(),
        'active_class'  => trans('others.amenities'),
        'title'         => trans('others.edit-amenity'),
      ];
   
        return view('admin.amenities.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }     

  
        $rules = [
        'name'           => 'required',
        'icon_id'        => 'required',

        ];

        $custom_messages = [
            'icon_id.required' => trans('others.sel-dropdown'),
        ];

      $request->validate( $rules , $custom_messages );

        $record  = Amenity::getRecordWithSlug($slug);
        $record->update($request->all());

        flashMessage( 'success', 'update' );
        return redirect()->route('amenities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }     

        $record = Amenity::getRecordWithSlug($slug);
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('amenities.index');
    }
}
