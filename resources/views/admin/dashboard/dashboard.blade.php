@extends('layouts.new_admin_layout')

@section( 'new_content' )
    
<style>
    .dn-img{
        width: 100px; height: 66px;
    }
    .card-box{
    padding: 20px 7px; 
    }
    
</style>

     <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('custom.dashboard.dashboard') </h4>
                   
                    <div class="clearfix"></div>
                </div>
            </div>


        </div>
        <!-- end row -->
        <?php

            if(isAdmin()){
            $listings_count = \App\Property::count();
            }
            if( isLandLord() || isCustomer() )
            {
                $listings_count = \App\Property::where('customer_id', Auth::id())->count();
            }

            if(isAdmin() || isAgent()){
             $total_inquiries = \App\Enquire::count();

             $booking_initiated = \App\Enquire::where('assigned_to',getContactId())->where('update_status','Booking Initiated')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')->count();

             $deals_completed = \App\Enquire::where('assigned_to',getContactId())->where('update_status','Deal Completed')->where('is_phone_verified','yes')->where('deal_lost_no','no')->where('junk_lead','no')
                 ->latest('updated_at')->count();
            }

            if( isCustomer() ){
             $total_inquiries = \App\Enquire::where('customer_id', getContactId())->count();
             $unpaid_invoices = \App\Invoice::where('paymentstatus','unpaid')->where('customer_id', getContactId())->count();
             $paid_invoices = \App\PaymentHistory::where('paymentstatus','success')->where('customer_id', getContactId())->count();
            }
             

            $currentMonth = date('m');
            $inquiries_count = \App\Enquire::whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->count();

            $total_users_count = \App\User::where('is_email_verified','yes')->where('is_mobile_verified','yes')->count(); 

        ?>

        <div class="row">
             <?php if(isAdmin()) { ?>   
            <div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-success">
                    <i class="mdi mdi-currency-usd float-right text-dark"></i>
                    <a href="{{ route('inquiries.export') }}">
                    <h6 class="text-success text-uppercase m-b-15 m-t-10">@lang('custom.dashboard.total-inquiries')</h6>
                    </a>
                    
                    <h2 class="m-b-10"><span data-plugin="counterup">{{$total_inquiries}}</span></h2>
                </div>
            </div>
           <?php } elseif(isAgent()) { ?>
                @include('admin.dashboard.agent.dashboard-cards')
           <?php } elseif(isCustomer()) { ?>

            @include('admin.dashboard.customer.dashboard-cards')
           
            <?php } ?>    


            @if(isAdmin() || isLandLord())
            <div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-primary">
                    <i class="mdi mdi-home-map-marker float-right text-dark"></i>
                 @if(isAdmin())
                    <a href="{{ route('properties.export') }}">
                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">
                    @lang('custom.dashboard.total-properties')
                    </h6>
                   </a>
                   @else
                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">
                    @lang('custom.dashboard.total-properties')
                    </h6>
                   @endif
                    
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ $listings_count }}</span></h2>
                </div>
            </div>
            @endif
           
           @if( isAdmin() )  
                @include('admin.dashboard.admin.dashboard-cards')
            @endif

        </div>
        <!-- 22 end row -->

       <div class="row">
          <?php 
            if( isAdmin() ){ 
           ?>
          <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('custom.dashboard.recent-users')</h4>
                    <table class="table table-centered m-b-0">
                       @include('admin.dashboard.admin.recent-users',compact('latest_registered_users'))
                    </table>
                </div>

            </div> 
            <!-- end col -->
          <!-- start col -->
            <div class="col-xl-6">
              @include('admin.dashboard.admin.recent-properties',compact('latest_properties'))
            </div> <!-- end col -->
         
        <?php } else if( isCustomer() ) { ?>

                     <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('custom.recent-roperties-inquiry')</h4>
                    <table class="table table-centered m-b-0">
                       @include('admin.dashboard.customer.customer-recent-inquiries',compact('customer_latest_inquiries'))
                    </table>
                </div>

            </div> 
            <!-- end col -->
        

        <?php } else if(isLandlord()) { ?>
            
             <!-- start col -->
            <div class="col-xl-6">
                @include('admin.dashboard.landlord.recent-properties',compact('latest_landlord_properties'))
            </div> 
            <!-- end col -->

        <?php } else if(isAgent()) { ?>
                 <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">@lang('others.recent-assigned-leads')</h4>
                    <table class="table table-centered m-b-0">
                       @include('admin.dashboard.agent.agent-recent-inquiries',compact('latest_agent_assigned_leads'))
                    </table>
                </div>

            </div> 
            <!-- end col -->

             <!-- start col -->
            <div class="col-xl-6">
              @include('admin.dashboard.agent.recent-approved-properties',compact('latest_approved_properties'))
            </div> <!-- end col -->

        <?php } ?>    

     </div>
        <!-- end row -->   
@stop
