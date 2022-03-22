<?php
namespace App\Http\Controllers;

use App\Enquire;
use App\Property;
use App\Invoice;
use App\Exports\EnquireExport;
use App\Exports\ThisMonthEnquireExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Notifications\WL_EmailNotification;
use Notification;
use Twilio\Rest\Client;
use App\Mail\LandLordPropertyMail;
use Auth;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnquireController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        
       if( ! ( isAdmin() || isAgent() ) ){
        return redirect()->back();
       } 

        if(isAdmin()){
           $items = Enquire::where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->where('update_status','!=','Deal Completed')->orderBy('updated_at', 'desc')
                ->get();      
        }
        if(isAgent()){
            $items = Enquire::where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->where('update_status','!=','Deal Completed')->orderBy('updated_at', 'desc')
                ->get();
        }
        $data = [
                'title' => trans('others.add-inquiry'), 
                'items' => $items,
                'active_class' => trans('others.enquiries')
              ];
        
        return view('admin.enquires.list', $data);
    }

    public function seekerDetailsIndex()
    {

        $data = ['items' => Invoice::where('action', 'booking-initiated')->where('paymentstatus','!=','partially paid')->get() , 'active_class' => 'lead_seeker_details'];

        return view('admin.enquires.dealtracker.seeker-details-received', $data);
    }


    // Deal tracker booking Initiated
    public function bookingInitiatedDetailsIndex()
    {

        if( ! ( isAdmin() || isAgent() ) ){
        return redirect()->back();
       }

      

        $data = [
                 'items' => Enquire::where('update_status','Booking Initiated')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->get(), 
                 'active_class' => trans('others.enquiries')
                ];

      
        return view('admin.enquires.dealtracker.dealtracker-booking-initiated', $data);
    }
    //end dealtracker booking initiated

    //payment received or Deal completed
    public function dealsCompleted()
    {
        if( ! ( isAdmin()   || isAgent() || isCustomer()  ) ){
        return redirect()->back();
       }

       

       $data = [
                 'items' => Enquire::where('update_status','Deal Completed')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')
                 ->latest('updated_at')->get(), 
                 'active_class' => trans('others.enquiries')
                ];

        return view('admin.enquires.dealtracker.dealtracker-deal-completed', $data);
    }
//End Deals Completed

    

        //Exporting the inquiries data in excel format
    public function inquiriesExport() 
    {
        return Excel::download(new EnquireExport, 'inquiries.xlsx');
    }

    //Exporting the present month inquiries data in excel format
    public function presentMonthInquiriesExport() 
    {
        return Excel::download(new ThisMonthEnquireExport, 'thismonthinquiries.xlsx');
    }


    //payment received or Deal completed
    public function paymentReceived()
    {

       $data = [
                 'items' => Invoice::where('action', 'booking-initiated')->where('paymentstatus','paid')->get() ,
                 'active_class' => 'booking_initiated_details'
                ];

        return view('admin.enquires.dealtracker.dealtracker-deal-completed', $data);
    }

    //end payment received or deal completed
    // Unpaid Invoices
    public function unpaidInvoices()
    {

        $data = [
                  'items' => ListingInvoice::where('paymentstatus', 'unpaid')->get() , 
                ];

        return view('admin.invoices.unpaid-invoices', $data);
    }
    //end unpaid invoices



    //Client Bookings
    public function clientBookings()
    {
        if( ! ( isAdmin() ) )
       {
        return redirect()->back();
       }  

       $data = [
                 'items' => Enquire::where('update_status','Deal Completed')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->get(), 
                 'active_class' => 'enquires'
                ];

        return view('admin.enquires.clients.client-bookings', $data);
    }
    //End Client Bookings
    //Client Payment Data
       public function clientPaymentData()
    {
        if( ! ( isAdmin() ) )
       {
        return redirect()->back();
       }  

       $data = [
                 'items' => Enquire::where('update_status','Deal Completed')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->get(), 
                 'active_class' => trans('others.enquiries')
                ];

        return view('admin.enquires.clients.client-booking-data', $data);
    }
