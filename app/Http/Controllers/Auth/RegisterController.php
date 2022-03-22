<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Notifications\WL_EmailNotification;
use Notification;


use Illuminate\Support\MessageBag;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'number'],
            'currency_id' => ['required'],
            'password' => ['required', 'string', 'min:6'],
            
        ]);
    }



   public function getRegister()
      {
        return view('profile');
        }

        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $name = $data['name'];

        $user    = new User();

        $user->name            = $name;        
        $user->email           = $data['email'];        
        $user->currency_id     = $data['currency_id'];        
        $user->mobile          = $data['mobile']; 
        $user->remember_token  = str_random(30);       
        $user->password        = bcrypt($data['password']);


        $user->save();
       
            
        return $user;
   
    }

       
      

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'min:10'],
            'currency_id' => ['required'],
            'password' => ['required', 'string', 'min:6'],
            
        ]);

        if ($validator->passes()) {
            $data = array(
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'currency_id' => $request->currency_id,
                'password' => $request->password,                       
            );

            $sign_in_as = $request->sign_in_as;

            $confirmation_code = str_random(30);


            if( env('APP_SMS') ) {
                  $otp  = "1234";
            }else{
                $otp = substr(str_shuffle("0123456789"), 0, OTP_LENGTH);
            }


            $name = $data['name'];
            $user         = new User();
            $user->name   = $name;
            $user->email     = $data['email'];
            if( $sign_in_as == "1" ){
              $user->role_id = ADMIN_ROLE_ID;  
            }elseif($sign_in_as == "2"){
              $user->role_id = LANDLORD_ROLE_ID;
            }elseif($sign_in_as == "3"){
              $user->role_id = CUSTOMER_ROLE_ID;
            }
            else{
              $user->role_id = AGENT_ROLE_ID;
            }
            $user->mobile     = $data['mobile'];
            $user->currency_id     = $data['currency_id'];
            $user->password = bcrypt($data['password']);
            $user->remember_token = str_random(30);
            $user->confirmation_code =  $confirmation_code;
            $user->otp = $otp;         
            $user->save();



                    $site_logo = getSetting( 'site_logo', 'site_settings' );
                    $country_code = getSetting('country_code','site_settings');

                     $templatedata = array(
                                  'name' => $user->name,
                                  
                                  'content' => 'Email Verification',
                                  'confirmation_link' => url('/') . '?code=' . $confirmation_code . '&email=' .$request->email ,
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

                             'template' => 'email-verification',
                             'data' => $templatedata,
                         ];
                     $user->notify(new WL_EmailNotification($data)); 

             if( ! env('APP_SMS') ) {
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
                          '+' . $user->mobile,
                          array(
                              'from' => $config['from'],
                              'body' => 'Your one time password is: ' . $otp,
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
                          
                          $tonumber = '+' . $user->mobile;
                          $message = $client->message()->send([
                              'to' => $tonumber,
                              'from' => 'Vonage APIs',
                              'text' => 'Your one time password is: ' . $otp
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
                                      [$user->mobile],
                                      'Your one time password is: ' . $otp
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
              
            
           
            
            return response()->json(['success_register'=> ['Success, An activalion link has been sent to your email !']]);
 
    } else {
        return response()->json(['error'=>$validator->errors()->all()]);  
    }

   }


//RESEND VERIFICATION LINK
    public function resendEmailVerification( Request $request ){

        $email = $request->email;

        $user  = \App\User::where( 'email', $email )->first();

        $user->confirmation_code = str_random(30);

        $user->save();    

        
              $site_logo = getSetting( 'site_logo', 'site_settings' );
              $country_code = getSetting('country_code','site_settings');

               $templatedata = array(
                            'name' => $user->name,
                            
                            'content' => 'Email Verification',
                            'confirmation_link' => url('/') . '?code=' .  $user->confirmation_code . '&email=' .$request->email ,
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

                       'template' => 'email-verification',
                       'data' => $templatedata,
                   ];
               $user->notify(new WL_EmailNotification($data)); 

        return response()->json(['resend'=> ['Success, An activalion link has been sent to your email !']]);


    }
  //END RESET VERIFICATION LINK


    
}
