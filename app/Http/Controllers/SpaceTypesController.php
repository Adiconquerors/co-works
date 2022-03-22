<?php

namespace App\Http\Controllers;

use App\SpaceType;
use App\MemberShipFee;
use Illuminate\Http\Request;

class SpaceTypesController extends Controller
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


    public function index( $parent_id = '')
    {

      if ( ! empty( $parent_id ) ) {
        $item = SpaceType::where('parent_id', $parent_id)->get();
        $title = trans('others.back-spacetypes');
        $active_class = trans('others.spacetypes');
      } 
      else 
      {
        $item = SpaceType::where('parent_id', 0)->get();
        $title =  trans('others.add-new-subtype');
        $active_class = trans('others.spacetypes');
    }

      $data = [
        'title'         => $title,
        'items'         => $item,
        'active_class'  => $active_class,
     ];

     if ( ! empty( $parent_id ) ) {
      return view('admin.sub-space-types.list',$data);  
     }
        else{
        return view('admin.list-spaces.list',$data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $parent_id = '' )
    {

    if ( ! empty( $parent_id ) ) {
      $title  = trans('others.add-new-subtype');

      $active_class   = trans('others.spacetypes');
    }
    else{
     $title = trans('others.add-spacetype'); 
     $space_list  = SpaceType::getSpaceTypes(0); 
     $space_type_parent_list = array_pluck($space_list, 'name', 'id');
     $active_class   = trans('others.spacetypes');
    }

    $data['record']                  = FALSE;
    $data['title']                   = $title;
    $data['space_type_parent_list']  = $space_type_parent_list;
    $data[ 'active_class' ]          = $active_class;

    return view('admin.list-spaces.add-edit',$data);
     
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

        $record = SpaceType::create($request->all());

        $record->space_type_membership_fees()->sync(array_filter((array)$request->input('membership_fee_id')));

        
        $this->processUpload($request,$record,"image");

    flashMessage( 'success', 'create' );    
    return redirect()->route('space-types.index',$record->parent_id);
           
        
    }


     public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/space-types/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\SpaceType  $spaceType
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpaceType  $spaceType
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug, $parent_id='' )
    {
         
        $record  = SpaceType::getRecordWithSlug($slug);

        if ( ! empty( $parent_id ) ) {
            $title  =  trans('others.edit-subspacetype');
            $space_list  = $space_list  = SpaceType::getSpaceTypes(0);  
            $space_type_parent_list = array_pluck($space_list, 'name', 'id');
            $active_class   = trans('others.spacetypes');
        }else{
            $title = trans('others.edit-type'); 
            $space_list  = SpaceType::getSpaceTypes(0); 
            $space_type_parent_list = array_pluck($space_list, 'name', 'id');
            $active_class   = trans('others.spacetypes');
        }

        $data['record']       = $record;
        $data['space_type_parent_list']  = $space_type_parent_list;
        $data['active_class'] = $active_class;
        $data['title']        = trans('others.edit-spacetype');

        return view('admin.list-spaces.add-edit',$data);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpaceType  $spaceType
     * @return \Illuminate\Http\Response
     */
    public function mainedit( Request $request, $slug )
    {
         
        if ( is_numeric( $slug ) ) {
            $record  = SpaceType::getRecordWithSlug($slug);
        } else {
            $record  = SpaceType::getRecordWithSlug($slug);
        }

        if ( $request->action == 'mainedit' ) {
            $record->update( $request );

            $record->space_type_membership_fees()->sync(array_filter((array)$request->input('membership_fee_id')));


            return redirect()->back();
        }

        $title = trans('others.edit-type'); 
        $space_list  = SpaceType::getSpaceTypes(0); 
        $active_class   = trans('others.spacetypes');
       

        $data['record']       = $record;
        $data['active_class'] = $active_class;
        $data['title']        = trans('others.edit-spacetype');
        $data['action'] = 'mainedit';

        return view('admin.list-spaces.add-edit-parent',$data);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpaceType  $spaceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $parent_id='')
    {
      
        if( $parent_id ){
            $record  = SpaceType::where( 'parent_id', $parent_id )->first();     
        }else{
         $record  = SpaceType::getRecordWithSlug($slug);
        }


        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record->update($request->all());

        $record->space_type_membership_fees()->sync(array_filter((array)$request->input('membership_fee_id')));

         
        $this->processUpload($request,$record,"image"); 
         if( $parent_id ){
             flashMessage( 'success', 'update' );
             return redirect()->route('space_types.index',$record->$parent_id);
         }else{
             flashMessage( 'success', 'update' );   
             return redirect()->route('space_types.index');
        }
  }


 


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpaceType  $spaceType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug ,$parent_id='')
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

         if ( ! empty( $parent_id ) ) {
            $record = SpaceType::where('parent_id',$parent_id)->first();
            $record->delete(); 
             
         }else{   
         $record = SpaceType::getRecordWithSlug($slug);
         $record->delete(); 

         }
         flashMessage( 'success', 'delete' );
         return redirect()->route('space_types.index');
         
    }

   
}
