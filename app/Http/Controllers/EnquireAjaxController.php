<?php
namespace App\Http\Controllers;

use App\Enquire;
use App\Property;
use App\EmailTemplate;
use Auth;
use Validator;
use App\Notifications\WL_EmailNotification;
use Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnquireAjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function important(Request $request)
    {
        if (request()->ajax())
        {

            $lead_id = $request->lead_id;
            $flag_color = $request->flag_color;

            if (!empty($lead_id))
            {
                $important_lead = Enquire::find($lead_id);
                
                if ($important_lead)
                {
                    $important_lead->flag_color = $flag_color;
                    $important_lead->save();

                }

            }

            return response()
                ->json(['success' => 'Marked as important', 'lead_id' => $lead_id, 'flag_color' => $flag_color, 'removed' => 'Removed from important']);
        }

    }

    public function seekerDetails(Request $request)
    {
        if (request()->ajax())
        {
            $action = request('action');
            $id = request('enquiry_id');

            $seeker_name = $request->seeker_name;
            $seeker_email = $request->seeker_email;
            $seeker_phone_number = $request->seeker_phone_number;

            $item = Enquire::findOrFail($id);

            $sub = substr($action, -3);

            if ('ema' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('req' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('com' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('sit' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('ign' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('mai' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('sta' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('boo' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('del' === $sub)
            {
                $action = substr($action, 0, -4);
            }
             elseif ('sha' === $sub)
            {
                $action = substr($action, 0, -4);
            } 
            elseif ('dat' === $sub)
            {
                $action = substr($action, 0, -4);
            } 
            elseif ('psa' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('per' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('tax' === $sub)
            {
                $action = substr($action, 0, -4);
            }

            if ('ema' === $sub)
            {
                return view('admin.enquires.forms.seeker-details-form', compact('item', 'action', 'sub'));
            }
            elseif ('req' === $sub)
            {
                return view('admin.enquires.forms.requirement-details-form', compact('item', 'action', 'sub'));
            }
            elseif ('com' === $sub)
            {
                return view('admin.enquires.forms.comments-details-form', compact('item', 'action', 'sub'));
            } elseif ('sit' === $sub)
            {
                return view('admin.enquires.forms.visit-details-form', compact('item', 'action', 'sub'));
            }
            elseif ('ign' === $sub)
            {
                return view('admin.enquires.forms.assigned-details-form', compact('item', 'action', 'sub'));
            }
            elseif ('mai' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();
                return view('admin.enquires.forms.mail-details-form', compact('item', 'action', 'sub', 'template'));
            }
            elseif ('sta' === $sub)
            {
                return view('admin.enquires.forms.update-status-form', compact('item', 'action', 'sub'));
            }
            elseif ('boo' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();
                return view('admin.enquires.forms.booking-initiated-form', compact('item', 'action', 'sub', 'template'));
            }
            elseif ('del' === $sub)
            {
                return view('admin.enquires.forms.deal-lost-form', compact('item', 'action', 'sub'));
            }
            elseif ('sha' === $sub)
            {
                return view('admin.enquires.forms.properties-shared', compact('item', 'action', 'sub'));
            }
            elseif ('psa' === $sub)
            {
                return view('admin.enquires.forms.payment-status-amount-form', compact('item', 'action', 'sub'));
            }
             elseif ('dat' === $sub)
            {
                return view('admin.enquires.forms.booking-start-date-form', compact('item', 'action', 'sub'));
            }  
          
             elseif ('per' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();

                return view('admin.enquires.forms.proforma-invoice-form', compact('item', 'action', 'sub', 'template'));
            }
            elseif ('tax' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();
                return view('admin.enquires.forms.tax-invoice-form', compact('item', 'action', 'sub', 'template'));
            }

            
        }

    }

    //save seeker details
    public function saveSeekerDetails(Request $request)
    {
        if (request()->ajax())
        {

            $post = request('data');
            
            $sub = $post['sub'];

            $id = $post['enquiry_id'];
            $action = $post['action'];

            $response = array(
                'status' => 'danger',
                'message' => 'Something went wrong'
            );

            $item = Enquire::findOrFail($id);

      
            if ($action == 'seeker-details')
            {

                //seeker details
                $seeker_name = $post['seeker_name'];
                $seeker_email = $post['seeker_email'];
                $seeker_phone_number = $post['seeker_phone_number'];
                //end seeker details
                $item->name = $seeker_name;
                $item->email = $seeker_email;
                $item->phone_number = $seeker_phone_number;

                if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{

                $item->save();
                }

            }
            elseif ($action == 'requirement-details')
            {
                //req details
                $capacity_id = $post['capacity_id'];
                $req_booking_date = $post['req_booking_date'];
                $req_booking_months = $post['req_booking_months'];
                //endreq details
                $item->capacity_id = $capacity_id;
                $item->enquire_date = $req_booking_date;
                $item->enquire_month = $req_booking_months;

                 if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{
                    
                $item->save();
                }
            }
            elseif ($action == 'bookingstart-date')
            {
                $booking_start_date = $post['booking_start_date'] ? $post['booking_start_date'] : null;
                $revenue_generated  = $post['revenue_generated'] ? $post['revenue_generated'] : null;
                $payment_mode  = $post['payment_mode'] ? $post['payment_mode'] : null;
                
                $item->revenue_generated = $revenue_generated;
                $item->booking_start_date = $booking_start_date;
                $item->payment_mode = $payment_mode;
                
                if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{
                    
                $item->save();
                }
            }
            elseif ($action == 'paymentstatus-totalamount')
            {
                $amount_paid = $post['amount_paid'];
                $item->amount_paid = $amount_paid;
                
                $item->save();
            }
            elseif ($action == 'comments-details')
            {
                //comments details
                $comments = $post['comments'];
                //end comments details
                $item->comments = $comments;
                if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{
                    
                $item->save();
                }
            }elseif ($action == 'visit-details')
            {
                //visit details
                $visit_details = $post['visit_details'];
                $item->visit_details = $visit_details;
                 if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{
                    
                $item->save();
                }
            }
            elseif ($action == 'assigned-details')
            {
                //comments details
                $assigned_to = $post['assigned_to'];
                //end comments details
                $item->assigned_to = $assigned_to;

                if(isDemo()){
                
                  return response()->json(['success'=>trans('custom.messages.crud_disabled') ]);
                              
                }else{
                    
                $item->save();
                }
            }

            elseif ($action == 'mail-message')
            {

                if(!isDemo()){  

                         $data = array();

                $id = !empty($post['enquiry_id']) ? $post['enquiry_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                $customer_id = !empty($post['customer_id']) ? $post['customer_id'] : '';
                if(! empty($customer_id))
                {
                    $customer = \App\User::find($customer_id);
                    if( $customer ){
                        $data['customer'] = $customer ? $customer->name : '';
                    }
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $data['content'] = $post['message'];


                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $data[ 'site_address' ] = getSetting( 'site_address', 'site_settings');
                $data[ 'site_phone' ] = getSetting( 'site_phone', 'site_settings');
                $data[ 'site_email' ] = getSetting( 'contact_email', 'site_settings');                
                $data[ 'site_title' ] = getSetting( 'site_title', 'site_settings');
                $data[ 'country_code' ] = $country_code;
                $data[ 'site_logo' ] = asset( 'uploads/settings/' . $site_logo );
                $data[ 'date' ] = date('Y-m-d');
                $data[ 'site_url' ] = config('app.url');

                $mail_description =  $post['mail_description'];
                if ( $mail_description == '' || $mail_description == null)
                {
                    $data['mail_description'] = '';
                }else{
                    $data['mail_description'] = $mail_description;    
                }

                $res = sendEmail($action, $data);

                }
               

            }
            elseif ($action == 'update-status')
            {
                
                //comments details
                $update_status = $post['update_status'];
               
                $update_status_user = $post['update_status_user'];
                $update_status_created = $post['update_status_created'];
                $update_status_updated = $post['update_status_updated'];
                //end comments details


                $item->update_status = $update_status;


                if ($item->update_status == "Requirement Received")
                {
                    $item->progress = 25;
                    
                }
                elseif ($item->update_status == "Options Sent")
                {
                    $item->progress = 35;
                    
                }
                elseif ($item->update_status == "Visit Scheduled")
                {

                    $item->progress = 50;
                    
                }
                elseif ($item->update_status == "Booking Initiated")
                {
                    $item->progress = 90;
                    
                }
                elseif ($item->update_status == "Deal Completed")
                {
                    $item->progress = 100;
                    
                }

                 if(!isDemo()){ 
                    
                        $item->save();

                        $update_status_log = array(
                        'enquiry_id' => $id,
                        'action' => $action,
                        'update_status_user' => $update_status_user,
                        'update_status_created' => $update_status_created,
                        'update_status_updated' => $update_status_updated,
                        );
                        \App\UpdateStatusLog::create($update_status_log);   

                 } 
                 
               

            }
            elseif ($action == 'booking-initiated')
            {
               if(!isDemo()){ 

                      $data = array();
                
                $id = !empty($post['enquiry_id']) ? $post['enquiry_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                $to_name = !empty($post['toname']) ? $post['toname'] : '';
                if (!empty($to_name))
                {
                    $data['toname'] = $to_name;
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $cc_email = !empty($post['ccemail']) ? $post['ccemail'] : '';
                if (!empty($cc_email))
                {
                    $data['ccemail'] = $cc_email;
                }

                $attach_file = $item->booking_initiated_file ?? '';
                 
                 $data['attachments'] = array();
                    if ( ! empty( $attach_file ) ? $attach_file : '' ) {
                        $file = $attach_file;
                        if ( file_exists( $file ) ) {
                        $data['attachments'][] = $file;
                    }
                }


                $mail_description = !empty($post['mail_description']) ? $post['mail_description'] : '';
                if (!empty($mail_description))
                {
                    $data['mail_description'] = $mail_description;
                }

                $booking_initiated_property_id = !empty($post['booking_initiated_property_id']) ? $post['booking_initiated_property_id'] : '';

               $properties = \App\Property::find($booking_initiated_property_id);
              

               $property_company_name = !empty($properties) ? $properties->company : '';

               $property_manager_name = !empty($properties) ? $properties->property_manager_name : '';

                $property_address = !empty($properties) ? $properties->property_address : '';

                 $pan_card = !empty($properties) ? $properties->pan_no : '';


                if (!empty($property_company_name))
                {
                    $data['property_company_name'] = $property_company_name;
                }

                if ( $pan_card == '' || $pan_card == null)
                {
                    $data['pan_card'] = '';
                }else{
                    $data['pan_card'] = $pan_card;    
                }

                if (!empty($property_manager_name))
                {
                    $data['property_manager_name'] = $property_manager_name;
                }

                if (!empty($property_address))
                {
                    $data['property_address'] = $property_address;
                }

                 $booking_months =  $post['booking_months'];
                if ( $booking_months == '' || $booking_months == null)
                {
                    $data['booking_months'] = '';
                }else{
                    $data['booking_months'] = $booking_months;    
                }

                $booking_amount =  $post['booking_amount'];
                if ( $booking_amount == '' || $booking_amount == null)
                {
                    $data['booking_amount'] = '';
                }else{
                    $data['booking_amount'] = $booking_amount;    
                } 

             $booking_date =  $post['booking_date'];
                if ( $booking_date == '' || $booking_date == null)
                {
                    $data['booking_date'] = '';
                }else{
                    $data['booking_date'] = $booking_date;    
                }
              

               $no_of_seats =  $post['no_of_seats'];
                if ( $no_of_seats == '' || $no_of_seats == null)
                {
                    $data['no_of_seats'] = '';
                }else{
                    $data['no_of_seats'] = $no_of_seats;    
                }



               $data['content'] = $post['message'];


                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $data[ 'site_address' ] = getSetting( 'site_address', 'site_settings');
                $data[ 'site_phone' ] = getSetting( 'site_phone', 'site_settings');
                $data[ 'site_email' ] = getSetting( 'contact_email', 'site_settings');                
                $data[ 'site_title' ] = getSetting( 'site_title', 'site_settings');
                $data[ 'country_code' ] = $country_code;
                $data[ 'site_logo' ] = asset( 'uploads/settings/' . $site_logo );
                $data[ 'date' ] = date('Y-m-d');
                $data[ 'site_url' ] = config('app.url');
                        

                $res = sendEmail( $action, $data );

                $item->update_status = 'Booking Initiated';
                $item->progress = 90;
                $item->save();

            if($booking_initiated_property_id) {   
                 
                 $booking_initiated = array(
                    'booking_initiated_property_id'=>$booking_initiated_property_id, 
                    'customer_id' => $item->customer_id, 
                    'no_of_seats' => $no_of_seats,
                    'customer_name' => !empty($to_name) ? $to_name : '',
                    'customer_email' => !empty($to_email) ? $to_email : '',
                    'customer_mobile' => !empty($mail_mobile) ? $mail_mobile : '',
                    'description' => !empty($mail_description) ? $mail_description : '',
                    'booking_date' => !empty($booking_date) ? $booking_date : '',
                    'action' => $action,
                    'booking_months' => $booking_months,
                    'booking_amount' => $booking_amount,
                   );
                   
                    $item->booking_initiated = json_encode($booking_initiated);   
                    $item->save();
               }


                $bookinginitiated_by_auth_user = Auth::user()->name;

                $update_status_log = array(
                'enquiry_id' => $item->id,
                'action' => 'Booking Initiated',
                'update_status_user' => $bookinginitiated_by_auth_user
                );
                \App\UpdateStatusLog::create($update_status_log);

               }
                    
            }
            elseif ($action == 'deal-lost')
            {

                if(!isDemo()){
                        $deal_comments = $post['deal_comments'];
                        $deal_lost = $post['deal_lost'];
                        $enquiry_id = $post['enquiry_id'];
                        //deal lost
                        $item->deal_comments = $deal_comments;
                        $item->deal_lost = $deal_lost;
                        $item->deal_lost_no = 'yes';
                        $item->deal_status = 'Deal Lost';

                        $item->save();    
                }

                //deal lost

            }
            elseif ($action == 'raise-proforma-invoice')
            {

               if(!isDemo()){
                    $data = array();

                $id = !empty($post['enquiry_id']) ? $post['enquiry_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                $company_name = !empty($post['company_name']) ? $post['company_name'] : '';
                if (!empty($company_name))
                {
                    $data['company_name'] = $company_name;
                }

                $to_name = !empty($post['toname']) ? $post['toname'] : '';
                if (!empty($to_name))
                {
                    $data['toname'] = $to_name;
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $cc_email = !empty($post['ccemail']) ? $post['ccemail'] : '';
                if (!empty($cc_email))
                {
                    $data['ccemail'] = $cc_email;
                }

                $no_of_seats = !empty($post['no_of_seats']) ? $post['no_of_seats'] : '';
                if (!empty($no_of_seats))
                {
                    $data['no_of_seats'] = $no_of_seats;
                }

                $invoice_amount = !empty($post['invoice_amount']) ? $post['invoice_amount'] : '';
                if (!empty($invoice_amount))
                {
                    $data['invoice_amount'] = $invoice_amount;
                }

                $mail_description = ! empty($post['mail_description']) ? $post['mail_description'] : '';
                if ( !( empty($mail_description) ) ) 
                {
                    $data['mail_description'] = $mail_description;
                }

                $mail_mobile = !empty($post['mail_mobile']) ? $post['mail_mobile'] : '';
                if (!empty($mail_mobile))
                {
                    $data['mail_mobile'] = $mail_mobile;
                }

                $company_address = !empty($post['company_address']) ? $post['company_address'] : '';
                if (!empty($company_address))
                {
                    $data['company_address'] = $company_address;
                }


                $invoice_gstin = !empty($post['invoice_gstin']) ? $post['invoice_gstin'] : '';
                if (!empty($invoice_gstin))
                {
                    $data['invoice_gstin'] = $invoice_gstin;
                    $data['cgst'] = $invoice_gstin/2;
                    $data['sgst'] = $invoice_gstin/2;
                }

               $gstin_number = !empty($post['gstin_number']) ? $post['gstin_number'] : '';
                if (!empty($gstin_number))
                {
                    $data['gstin_number'] = $gstin_number;
                } 


                if ($invoice_gstin == "" || $invoice_gstin == 0)
                {
                    $invoice_gstin = 0;
                    $total_amount = $invoice_amount;

                }
                else
                {

                    $total_amount = $invoice_amount + ($invoice_gstin / 100 * $invoice_amount);
                }

                if (!empty($total_amount))
                {
                    $data['total_amount'] = $total_amount;
                }

                $data['content'] = !empty($post['message']) ? $post['message'] : '';

                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $data[ 'site_address' ] = getSetting( 'site_address', 'site_settings');
                $data[ 'site_phone' ] = getSetting( 'site_phone', 'site_settings');
                $data[ 'site_email' ] = getSetting( 'contact_email', 'site_settings');                
                $data[ 'site_title' ] = getSetting( 'site_title', 'site_settings');
                $data[ 'country_code' ] = $country_code;
                $data[ 'site_logo' ] = asset( 'uploads/settings/' . $site_logo );
                $data[ 'date' ] = date('Y-m-d');
                $data[ 'site_url' ] = config('app.url');

                $res = sendEmail( $action, $data );

                $item->raise_proforma_sent = 'yes';
                $item->save();
               } 
                

            }
            elseif ('raise-tax-invoice')
            {

               if(!isDemo()){
                             $data = array();

                $id = !empty($post['enquiry_id']) ? $post['enquiry_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                 $company_name = !empty($post['company_name']) ? $post['company_name'] : '';
                if (!empty($company_name))
                {
                    $data['company_name'] = $company_name;
                }


                $to_name = !empty($post['toname']) ? $post['toname'] : '';
                if (!empty($to_name))
                {
                    $data['toname'] = $to_name;
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $cc_email = !empty($post['ccemail']) ? $post['ccemail'] : '';
                if (!empty($cc_email))
                {
                    $data['ccemail'] = $cc_email;
                }

              

                $no_of_seats = !empty($post['no_of_seats']) ? $post['no_of_seats'] : '';
                if (!empty($no_of_seats))
                {
                    $data['no_of_seats'] = $no_of_seats;
                }

                $invoice_amount = !empty($post['invoice_amount']) ? $post['invoice_amount'] : '';
                if (!empty($invoice_amount))
                {
                    $data['invoice_amount'] = $invoice_amount;
                }

                $mail_description = !empty($post['mail_description']) ? $post['mail_description'] : '';
                if (!empty($mail_description))
                {
                    $data['mail_description'] = $mail_description;
                }

                $mail_mobile = !empty($post['mail_mobile']) ? $post['mail_mobile'] : '';
                if (!empty($mail_mobile))
                {
                    $data['mail_mobile'] = $mail_mobile;
                }

                $company_address = !empty($post['company_address']) ? $post['company_address'] : '';
                if (!empty($company_address))
                {
                    $data['company_address'] = $company_address;
                }

                $invoice_gstin = !empty($post['invoice_gstin']) ? $post['invoice_gstin'] : '';
                if (!empty($invoice_gstin))
                {
                    $data['invoice_gstin'] = $invoice_gstin;
                    $data['cgst'] = $invoice_gstin/2;
                    $data['sgst'] = $invoice_gstin/2;
                }

             $gstin_number = !empty($post['gstin_number']) ? $post['gstin_number'] : '';
                if (!empty($gstin_number))
                {
                    $data['gstin_number'] = $gstin_number;
                } 

                $data['content'] = !empty($post['message']) ? $post['message'] : '';

                if ($invoice_gstin == "" || $invoice_gstin == 0)
                {
                    $invoice_gstin = 0;
                    $total_amount = $invoice_amount;

                }
                else
                {

                    $total_amount = $invoice_amount + ($invoice_gstin / 100 * $invoice_amount);
                }

                 if (!empty($total_amount))
                {
                    $data['total_amount'] = $total_amount;
                }


                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $data[ 'site_address' ] = getSetting( 'site_address', 'site_settings');
                $data[ 'site_phone' ] = getSetting( 'site_phone', 'site_settings');
                $data[ 'site_email' ] = getSetting( 'contact_email', 'site_settings');                
                $data[ 'site_title' ] = getSetting( 'site_title', 'site_settings');
                $data[ 'country_code' ] = $country_code;
                $data[ 'site_logo' ] = asset( 'uploads/settings/' . $site_logo );
                $data[ 'date' ] = date('Y-m-d');
                $data[ 'site_url' ] = config('app.url');

                $res = sendEmail( $action, $data );

                $item->tax_invoice_sent = 'yes';
                $item->save();

            }  
               } 
             
           if(isDemo()){
                   return response()
                    ->json(['success' => trans('custom.messages.crud_disabled')]);
           }else{
            
                return response()
                ->json(['success' => 'Successfully Saved']);
           }    
           

        }

    }
    // end save seeker details
    //Booking initiated for selected property
    public function bookingInitiatedForSelectedProperty(Request $request)
    {
        if (request()->ajax())
        {
            $enquiry_id = $request->enquiry_id;
            $id = $request->booking_property_id;

            $item = \App\Property::findOrFail($id);

            $property_id = $item->id;
            $property_name = $item->name;
            $property_address = $item->property_address;
            $company_name = $item->company;
            $property_cover_image = $item->cover_image;
            $property_capacity = $item->capacity;
            $property_sub_space_types = $item->property_sub_space_types;
            $property_phone_number = $item->phone_number;

             
            $property_sub_space_types = $item->property_sub_space_types;

          

         $price_per_month = 'NA';
                   if ( ! empty( $property_sub_space_types ) ) {
                    foreach( $property_sub_space_types as $details ) {
                     if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
                      $price_per_month = $details->price_per_month;
                     break; // Let us take first value as default.
                    }
                  }
                 }

			foreach( $property_sub_space_types as $property_sub_space_type){    
			$space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
				if( $space_types ){
				$property_space_type_name = $space_types->name;
				}
				else{
				$property_space_type_name = '';
				}
			} 


            return response()
                ->json(['success' => 'Selected', 'property_name' => $property_name, 'property_id' => $property_id, 'company_name' => $company_name, 'property_cover_image' => $property_cover_image,'property_address'=>$property_address,'price_per_month'=>$price_per_month,'property_capacity'=>$property_capacity,'property_space_type_name'=>$property_space_type_name,'property_phone_number'=>$property_phone_number]);

        }
    }
    //end Booking initiated for selected property

    //UploadImageAjax
    public function uploadImageAjax(Request $request)
    {
        if (request()->ajax())
        {

         if(!isDemo()){
                $enquiry_id = $_POST['enquiry_id'] ;
                $item = \App\Enquire::findOrFail($enquiry_id);

                if($_FILES['file']['name'] != ''){
                $test = explode('.', $_FILES['file']['name']);
                $extension = end($test);
                $name = rand(100,999).'.'.$extension;

                $location = public_path('thumb/booking-initiated-files/'.$name);
                move_uploaded_file($_FILES['file']['tmp_name'], $location);

                $item->booking_initiated_file =  $location;
                $item->save();    
            }


         }   
        if(isDemo()){
            return response()->json(['success' =>  trans('custom.messages.crud_disabled'), 'enquiry_id' => '' ]);
        }else{

            return response()->json(['success' => 'Image Uploaded Successfully', 'enquiry_id' => $enquiry_id ]);

        }

        }
    }
    //End Upload Image Ajax
    
}

