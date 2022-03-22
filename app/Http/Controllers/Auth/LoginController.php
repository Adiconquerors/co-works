<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Mail;

use Twilio\Rest\Client;

use Carbon\Carbon;
use \Auth;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('install');
        $this->middleware('guest', ['except' => 'logout']);
    }



   public function getLogin()
    {
      return view('auth.login');
    }


 


  // This method auhtenticate the registered user
    public function postLogin(Request $request)
    {


        $login_status = FALSE;

        $remember = FALSE;

        if( $request->has('remember') )
            $remember = TRUE;


        if ( Auth::attempt(['email'=>$request->email , 'password' => $request->password,'status'=>1],$remember)) {


            $login_status = TRUE;
        }



        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);


        if ($validator->passes() && $login_status ) {

            // Let us set the user default language as per admin settings.
            $direction = 'ltr';
            $lang = 'en';

            updateLocalSettings();

            return redirect()->route('dashboard')
            ->withCookie(cookie()->forever('language', $lang))
            ->withCookie(cookie()->forever('direction', $direction));

           return response()->json(['success'=>'Login Success!']);
        }else{
          if ( ! $validator->passes() ) {
            return response()->json(['error'=>$validator->errors()->all()]);
          } else {
            $record = User::where('email', $request->email)->first();
            if ( $record ) {
              if ( $record->status == 1 &&    $record->is_email_verified  == 'no') {
                return response()->json(['error'=> [ 'You have not yet confirm your email address ' . $request->email . '. Click <a href="{{ '.route( "resend.activation" ).' }}">here</a> to resend activation link.']] );
              } else {
                return response()->json(['error'=> [ 'Credentials not matched with our records.']] );
              }
            } else {
              return response()->json(['error'=> [ 'Credentials not matched with our records.']] );
            }
          }

         }


    }

    public function validateUser( Request $request ) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'mobile' => 'required|exists:users,mobile',
            'confirmation_code' => 'required',
            'otp' => 'required',
        ]);

        if ( ! $validator->passes() ) {
          return response()->json(['error'=>$validator->errors()->all()]);
        }

        $email = $request->email;
        $confirmation_code = $request->confirmation_code;
        $mobile = $request->mobile;
        $otp = $request->otp;

        $record = User::where('email', $email)->first();
        if( ! $record ) {
             return response()->json(['error'=> [ 'User not found with the email provided']] );
        } else {
          if ( $record->confirmation_code != $confirmation_code ) {
            return response()->json(['error'=> [ 'Confirmation code is wrong. Please check your email address.']] );
          } else if ( $record->mobile != $mobile ) {
            return response()->json(['error'=> [ 'Mobile number is wrong.']] );
          } else if ( $record->otp != $otp ) {
            return response()->json(['error'=> [ 'OTP is wrong.']] );
          } else {
            $record->email_verified_at = Carbon::now();
           
            $record->is_email_verified = 'yes';
            $record->is_mobile_verified = 'yes';
            $record->otp = null;
            $record->status = 1;
            $record->save();

            flashMessage('success', 'create', 'Your mobile number validated successfully. Please login here.');
            return response()->json(['success'=> 'Validation Success!']);
          }
        }
    }

    public function resendOtp( Request $request ) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'mobile' => 'required|exists:users,mobile',
            'confirmation_code' => 'required',
        ]);

        if ( ! $validator->passes() ) {
          return response()->json(['error'=>$validator->errors()->all()]);
        }

        $email = $request->email;
        $confirmation_code = $request->confirmation_code;
        $mobile = $request->mobile;

        $record = User::where('email', $email)->where('confirmation_code', $confirmation_code)->where('mobile', $mobile)->first();
        // dd($record);
        if( ! $record ) {
             return response()->json(['error'=> [ 'User not found with the details provided']] );
        } else {
            if ( $record->is_mobile_verified == 'yes' ) {
              return response()->json(['error'=> [ 'Your mobile already verified. Please login.']] );
            } else if ( $record->otp_used >= OTP_MAX_SEND ) {
              return response()->json(['error'=> [ 'You can not use OTP feature for more than ' . OTP_MAX_SEND . ' times. Please contact administrator.']] );
            } else {
              $otp = substr(str_shuffle("0123456789"), 0, OTP_LENGTH);
              //start sms 
              $default_sms_gateway = getSetting( 'default_sms_gateway', 'site_settings', '');
              $default_sms_gateway = 'twilio';

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

              
                  $mobile = env('COUNTRY_CODE') . $mobile;
                  if ( 'twilio' === $default_sms_gateway ) {
                      $config = array(
                          'sid' => getSetting( 'TWILIO_SID', 'twilio', ''),
                          'token' => getSetting( 'TWILIO_TOKEN_EDIT', 'twilio', ''),
                          'from' => getSetting( 'TWILIO_FROM', 'twilio', ''),
                      );
                      $twilio = new Client($config['sid'], $config['token']);
                      $res = $twilio->messages->create(
                          // Where to send a text message (your cell phone?)
                          '+' . $mobile,
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
                          
                          $tonumber = '+' . '919989960505';
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
                                      [$mobile],
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


  
               
                      

              $sendResponse = (Object) array(
                'status' => 'success',
              );
              //$otp = '1234';
              if ($sendResponse->status == 'success') {
                $record->otp = $otp;
                $record->otp_used = $record->otp_used + 1;
                $record->save();
                return response()->json(['success'=> [ 'We have send OTP to your mobile number. Please check and enter the same here.']]);
              } else {
                return response()->json(['error'=> [ 'There was an error while sending SMS. Please contact site admin for more details.']] );
              }
            }

        }
    }


     /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */

    public function confirm( $confirmation_code)
    {

        $record = User::where('confirmation_code', $confirmation_code)->first();
        if( ! $record ) {
             return response()->json(['error'=>'invalid-link']);
        }

        $record->email_verified_at = Carbon::now();
        $record->confirmation_code = null;
        $record->status = 1;

        $record->save();

    }

      
    public function logout(Request $request)
    {

      Auth::logout();

    	return redirect('/');
        
    }


    public function sendSms() {
        $mobile = '919866211858';
        $otp = rand();
        $config = array(
            'sid' => getSetting( 'TWILIO_SID', 'twilio', ''),
            'token' => getSetting( 'TWILIO_TOKEN_EDIT', 'twilio', ''),
            'from' => getSetting( 'TWILIO_FROM', 'twilio', ''),
        );
        $twilio = new Client($config['sid'], $config['token']);
        $res = $twilio->messages->create(
            // Where to send a text message (your cell phone?)
            '+' . $mobile,
            array(
                'from' => $config['from'],
                'body' => 'Your one time password is: ' . $otp,
            )
        );

        echo $res->status;
        dd($res);

      }


}
