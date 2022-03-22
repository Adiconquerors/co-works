<?php

namespace App\Http\Controllers;

use App\Enquire;
use App\Lead;
use App\Property;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class LeadsController extends Controller
{

   public function __construct()
    { 
     $this->middleware('auth');
    }

        public function index( Request $request )
        {

        $deal_lost_status = $request->deal_lost_status;
        $junk_lead_status = $request->junk_lead_status;

         $data = 
        [
        'items'         => Enquire::get(),
        'title'         => trans('others.add-lead'),
        'active_class'  => trans('others.leads')
        ]; 

          return view('admin.leads.list',$data);
        }

      //Filter
   public function dealStatusFilter(Request $request)
    {

        if (request()->ajax())
        {

            $deal_status = request('deal_status');

            $active_class = trans('others.leads');

            $query = \App\Enquire::query();
 
            $query->when($deal_status, function ($q, $deal_status)
            {
                return $q->where('enquires.deal_status', 'like', "%$deal_status%");
            });

            $items = $query->paginate(50);         

            return view('admin.leads.lead-list', compact('items', 'active_class'));

        }

    }
      //End Filter  

    
    public function create()
    {

      if( ! ( isAdmin() || isAgent() ) )
       {
        return redirect()->back();
       }  

        $data = 
      [
        'record'        => FALSE,
        'properties'    => \App\Property::get()->pluck('name', 'id'),
        'customers'     => \App\User::get()->where('is_mobile_verified','yes')->where('role_id',3)->pluck('name', 'id'),
        'title'         => trans('others.add-lead'),
        'active_class'  =>trans('others.leads'),
        'list'          => trans('others.leads'),
      ];

       return view('admin.leads.add-edit', $data);

    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
         $rules = [
       
        
        ];
       
        $request->validate( $rules );

        $record               = new Enquire();

        $customer_id           = $request->customer_id;
        $record->customer_id   = $customer_id;
        if($customer_id){
            $customer_name = \App\User::find($customer_id);
        }
        $record->name = $customer_name->name;

        $record->phone_number  = $request->phone_number;
        $record->email         = $request->email;
        $record->address       = $request->address;
        $record->company       = $request->company;
        $record->capacity_id   = $request->capacity_id;
        $record->property_id   = $request->property_id;
        $record->enquire_month = $request->enquire_month;
        $record->enquire_from  = $request->enquire_from;
        $record->enquire_date  = $request->enquire_date;

        $record->is_phone_verified = 'yes';
        $record->otp = null;
        $record->status = 1;

        $record->save();
    
        return redirect()->route('enquire.index');
    }

   /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $record = Enquire::findOrFail($id);
        $title        = trans('others.view-lead');
        $active_class = trans('others.leads');

        return view('admin.leads.show', compact('record','title','active_class'));
    }

      public function edit( $id )
    {
        $record  = Enquire::getRecordWithId($id);

        $data = 
      [
        'record'        => $record,
        'properties'    => \App\Property::get()->pluck('name', 'id'),
        'customers'     => \App\User::get()->where('is_mobile_verified','yes')->where('role_id',3)->pluck('name', 'id'),
        'active_class'  => trans('others.leads'),
        'title'         => ucfirst('edit lead'),
      ];
   
        return view('admin.leads.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

        

     public function update( Request $request, $id )
    {
     $rules = [
           
      ];
        
        $request->validate( $rules );

        $record  = Enquire::getRecordWithId($id);

        $name                  = $request->name;
        $record->name          = $name;
        $record->phone_number  = $request->phone_number;
        $record->email         = $request->email;
        $record->address       = $request->address;
        $record->company       = $request->company;
        $record->capacity_id   = $request->capacity_id;
        $record->property_id   = $request->property_id;
        $record->enquire_month = $request->enquire_month;
        $record->customer_id   = $request->customer_id;
        $record->enquire_from  = $request->enquire_from;
        $record->enquire_date  = $request->enquire_date;
        
        $record->is_phone_verified = 'yes';
        $record->otp = null;
        $record->status = 1;
        
        $record->save();
        return redirect()->route('leads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
         $record = Enquire::getRecordWithId($id);
         $record->delete(); 

         return redirect()->route('leads.index');
    }


}