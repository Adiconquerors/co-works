<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Property; 

class DashboardController extends Controller
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
    public function dashboard()
    {  
         
        $active_class = 'dashboard';
        //Admin
        $latest_registered_users = User::orderBy('id', 'desc')->take(5)->get();  
        $latest_properties = Property::orderBy('id', 'desc')->take(5)->get();
        //Customer
        $customer_latest_inquiries = \App\Enquire::where('customer_id', getContactId())->orderBy('id', 'desc')->latest()->take(5)->get();

        $customer_latest_unpaid_invoices = \App\Invoice::where('customer_id', getContactId())->where('paymentstatus','unpaid')->orderBy('id', 'desc')->get();
       
       
         //Landlord   
         $latest_landlord_properties = Property::where('customer_id', getContactId())->orderBy('id', 'desc')->take(5)->get();
         //Agent
         $latest_agent_assigned_leads = \App\Enquire::where('assigned_to', getContactId())->orderBy('id', 'desc')->take(5)->get();
         $latest_approved_properties = Property::where('is_approved','yes')->orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard.dashboard',compact('active_class','latest_registered_users','latest_properties','customer_latest_inquiries','customer_latest_unpaid_invoices','latest_landlord_properties','latest_agent_assigned_leads','latest_approved_properties'));
    }
}
