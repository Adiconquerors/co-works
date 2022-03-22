<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\EmailTemplate;

use App\Notifications\WL_EmailNotification;
use Notification;

use Illuminate\Validation\Rule;
use DB;
use Validator;


class UsersController extends Controller
{

     public function __construct()
    { 
     $this->middleware('auth');
    }

    /**
    * Display users.
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
        'title'         => trans('others.add-new-user'), 
        'items'         => User::with(['roles'])->get(),
        'active_class'  => trans('others.users')
      ];    


      return view('admin.users.list',$data);
    } 

    
    public function create()
    {

       if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $data = 
      [
        'record'        => FALSE, 
        'roles'         => \App\Role::get()->pluck('title', 'id'),
        'title'         => trans('others.add-user'),
        'active_class'  => trans('others.users')
      ];

       return view('admin.users.add-edit', $data);

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
            'name'    => 'required',
            'email'   => 'required|unique:users,email|max:255',
            'mobile'  => 'required',
            'currency_id'  => 'required',
            'password'  => 'required',
         ];
         $request->validate( $rules );


         if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
     

        $role_id        = $request->role_id;

        $record              = new User();
        $name                = $request->name;
        $record->name        = $name;
        $record->description = $request->description;
        $record->skype_email = $request->skype_email;
        $record->phone       = $request->phone;
        $record->role_id     = $role_id;
        $record->email       = $request->email;
        $record->currency_id = $request->currency_id;
        $record->mobile      = $request->mobile;
        $record->password    = $request->password;
        $record->password    = bcrypt($record->password);

        $record->email_verified_at = Carbon::now();
        $record->is_email_verified = 'yes';
        $record->is_mobile_verified = 'yes';
        $record->otp = null;
        $record->status = 1;
     
    
         $record->save();

        $site_logo = getSetting( 'site_logo', 'site_settings' );
        $country_code = getSetting('country_code','site_settings');

        $templatedata = array(
            'name' =>  $request->name,
            'email' => $request->email,
            'content' => trans('others.user-created'),
            'password'=> $request->password,


             'site_address' => getSetting( 'site_address', 'site_settings'),
            'site_phone' => getSetting( 'site_phone', 'site_settings'),
            'site_email' => getSetting( 'contact_email', 'site_settings'),                
            'site_title' => getSetting( 'site_title', 'site_settings'),
            'country_code' => $country_code,
            'site_logo' => asset( 'uploads/settings/' . $site_logo ),
            'date' => date('Y-m-d'),
            'site_url' => config('app.url'),

            );

            $data = [

            'template' => 'user-created',
            'data' => $templatedata,
            ];
        $record->notify(new WL_EmailNotification($data));
       
         $this->processUpload($request,$record,"image");

        flashMessage( 'success', 'create' ); 
        return redirect()->route('users.index');
    }


    public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = "public/uploads/users/";

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();
        }
    } 


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        $record = User::findOrFail($id);
        $title        =  trans('others.view-user');
        $active_class = trans('others.users');

        return view('admin.users.show', compact('record','title','active_class'));
    }

      public function edit( $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $record  = User::getRecordWithSlug($id);

        $data = 
      [
        'record'        => $record,
        'roles'         => \App\Role::get()->pluck('title', 'id'),
        'active_class'  => trans('others.users'),
        'title'         => trans('others.edit-user'),
      ];
   
        return view('admin.users.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

        

     public function update( Request $request, $id )
    {

       if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     
      
      $rules = [
            'name'    => 'required',
            'email'   => 'unique:users,email,'.$id,
            'mobile'  => 'required',
            'password'  => 'required',
      ];
      
         $request->validate( $rules );

         if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

      $role_id        = $request->role_id;   

        $record  = User::getRecordWithSlug($id);


        $name                = $request->name;
        $record->name        = $name;
        $record->description = $request->description;
        $record->skype_email = $request->skype_email;
        $record->phone       = $request->phone;
        $record->role_id     = $role_id;
        $record->email       = $request->email;
        $record->currency_id = $request->currency_id;
        $record->mobile      = $request->mobile;
        $record->password    = $request->password;
        
        $record->password    = bcrypt($record->password);

        $record->email_verified_at = Carbon::now();
       
        $record->is_email_verified = 'yes';
        $record->is_mobile_verified = 'yes';
        $record->otp = null;
        $record->status = 1;

        $record->save();

        $site_logo = getSetting( 'site_logo', 'site_settings' );
        $country_code = getSetting('country_code','site_settings');

         $templatedata = array(
            'name' =>  $request->name, 
            'email' => $request->email,
            'content' => 'User created',
            'password'=> $request->password, 

            'site_address' => getSetting( 'site_address', 'site_settings'),
            'site_phone' => getSetting( 'site_phone', 'site_settings'),
            'site_email' => getSetting( 'contact_email', 'site_settings'),                
            'site_title' => getSetting( 'site_title', 'site_settings'),
            'country_code' => $country_code,
            'site_logo' => asset( 'uploads/settings/' . $site_logo ),
            'date' => date('Y-m-d'),
            'site_url' => config('app.url'),            
            );

            $data = [

            'template' => 'user-created',
            'data' => $templatedata,
            ];
        $record->notify(new WL_EmailNotification($data));

        $this->processUpload($request,$record,"image"); 

        flashMessage( 'success', 'update' );
        return redirect()->route('users.index');
    }

  //Exporting the users data in excel format
    public function export() 
    {
       if( ! isAdmin() ){
        return redirect()->back();
       } 
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $id
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

         $record = User::getRecordWithSlug($id);
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('users.index');
    }


}