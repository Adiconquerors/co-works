<?php

namespace App\Http\Controllers;

use App\Property;
use App\SpaceType;
use App\Amenity;
use App\EmailTemplate;

use App\Mail\EmailShortlistedPropertiesMail;
use App\Mail\EmailVisitsPropertiesMail;
use App\ContactHost;
use Auth;
use App\User;
use App\Enquire;
use DB;

use App\Notifications\WL_EmailNotification;
use Notification;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use Validator;

use Illuminate\Http\Request;    

class ShortlistAndVisitsController extends Controller
{
    public function shortlist( Request $request  )
    {
        if (request()->ajax()) {

            $property_id  = $request->property_id;
            $heart_color  = $request->heart_color;

           if(isDemo()){
                
                return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                      
            }else{

                if ( ! empty( $property_id ) ) {
                $property_shortlist =  Property::find( $property_id );
                
                if ( $property_shortlist ) {
                     $property_shortlist->heart_color = $heart_color; 
                     $property_shortlist->save();
                }
             }

                    
                      return response()->json(['success'=>trans('others.prop-shortlisted'),'property_id' => $property_id , 'heart_color' => $heart_color,'removed'=>trans('others.removed') ]);

            } 
            
                    
           

        }
    }



   public function shortlistClose( Request $request  )
    {
        if (request()->ajax()) {

            $property_id  = $request->property_id;
            if ( ! empty( $property_id ) ) {
                $property_shortlist =  Property::find( $property_id );
                
                if ( $property_shortlist ) {
                     $property_shortlist->heart_color = 'white'; 
                     $property_shortlist->save();
                }
             }


             return response()->json(['removed'=>trans('others.removed') ]);
           

        }
    }


  //Schedule Visit
   public function scheduleVisit( Request $request  )
    {
        if (request()->ajax()) {

            $property_id     = $request->property_id;

            if(isDemo()){
                
                return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                      
            }else{

               if ( ! empty( $property_id ) ) {
                $property_visit =  Property::find( $property_id );
                
                if ( $property_visit ) {
                     $property_visit->schedule_visit = 'no'; 
                     $property_visit->save();
                }

                $visits_log = array(
                'property_id'               => $property_id,
                );
                \App\CreateVisitsLog::create( $visits_log ); 

             }

        return response()->json(['success'=>trans('others.add-visitstab'),'property_id' => $property_id , 'removed'=>trans('others.remove-visitstab') ]);

            }
            
           
           

        }
    }
    //End Schedule Visit

    // Schedule Close
    public function visitClose( Request $request  )
    {
        if (request()->ajax()) {
            $property_id  = $request->property_id;
            if ( ! empty( $property_id ) ) {
                $property_visit =  Property::find( $property_id );
                
                if ( $property_visit ) {
                     $property_visit->schedule_visit = 'yes'; 
                     $property_visit->save();
                }
             }


        return response()->json(['removed'=>trans('others.remove-visitstab') ]);
           
        }
    }

    // End Schedule Close 

    //Shortlisted Properties Share

   public function shortlistPropertiesShare( Request $request  )
    {
        if (request()->ajax()) {

           if(isDemo()){
                
                return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                      
            }else{
               $action                = $request->action;
            $toname                = $request->toname;
            $toemail               = $request->toemail;
            $mail_mobile           = $request->mail_mobile;
            $ccemail               = $request->ccemail;
            
            $mail_description      = $request->mail_description;
            $subject               = $request->subject;
            $company_name          = $request->company_name;
            $no_of_seats           = $request->no_of_seats;
            $cc_emails = [];

            $cc_emails = $ccemail;

            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

           $mail = [
                'toname' => $toname,
                'toemail' => $toemail,
                'company_name' => $company_name,
                'mail_mobile' => $mail_mobile,
                'no_of_seats' => $no_of_seats,
                'subject' => $subject,
                'mail_description' => $mail_description,

                'site_address' => getSetting( 'site_address', 'site_settings'),
                'site_phone' => getSetting( 'site_phone', 'site_settings'),
                'site_email' => getSetting( 'contact_email', 'site_settings'),                
                'site_title' => getSetting( 'site_title', 'site_settings'),
                'country_code' => $country_code,
                'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                'date' => date('Y-m-d'),
                'site_url' => config('app.url'),
                       
            ];

        if( $cc_emails == '' || $cc_emails == null){
                 \Mail::to($toemail)
                 ->send(new EmailShortlistedPropertiesMail($mail)); 
        }else{
                 \Mail::to($toemail)
                 ->cc( explode(',' , $cc_emails ) )
                 ->send(new EmailShortlistedPropertiesMail($mail)); 
        }    

         $properties_shortlists = \App\Property::where( 'heart_color' , 'red' )->get();

         $record = Enquire::where('email', $toemail)->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->where('update_status','!=','Deal Completed')->first();
         if($record){
             $properties_shortlists = \App\Property::with(['property_sub_space_types'])->where( 'heart_color' , 'red' )->get();
  
            $shortlisted_by_auth_user = Auth::user()->name;
            $record->shortlisted_properties =  json_encode($properties_shortlists);
            $record->update_status = 'Options Sent';
            $record->progress = 35;
            $record->save();

              $update_status_log = array(
                'enquiry_id' => $record->id,
                'action' => 'Options Sent',
                'update_status_user' => $shortlisted_by_auth_user
            );
            \App\UpdateStatusLog::create($update_status_log);

         }

         $sucess_mail = trans('others.success-mailsent');

         return response()->json([ 'success'=> [$sucess_mail] ]);

            }

           
            
        }
    } 

