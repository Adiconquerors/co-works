<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        if(Auth::check())
        {
            return redirect()->route('dashboard');    
        } 
         return view('auth.login');
    }

      public function showChangePasswordForm(){
        $active_class = trans('others.changepassword');
        return view('auth.changepassword',compact('active_class'));
    }


}
