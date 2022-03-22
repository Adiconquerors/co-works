<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileSettingsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
public function getprofile(){

  $record  = Auth::user();
  $active_class =  trans('others.profile');

  return view('customers.profile',compact('record','active_class'));
}


    public function profileSettings(Request $request )
    {
      

         $rules = [
            'name'    => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
           
         ];
         
         $request->validate( $rules );

         if ( isDemo() ) {
          return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }       

         $record  = Auth::user();
        
         $record->name = $request->name;
         if( isAdmin() )
         {
          $record->name = $request->name;
          $record->email = $request->email;
          $record->mobile = $request->mobile;
         }

         $record->save();

         $this->processUpload($request,$record,"image");

         return redirect()->back()->with('success', trans('others.record-success')); 

         
    } 



     public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/users/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();

        }
    }  

} 