    //End Shortlisted Properties Share 

   //Mail Visits Share 

  public function propertiesVisitsShare() {
    if (request()->ajax()) {

        $action = request('action');

        $id = request('visit_property_id');   

        $item = \App\Property::findOrFail($id);

        $sub = substr($action, -3);


        if ( 'vis' === $sub ) {
            $action = substr($action, 0, -4);
        }

        if ( 'vis' === $sub ) {
         $template = EmailTemplate::where('key', '=', $action)->first();
        return view( 'home-pages.common.shortlist-visit-listing.forms.property-visits-form', compact('item', 'action', 'sub','template'));
        }

  }
 } 

  //End Visits Share 
     
   //Send Visits

  public function sendPropertiesVisitsShare( Request $request ) {

        if (request()->ajax()) {

          if(isDemo()){
                
                return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                      
            }else{

              $action                = $request->action;
            $toname                = $request->toname;
            $toemail               = $request->toemail;
            $mail_mobile           = $request->mail_mobile;
            $ccemail               = $request->ccemail;
            
            $mail_description      = $request->mail_description;
            $company_name          = $request->company_name;
            $no_of_seats           = $request->no_of_seats;
            $visit_date            = $request->visit_date;
            $visit_time            = $request->visit_time;
            $cc_emails = [];

            $cc_emails = $ccemail;

            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

           $mail = [
                'toname' => $toname,
                'toemail' => $toemail,
                'mail_mobile' => $mail_mobile,
                'mail_description' => $mail_description,
                'visit_date' => $visit_date,
                'visit_time' => $visit_time,

                'site_address' => getSetting( 'site_address', 'site_settings'),
                'site_phone' => getSetting( 'site_phone', 'site_settings'),
                'site_email' => getSetting( 'contact_email', 'site_settings'),                
                'site_title' => getSetting( 'site_title', 'site_settings'),
                'country_code' => $country_code,
                'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                'date' => date('Y-m-d'),
                'site_url' => config('app.url'),
                       
            ];

            if( $cc_emails == '' || $cc_emails == null){
                \Mail::to($toemail)
                ->send(new EmailVisitsPropertiesMail($mail)); 
            }else{
                \Mail::to($toemail)
                ->cc( explode(',' , $cc_emails ) )
                ->send(new EmailVisitsPropertiesMail($mail)); 
            } 

        $record = Enquire::where('email', $toemail)->first();
         if($record){
             $properties_visits = \App\Property::with(['property_sub_space_types'])->where( 'schedule_visit' , 'no' )->get();
            
            $schedulevisit_by_auth_user = Auth::user()->name;
            $record->scheduled_properties =  json_encode($properties_visits);
            $record->update_status = 'Visit Scheduled';
            $record->progress = 50;
            $record->save();

            $update_status_log = array(
                'enquiry_id' => $record->id,
                'action' => 'Visit Scheduled',
                'update_status_user' => $schedulevisit_by_auth_user
            );
            \App\UpdateStatusLog::create($update_status_log);

         }

        $properties_visits = \App\Property::where( 'schedule_visit' , 'no' )->get();

        foreach($properties_visits as $visit){
          
            $property_manager_email = $visit->property_manager_email;

            $toname     = $visit->property_manager_name;
            $toemail    = $property_manager_email;

            if( $property_manager_email ){

            $mail = [
                'toname' => $visit->property_manager_name,
                'toemail' => $property_manager_email,
                'mail_mobile' => $mail_mobile,
                'mail_description' => $mail_description,
                'visit_date' => $visit_date,
                'visit_time' => $visit_time,

                'site_address' => getSetting( 'site_address', 'site_settings'),
                'site_phone' => getSetting( 'site_phone', 'site_settings'),
                'site_email' => getSetting( 'contact_email', 'site_settings'),                
                'site_title' => getSetting( 'site_title', 'site_settings'),
                'country_code' => $country_code,
                'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                'date' => date('Y-m-d'),
                'site_url' => config('app.url'),
                       
            ];

         \Mail::to($toemail)
         ->send(new EmailVisitsPropertiesMail($mail));
            }
        }

         $success_sent = trans('others.success-mailsent');   

          return response()->json(['success'=> [$success_sent]]);

            }
            
            
        }
   }

   //End Visits       
}
