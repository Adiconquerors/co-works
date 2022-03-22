<?php

namespace App\Http\Controllers;

use App\MembershipFee;
use Illuminate\Http\Request;

class MembershipFeesController extends Controller
{

     public function __construct()
    { 
     $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

          $data = 
      [
        'title'         => trans('others.add-new-membershipfees'), 
        'items'         => MembershipFee::get(),
        'active_class'  => trans('others.membershipfees')
      ]; 
      
      return view('admin.membershipfees.list',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = 
      [
        'record'        => FALSE, 
        'title'         => trans('others.add-membership'),
        'active_class'  => trans('others.membershipfees')
      ];
        
        return view('admin.membershipfees.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        } 
        
        $record = MembershipFee::create($request->all());

        flashMessage( 'success', 'create' );
        return redirect()->route('membership_fees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipFees  $membershipFees
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipFees  $membershipFees
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
         
         $record  = MembershipFee::getRecordWithId($id);

         $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.membershipfees'),
        'title'         => trans('others.edit-membershipfees'),
      ];
   
        return view('admin.membershipfees.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipFees  $membershipFees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id )
    {
        

        $record  = MembershipFee::getRecordWithId($id);
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $record->update($request->all());        

        flashMessage( 'success', 'update' );
        return redirect()->route('membership_fees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipFees  $membershipFees
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }   

         $record = MembershipFee::getRecordWithId($id);
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('membership_fees.index');
    }
}
