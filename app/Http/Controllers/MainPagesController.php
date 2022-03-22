<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\PostRequirement;
use App\Notifications\WL_EmailNotification;
use Notification;

class MainPagesController extends Controller
{


    public function workspace()
    {
      return view('main-pages.workspace');
    }

    public function topbarLocation()
    {
      return view('main-pages.locations');
    }

    public function topbarLandlords()
    {
      return view('main-pages.landlords');
    }

    public function postRequirement(Request $request)
    {

      

        if ( $request->isMethod('post') ) {
       
          $columns = array(              
              'pr_name' => 'required',
              'pr_email' => 'required',
              'pr_number' => 'required',
              'pr_persons' => 'required',
              'pr_startdate' => 'required',
              'pr_code' => 'required',
          );
         $this->validate($request,$columns);

         if ( isDemo() ) {
           return redirect()->back()->with('success_message', trans('others.crud-disabled'));
         }else{


           $record = PostRequirement::create($request->all());

               $admins   = \App\User::whereHas("roles",
             function ($query) {
                 $query->where('id', ADMIN_ROLE_ID);
             })->get();

            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

            $space_types = \App\SpaceType::find($request->pr_spacetypes);



             $templatedata = array(
                    'pr_name' => $request->pr_name ?? '',
                    'pr_email' => $request->pr_email ?? '-',
                    'pr_code' => $request->pr_code ?? '-',
                    'pr_number' => $request->pr_number ?? '-',
                    'content' => trans('others.from-postreq'),
                    'pr_company' => $request->pr_company ?? '-',
                    'pr_city' => $request->pr_city ?? '-',
                    'pr_startdate' => $request->pr_startdate ?? '-',
                    'pr_prefferedtime'=> $request->pr_prefferedtime ?? '-',
                    'pr_information'=> $request->pr_information ?? '-',
                    'pr_spacetypes'=> $space_types ? $space_types->name : '-',
                    'pr_message'=> $request->pr_message ?? '-',

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
                     'template' => 'post-requirement',
                     'data' => $templatedata,
                   ];
             $notification = new WL_EmailNotification($data);
             Notification::send($admins, $notification);
        // end multiple emails to admin    
      

            return redirect()->back()->with('success_message', trans('others.form-sub'));


         } 

        }

          $data['title']  = trans('others.post-req');        
          return view('main-pages.post-requirement',$data);
    }

}