//End Client Payment Data
    
    public function enquiryFilter(Request $request)
    {

        if (request()->ajax())
        {

            $lead_address = request('lead_address');
            $lead_assigned_to = request('lead_assigned_to');
            $lead_name = request('lead_name');
            $lead_email = request('lead_email');
            $lead_number = request('lead_number');
            $lead_status = request('lead_status');

            $active_class = trans('others.enquiries');

            if (empty($lead_assigned_to))
            {
                $query = \App\Enquire::query()->where('assigned_to', 0);
            }
            else
            {
                
                $query = \App\Enquire::query()->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no');
            }

           
            $query->when($lead_assigned_to, function ($q, $lead_assigned_to)
            {
                return $q->where('enquires.assigned_to', 'like', "%$lead_assigned_to%");
            });

            $query->when($lead_name, function ($q, $lead_name)
            {
                return $q->where('enquires.name', 'like', "%$lead_name%");
            });

            $query->when($lead_status, function ($q, $lead_status)
            {
                return $q->where('enquires.update_status', 'like', "%$lead_status%");
            });

            $query->when($lead_email, function ($q, $lead_email)
            {
                return $q->where('enquires.email', 'like', "%$lead_email%");
            });

            $query->when($lead_number, function ($q, $lead_number)
            {
                return $q->where('enquires.phone_number', 'like', "%$lead_number%");
            });

            $query->when($lead_address, function ($q, $lead_address)
            {
                return $q->where('enquires.address', 'like', "%$lead_address%");
            });

           
            // end space type
            if (empty($lead_assigned_to))
            {
                $items = $query->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->where('update_status','!=','Deal Completed')->paginate(50);
            }
            else
            {
                $items = $query->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('update_status','!=','Deal Completed')->where('junk_lead','no')->paginate(50);
            }

            return view('admin.enquires.enquiry-list', compact('items', 'active_class'));

        }

    }

       //Enquiry Booking Initiated Filters
    public function bookingInitiatedFilter(Request $request)
    {
        
        if (request()->ajax())
        {

            $property_address = request('property_address');
            $property_id = request('property_id');
            $property_company = request('property_company');
            $space_type = request('space_type');
           
            $active_class = trans('others.enquiries');

            $query = \App\Property::query();
            

             $query->when($property_address, function ($q, $property_address)
            {
                return $q->where('properties.property_address', 'like', "%$property_address%");
            });

               $query->when($property_company, function ($q, $property_company)
            {
                return $q->where('properties.company', 'like', "%$property_company%");
            });


             $query->when($property_id, function ($q, $property_id)
            {
                return $q->where('properties.id', 'like', "%$property_id%");
            });

          // space type
            $query->when($space_type, function ($q, $space_type)
            {
                return $q->whereHas("property_sub_space_types", function ($query) use ($space_type)
                {
                    $query->where('space_type_id', $space_type);
                });
            });

           
            $booking_properties = $query->get();
         

            return view('admin.enquires.forms.booking-initiated-filters-list', compact('booking_properties', 'active_class'));

        }

    }

    //End Enquiry Booking Initiated Filters

     /**
     * Enquire junklead.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function junklead( $id , $junk_lead)
    {
        $record = Enquire::getRecordWithId($id);
        $active_class = trans('others.enquiries');
        $record->junk_lead = $junk_lead;
        $record->deal_status = 'Junk Lead';
        $record->save();

        return redirect()
            ->route('leads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
                  'record' => false, 
                  'title' => ucfirst('add Lead') , 
                  'active_class' => trans('others.enquiries')
                ];

        return view('admin.enquires.add-edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'bail|required', 'description' => 'bail|required', ]);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record = Enquire::create($request->all());       

        $this->processUpload($request, $record, "image");

        flashMessage( 'success', 'create' );
        return redirect()->route('testimonials.index');
    }

    //send enquire otp
    public function enquireOtp(Request $request, $slug)
    {
        if (request()->ajax())
        {
            $rules = ['phone_number' => 'required', 'email' => 'required', 'name' => 'required', ];
            $enquiry_id = $request->enquiry_id;
            $action = $request->action;
            if ($enquiry_id != '' && $action == 'confirm')
            {
                $rules['otp'] = ['required', Rule::exists('enquires')->where(function ($query) use ($enquiry_id)
                {
                    $query->where('id', $enquiry_id);
                })->where(function ($query)
                {
                    $query->where('otp', request()->otp);
                }) , ];
            }
            elseif ($enquiry_id != '' && $action == 'resend')
            {
                $rules['otp'] = ['nullable', Rule::exists('enquires')->where(function ($query) use ($enquiry_id)
                {
                    $query->where('id', $enquiry_id);
                })->where(function ($query)
                {
                    $query->where('otp_used', '>=', OTP_MAX_SEND);
                }) ];
            }
            $validator = Validator::make($request->all() , $rules);

            if (!$validator->passes())
            {
                return response()
                    ->json(['error' => $validator->errors()
                    ->all() ]);
            }
            $record = Property::getRecordWithSlug($slug);
            //$enquire_otp  = "1234";
            $sample_otp = rand();
            if (!empty($enquiry_id))
            {
                $enquire = Enquire::find($enquiry_id);
                if ($enquire)
                {
                    if ($action == 'resend')
                    {


                if( env('APP_SMS') ) {
                  $enquire_otp  = "1234";
                 }else{
                       $enquire_otp = substr(str_shuffle("0123456789") , 0, OTP_LENGTH);

                      

                    //start sms 
                      $default_sms_gateway = getSetting( 'default_sms_gateway', 'site_settings', '');

                       $return = array(
                              'status' => 'success',
                              'message' => trans( 'custom.smstemplates.message-sent' ),
                          );

                              if ( ! empty( $default_sms_gateway )) {
                                $config = array(
                                'sid' => '',
                                'token' => '',
                                'from' => '',
                              );

                      
                          
                          if ( 'twilio' === $default_sms_gateway ) {
                              $config = array(
                                  'sid' => getSetting( 'TWILIO_SID', 'twilio', ''),
                                  'token' => getSetting( 'TWILIO_TOKEN_EDIT', 'twilio', ''),
                                  'from' => getSetting( 'TWILIO_FROM', 'twilio', ''),
                              );
                              $twilio = new Client($config['sid'], $config['token']);
                              $res = $twilio->messages->create(
                                  // Where to send a text message (your cell phone?)
                                  '+' . $enquire->phone_number,
                                  array(
                                      'from' => $config['from'],
                                      'body' => 'Your one time password is: ' . $enquire_otp,
                                  )
                              );



                              if ( ! empty( $res->status ) && 'failed' === $res->status ) {
                                  $return['status'] = 'failed';
                                  $return['message'] =  $res->status;
                              }   
                              
                          } elseif( 'nexmo' === $default_sms_gateway ) {
                              $api_key = getSetting( 'NEXMO_API_KEY', 'nexmo', '');
                              $secret_key = getSetting( 'NEXMO_API_SECRET', 'nexmo', '');

                              if ( ! empty( $api_key ) && ! empty( $secret_key ) ) {
                                  $client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Basic($api_key, $secret_key));
                                  
                                   $tonumber = '+' . $enquire->phone_number;
                                  $message = $client->message()->send([
                                      'to' => $tonumber,
                                      'from' => 'Vonage APIs',
                                      'text' => 'Your one time password is: ' . $enquire_otp
                                  ]);

                                  if ( isset( $message['status'] ) && $message['status'] == 'failed' ) {
                                      $return['status'] = 'failed';
                                      $return['message'] = $message['message'];
                                  }
                              } else {
                                  $return['status'] = 'failed';
                                  $return['message'] = trans( 'custom.messages.sms-gateway-not-set' );
                              }
                          } elseif( 'plivo' === $default_sms_gateway ) {
                              $auth_id = getSetting( 'auth_id', 'plivo', '');
                              $auth_token = getSetting( 'auth_token', 'plivo', '');
                              
                              if ( ! empty( $auth_id ) && ! empty( $auth_token ) ) {
                                  $client = new \Plivo\RestClient($auth_id, $auth_token);

                                  $response = $client->accounts->get();
                                  
                                  if ( $response->cashCredits > 0 ) {
                                      $message = $client->messages->create(
                                              '919866233855',
                                              [$enquire->phone_number],
                                              'Your one time password is: ' . $enquire_otp
                                          );
                                  } else {
                                      $return['status'] = 'failed';
                                      $return['message'] = trans( 'custom.messages.sms-gateway-no-credits' );
                                  }                    
                              } else {
                                  $return['status'] = 'failed';
                                  $return['message'] = trans( 'custom.messages.sms-gateway-not-set' );
                              }
                          } // Plivo end.  
                          
                      } 
                      //end sms
                 }
                       
                              

                        $enquire->otp = $enquire_otp;
                        $enquire->otp_used = $enquire->otp_used + 1;
                        $action = 'resend';
                        $enquire->save();
                    }
                    else
                    {
                        $enquire->is_phone_verified = 'yes';
                        $enquire->status = '1';
                        $enquire->otp = null;
                        $action = 'confirmed';
                        $enquire->save();


            //Multiple emails to the admin
                $admins   = \App\User::whereHas("roles",
                     function ($query) {
                         $query->where('id', ADMIN_ROLE_ID);
                     })->get();

                $inquired_property_id = $enquire->property_id;
                
                $inquired_properties = \App\Property::find($inquired_property_id);

                $property_name = $inquired_properties ? $inquired_properties->name : '';
                $property_address = $inquired_properties ? $inquired_properties->property_address : '';
                $property_slug = $inquired_properties ? $inquired_properties->slug : '';

                $property_customer_id = $inquired_properties ? $inquired_properties->customer_id : '';

                 $property_customer = \App\User::find($enquire->customer_id);


                    $logo = $inquired_properties ? $inquired_properties->cover_image : public_path("/assets/images/default-imgs/1.jpg");
                    
                    $site_logo = getSetting( 'site_logo', 'site_settings' );
                    $country_code = getSetting('country_code','site_settings');

                           if(!isDemo()){
                                                 
                     $templatedata = array(
                             'user_name' => $enquire->name,
                             'user_mobile' => $enquire->phone_number,
                             'user_email' => $enquire->email,
                             'company' => $enquire->company,
                             'address' => $enquire->address ?? '',
                             'property_id' => $inquired_property_id,
                             'property_name' => $property_name,
                             'content' => 'Property has been Inquired',
                             'property_url' => route( 'properties.show', [ 'slug' => $property_slug ] ),
                             'property_address'=> $property_address,
                             'logo' => $logo,

                             'country_code' => $country_code,
                            'site_address' => getSetting( 'site_address', 'site_settings'),
                            'site_phone' => getSetting( 'site_phone', 'site_settings'),
                            'site_email' => getSetting( 'contact_email', 'site_settings'),                
                            'site_title' => getSetting( 'site_title', 'site_settings'),
                            'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                            'date' => date('Y-m-d'),
                            'site_url' => env('APP_URL'),
                         );
                   $data = [

                             'template' => 'property-inquired-admin',
                             'data' => $templatedata,
                         ];
                     $notification = new WL_EmailNotification($data);
                     Notification::send($admins, $notification);
                // end multiple emails to admin

             //Notify to the Customer

                 if($property_customer){


                         $templatedata = array(
                             'property_id' => $inquired_property_id,   
                             'property_name' => $property_name,
                             'content' => 'Property has been Inquired',
                             'property_url' => route( 'properties.show', [ 'slug' => $property_slug ] ),
                             'property_address'=> $property_address,
                             'logo' => $logo,

                            'country_code' => $country_code,
                            'site_address' => getSetting( 'site_address', 'site_settings'),
                            'site_phone' => getSetting( 'site_phone', 'site_settings'),
                            'site_email' => getSetting( 'contact_email', 'site_settings'),                
                            'site_title' => getSetting( 'site_title', 'site_settings'),
                            'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                            'date' => date('Y-m-d'),
                            'site_url' => env('APP_URL'),
                            );

                            $data = [
                                 'template' => 'property-inquired-customer',
                                 'data' => $templatedata,
                            ];
                        $property_customer->notify(new WL_EmailNotification($data));   
                 }    

        //End Notify to the Customer 
                             }
 
                    }
                }
            }
            else
            {
                 

                $user_mobile = $request->phone_number;
                $user_name = $request->name;
                $user_email = $request->email;
                $address = $request->address;


                 if( env('APP_SMS') ) {
                  $enquire_otp  = "1234";
                 }else{

                 $enquire_otp = substr(str_shuffle("0123456789") , 0, OTP_LENGTH);

                  //start sms 
                  $default_sms_gateway = getSetting( 'default_sms_gateway', 'site_settings', '');

                   $return = array(
                          'status' => 'success',
                          'message' => trans( 'custom.smstemplates.message-sent' ),
                      );

                          if ( ! empty( $default_sms_gateway )) {
                            $config = array(
                            'sid' => '',
                            'token' => '',
                            'from' => '',
                          );

                  
                      
                      if ( 'twilio' === $default_sms_gateway ) {
                          $config = array(
                              'sid' => getSetting( 'TWILIO_SID', 'twilio', ''),
                              'token' => getSetting( 'TWILIO_TOKEN_EDIT', 'twilio', ''),
                              'from' => getSetting( 'TWILIO_FROM', 'twilio', ''),
                          );
                          $twilio = new Client($config['sid'], $config['token']);
                          $res = $twilio->messages->create(
                              // Where to send a text message (your cell phone?)
                              '+' . $user_mobile,
                              array(
                                  'from' => $config['from'],
                                  'body' => 'Your one time password is: ' . $enquire_otp,
                              )
                          );



                          if ( ! empty( $res->status ) && 'failed' === $res->status ) {
                              $return['status'] = 'failed';
                              $return['message'] =  $res->status;
                          }   
                          
                      } elseif( 'nexmo' === $default_sms_gateway ) {
                          $api_key = getSetting( 'NEXMO_API_KEY', 'nexmo', '');
                          $secret_key = getSetting( 'NEXMO_API_SECRET', 'nexmo', '');

                          if ( ! empty( $api_key ) && ! empty( $secret_key ) ) {
                              $client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Basic($api_key, $secret_key));
                              
                              $data['tonumber'] = '+' . $user_mobile;
                              $message = $client->message()->send([
                                  'to' => $data['tonumber'],
                                  'from' => 'Vonage APIs',
                                  'text' => 'Your one time password is: ' . $enquire_otp
                              ]);

                              if ( isset( $message['status'] ) && $message['status'] == 'failed' ) {
                                  $return['status'] = 'failed';
                                  $return['message'] = $message['message'];
                              }
                          } else {
                              $return['status'] = 'failed';
                              $return['message'] = trans( 'custom.messages.sms-gateway-not-set' );
                          }
                      } elseif( 'plivo' === $default_sms_gateway ) {
                          $auth_id = getSetting( 'auth_id', 'plivo', '');
                          $auth_token = getSetting( 'auth_token', 'plivo', '');
                          
                          if ( ! empty( $auth_id ) && ! empty( $auth_token ) ) {
                              $client = new \Plivo\RestClient($auth_id, $auth_token);

                              $response = $client->accounts->get();
                              
                              if ( $response->cashCredits > 0 ) {
                                  $message = $client->messages->create(
                                          '919866233855',
                                          [$user_mobile],
                                          'Your one time password is: ' . $enquire_otp
                                      );
                              } else {
                                  $return['status'] = 'failed';
                                  $return['message'] = trans( 'custom.messages.sms-gateway-no-credits' );
                              }                    
                          } else {
                              $return['status'] = 'failed';
                              $return['message'] = trans( 'custom.messages.sms-gateway-not-set' );
                          }
                      } // Plivo end.  
                      
                  } 
                  //end sms

          }
                
                      
                  

                $enquire = new Enquire();

                if ( ! isDemo() ) {

                 $enquire->phone_number = $user_mobile;
                $enquire->name = $user_name;
                $enquire->email = $user_email;
                $enquire->property_id = $record->id;
                $enquire->company = $request->company;
                $enquire->address = $address;
                $enquire->capacity_id = $request->capacity_id;
                $enquire->description = $request->description;
                $enquire->enquire_date = $request->enquire_date;
                $enquire->enquire_from = $request->enquire_from;
                $enquire->enquire_time_from = $request->enquire_time_from;
                $enquire->enquire_time_to = $request->enquire_time_to;
                $enquire->enquire_month = $request->enquire_month;
                $enquire->customer_id = Auth::id();
                $enquire->otp = $enquire_otp;
                $enquire->otp_used = 1;
                $enquire->save();
                $action = 'confirm';

            }

            if( env('APP_SMS') ) {
              $sample_otp = '1234';
            }else{
                $sample_otp = '';
            }

         }

               
          if ( !isDemo() ) {
              $response = ['status' => 'success','enquire_otp'=>$sample_otp, 'message' => 'Otp has been sent successfully!', 'confirmation' => 'Form submitted successfully!', 'enquire_id' => $enquire->id, 'action' => $action];
          }else{
              $response = ['status' => trans('custom.messages.crud_disabled'),'enquire_otp'=>'', 'message' => trans('custom.messages.crud_disabled'), 'confirmation' => trans('custom.messages.crud_disabled'), 'enquire_id' => '', 'action' => ''];
          }
            

            echo json_encode($response);

        }
    }

    public function destroy($id)
    {
      if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record = Enquire::getRecordWithId($id);
        $record->delete();

        flashMessage( 'success', 'delete' );
        return redirect()
            ->route('enquire.index');
    }

    // Client Dashboard
    public function clientsDashboard()
    {

        if( ! ( isAdmin() ) )
       {
        return redirect()->back();
       }  
       

        $data = ['items' => Enquire::where('update_status', 'Deal Completed')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->get(),  'active_class' => trans('others.clients')];

        return view('admin.enquires.clients.client', $data);
    }

    //End Client Dashboard


         //Deal Completed 
     public function dealCompleted( $id )
    {

      if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
      }

        $record = Enquire::getRecordWithId($id);
       
        $active_class = 'enquires';
        $booking_initiated = json_decode($record->booking_initiated, true);
        $booking_initiated["action"] = "deal-completed";
        $record->booking_initiated = json_encode($booking_initiated);
        $record->update_status = "Deal Completed";
        $record->deal_status = "Deal Completed";
        $record->progress = 100;
        $record->save();

        $invoice_random_number = mt_rand(10000000, 99999999);

        $invoices = array(
            'property_id' => $record->id,
            'action' => $booking_initiated["action"] ?? '',
            'customer_id' => $record->customer_id,
            'currency_id' => $record->customer->currency->id,
            'no_of_seats' => $booking_initiated["no_of_seats"] ?? '',
            'company_address' => !empty($address) ? $address : '',
            
            'total_amount' => $booking_initiated["booking_amount"] ?? '',
            'description' => !empty($record->description) ? $record->description : '',
            'invoice_id' => $invoice_random_number,
          );
        \App\Invoice::create($invoices);

        return redirect()
            ->back();
    }

    //Deal Completed Paid
     public function dealsPaid( $id )
    {

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record = Enquire::getRecordWithId($id);
        $active_class = trans('others.enquiries');
        $record->payment_status = 'paid';
        $record->save();

        return redirect()
            ->back();
    }

     //Deal Completed Unpaid
     public function dealsUnpaid( $id )
    {
       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record = Enquire::getRecordWithId($id);
        $active_class = trans('others.enquiries');
        $record->payment_status = 'unpaid';
        $record->save();

        return redirect()
            ->back();
    }
    
    
}

