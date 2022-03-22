<?php

namespace App\Http\Controllers;

use App\SubSpaceType;
use App\SpaceType;
use Illuminate\Http\Request;

class SubSpaceTypesController extends Controller
{
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
        'items'        => SubSpaceType::paginate(50),
        'active_class' => trans('others.sub_space_types')
      ]; 

      return view( 'admin.sub-space-types.list',$data );
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
      'title'          => trans('others.add-new-subspacetype'),
      'space_types'    => SpaceType::pluck('name','id')->toArray(),

      'active_class'   => trans('others.sub_space_types')
    ];
        
        return view('admin.sub-space-types.add-edit',$data);
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
            'name'          => 'bail|required',
            'spacetypes_id' => 'bail|required',
        ]);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = SubSpaceType::create($request->all());
        if( $request->image_one ){
        $this->processUpload($request,$record,"image_one");
         }
         if( $request->image_two ){
        $this->processUpload($request,$record,"image_two");
        }
        if( $request->image_three ){ 
        $this->processUpload($request,$record,"image_three");
        }
        if( $request->image_four ){ 
        $this->processUpload($request,$record,"image_four");
        }
   

        return redirect()->route('sub_space_types.index');
    }

     public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/sub_space_types/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);
           
          
            $record->image_one = $fileName;
            $record->image_two = $fileName;
            $record->image_three = $fileName; 
            $record->image_four = $fileName;

            $record->save();
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\SubSpaceType  $subSpaceType
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubSpaceType  $subSpaceType
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {
       $record  = SubSpaceType::getRecordWithSlug($slug); 
        $data = 
      [
        'record'         => $record,
        'space_types'    => SpaceType::pluck('name','id')->toArray(),
        'active_class'   => trans('others.sub_space_types'),
        'title'          => trans('others.edit-subspacetype'),
      ];
   
        return view('admin.sub-space-types.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubSpaceType  $subSpaceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $slug )
    {
        $request->validate([
            'name'              => 'bail|required',
            'spacetypes_id'     => 'bail|required',
       ]);

        $record  = SubSpaceType::getRecordWithSlug($slug);
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record->update($request->all());
         if($request->image_one){ 
        $this->processUpload($request,$record,"image_one");
        }
         if($request->image_two){ 
        $this->processUpload($request,$record,"image_two");
         }
          if($request->image_three){ 
        $this->processUpload($request,$record,"image_three");
        }
         if($request->image_four){ 
        $this->processUpload($request,$record,"image_four");
      }

        return redirect()->route('sub_space_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubSpaceType  $subSpaceType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {
        $record = SubSpaceType::getRecordWithSlug($slug);
        $record->delete(); 

         return redirect()->route('sub_space_types.index');
    }
}
