<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\WL_EmailNotification;
use Notification;
use Hash;
use Validator;
use DB;

class CustomResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Where to redirect users after resetting their password.
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

     public function validatePasswordRequest( Request $request )
    { 
        $email = $request->email;

        $user = \App\User::where('email', '=', $email)
        ->first();
      

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
        ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {

             $user_email = $request->email;
             $token = $tokenData->token; 

             $link = config('app.url') . 'password/reset/' . $token . '?email=' . urlencode($request->email);

          $templatedata = array(
            'content' => 'Forget password',
            'link' => $link,
               
            );

            $data = [
            'template' => 'forgot-password',
            'data' => $templatedata,
            ];
          $user->notify(new WL_EmailNotification($data));


        return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
        return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendResetEmail($email, $token)
   {
         //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('email', 'email')->first();
        
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('app.url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        

        try {
        //Here send the link with CURL with an external email API 
         return true;
        } catch (\Exception $e) {
         return false;
        }
   }

   public function resetPassword(Request $request)
  { 
        //Validate input
        $validator = Validator::make($request->all(), [
        'email' => 'required|exists:users,email',
        'password' => 'required|confirmed'
        ]);

        //check if input is valid before moving on
        if ($validator->fails()) {
         return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;

        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.login');

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
        ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
        return view('/home');
        } else {
        return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
     }   
}
