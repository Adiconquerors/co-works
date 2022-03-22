<?php

namespace App\Http\Controllers;

use App\Icon;
use Illuminate\Http\Request;

class IconsController extends Controller
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
        'title'        => trans('others.add-new-icon'), 
        'items'         => Icon::get(),
        'active_class'  => trans('others.icons')
      ]; 

      return view('admin.icons.list',$data);
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
        'title'         =>trans('others.add-new-icon'),
        'active_class'  => trans('others.icons')
      ];
        
        return view('admin.icons.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        'name'           => 'required',
        
        ];

       $request->validate( $rules );


       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = Icon::create($request->all());
        flashMessage( 'success', 'create' );
        return redirect()->route('icon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

 
  $record  = Icon::getRecordWithSlug($slug);

    $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.icons'),
        'title'         => trans('others.edit-icon'),
      ];
   
        return view('admin.icons.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slug )
    {
        
        $rules = [
        'name'           => 'required',
        ];

       $request->validate( $rules );

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record  = Icon::getRecordWithSlug($slug);
        $record->update($request->all());

        flashMessage( 'success', 'update' );
        return redirect()->route('icon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Icon  $icon
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

        $record = Icon::getRecordWithSlug($slug);
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('icon.index');
    }
}
