<?php

namespace App\Http\Controllers;

use App\Notifications\WL_EmailNotification;
use Notification;
use Illuminate\Http\Request;

class ConnectController extends Controller
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
        public function getConnect(){
          return view('admin.connect.connect');
        }


    public function sendConnect(Request $request )
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }    

         $company_name = $request->company_name;
         $client_name = $request->client_name;
         $no_of_seats = $request->no_of_seats;
         $mobile = $request->mobile;
         $location = $request->location;
         $email = $request->email;
         $auth_user_id = \Auth::id();
         $auth_user_name = \Auth::User()->name;
         $auth_user_email = \Auth::User()->email;

           $admins   = \App\User::whereHas("roles",
             function ($query) {
                 $query->where('id', ADMIN_ROLE_ID);
             })->get();

            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

             $templatedata = array(
                     'auth_user_id' => $auth_user_id ?? '-',
                     'auth_user_name' => $auth_user_name ?? '-',
                     'auth_user_email' => $auth_user_email ?? '-',
                     'company_name' => $company_name ?? '-',
                     'content' => 'From Connect',
                     'client_name' => $client_name ?? '-',
                     'no_of_seats' => $no_of_seats ?? '-',
                     'mobile' => $mobile ?? '-',
                     'location'=> $location ?? '-',
                     'email'=> $email ?? '-',

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
                     'template' => 'connect',
                     'data' => $templatedata,
                   ];
             $notification = new WL_EmailNotification($data);
             Notification::send($admins, $notification);
        // end multiple emails to admin

         return redirect()->back()->with('connect', 'Your record has been submitted successfully !!'); 
         
    } 

} 
