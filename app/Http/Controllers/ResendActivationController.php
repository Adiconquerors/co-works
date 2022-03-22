<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResendVerificationMail;
use Illuminate\Http\Request;

class ResendActivationController extends Controller
{
   public function activation()
    {
        
        $record = User::where('email', $request->email)->first();
        $confirmation_code = str_random(30);

         $addtional = array(
            'status' => 1,
            'confirmation_code' => $confirmation_code,
            );

        $record->save();

         $mail = [
            'activation_link' => route('user.activate', $addtional['confirmation_code']),
            ];

        \Mail::to('ravitejauiux@gmail.com')->send(new ResendVerificationMail($mail));
   
    }
   
}
