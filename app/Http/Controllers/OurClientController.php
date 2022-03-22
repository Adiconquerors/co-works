<?php

namespace App\Http\Controllers;

use App\OurClient;
use Illuminate\Http\Request;

class OurClientController extends Controller
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
        'title'         => trans('others.add-new-img'), 
        'items'         => OurClient::get(),
        'active_class'  => trans('others.ourclients')
      ]; 
      
      return view('admin.ourclients.list',$data);
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
        'title'         => trans('others.add-ourclientim'),
        'active_class'  => trans('others.ourclients')
      ];
        
        return view('admin.ourclients.add-edit',$data);
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


        $rules = [
            'image'          => 'required|mimes:jpeg,png,jpg,gif,svg',
        ];

        $request->validate( $rules );

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = OurClient::create($request->all());

        $this->processUpload($request,$record,"image");

        flashMessage( 'success', 'create' );
        return redirect()->route('our_clients.index');
    }


    public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/ourclients/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();
        }
    } 
    /**
     * Display the specified resource.
     *
     * @param  \App\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


         $record  = OurClient::getRecordWithId($id);

         $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.ourclients'),
        'title'         => trans('others.edit-client-img'),
      ];
   
        return view('admin.ourclients.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


      $rules = [
            'image'          => 'mimes:jpeg,png,jpg,gif,svg',
        ];

        $request->validate( $rules );

        $record  = OurClient::getRecordWithId($id);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record->update($request->all());

        $this->processUpload($request,$record,"image"); 

        flashMessage( 'success', 'update' );
        return redirect()->route('our_clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
     {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

         $record = OurClient::getRecordWithId($id);
         $record->delete();

         flashMessage( 'success', 'delete' );
         return redirect()->route('our_clients.index');
    }
}
