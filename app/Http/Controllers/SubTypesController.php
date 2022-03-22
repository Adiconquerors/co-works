<?php

namespace App\Http\Controllers;

use App\SpaceType;
use App\SubSpaceType;
use App\SubType;
use Illuminate\Http\Request;

class SubTypesController extends Controller
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
        'title'        => trans('others.add-subspacetype'), 
        'items'        => SubType::paginate(10),
        'active_class' => trans('others.sub_space_types')
      ]; 

      return view( 'admin.sub-types.list',$data );
        
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
      'title'          => ucfirst('add Sub types'),
      'space_types'    => SpaceType::pluck('name','id')->toArray(),
      'sub_space_types'=> SubSpaceType::pluck('name','id')->toArray(),

      'active_class'   => trans('others.sub_space_types')
    ];
        
        return view('admin.sub-types.add-edit',$data);
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
            'spacetypes_id'     => 'bail|required',
            'subspacetypes_id'  => 'bail|required',
        ]);
        
        $record = SubType::create($request->all());
        return redirect()->route('sub_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubType  $subType
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubType  $subType
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $record  = SubType::getRecordWithId($id);

     $data = 
      [
        'record'         => $record,
        'space_types'    => SpaceType::pluck('name','id')->toArray(),
        'sub_space_types'=> SubSpaceType::pluck('name','id')->toArray(),
        'active_class'   => trans('others.sub_space_types'),
        'title'          => trans('others.edit-subspacetype'),
      ];
   
        return view('admin.sub-types.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubType  $subType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id )
    {
        $request->validate([
            'spacetypes_id'     => 'bail|required',
            'subspacetypes_id'  => 'bail|required',
        ]);

        $record  = SubType::getRecordWithId($id);
        $record->update($request->all());

        return redirect()->route('sub-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubType  $subType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $record = SubType::getRecordWithId($id);
        $record->delete(); 

        return redirect()->route('sub_types.index');
    }
}
