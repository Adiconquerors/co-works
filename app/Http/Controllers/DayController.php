<?php

namespace App\Http\Controllers;

use App\Day;
use Illuminate\Http\Request;

class DayController extends Controller
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
        'title'        => trans('others.add-newday'), 
        'items'         => Day::paginate(5),
        'active_class'  => trans('others.days'),
      ]; 

      return view('admin.days.list',$data);
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
        'title'         => trans('others.add-day'),
        'active_class'  => trans('others.days')
      ];
        
        return view('admin.days.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

         $request->validate([
        'name'                 => 'required',
        ]);
        
        $record = Day::create($request->all());

        return redirect()->route('days.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {
        $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.days'),
        'title'         => trans('others.edit-day'),
      ];
   
        return view('admin.days.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slug )
    {
       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        } 

        $request->validate([
        'name'           => 'required',
       ]);

        $record  = Day::getRecordWithSlug($slug);
        $record->update($request->all());

        return redirect()->route('days.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = Day::getRecordWithSlug($slug);
         $record->delete(); 

         return redirect()->route('days.index');
    }
}
