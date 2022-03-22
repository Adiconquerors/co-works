<?php $__env->startSection( 'new_content' ); ?>
    
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
                    <h4 class="page-title"><?php echo app('translator')->getFromJson('custom.dashboard.dashboard'); ?> </h4>
                   
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
                    <a href="<?php echo e(route('inquiries.export')); ?>">
                    <h6 class="text-success text-uppercase m-b-15 m-t-10"><?php echo app('translator')->getFromJson('custom.dashboard.total-inquiries'); ?></h6>
                    </a>
                    
                    <h2 class="m-b-10"><span data-plugin="counterup"><?php echo e($total_inquiries); ?></span></h2>
                </div>
            </div>
           <?php } elseif(isAgent()) { ?>
                <?php echo $__env->make('admin.dashboard.agent.dashboard-cards', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php } elseif(isCustomer()) { ?>

            <?php echo $__env->make('admin.dashboard.customer.dashboard-cards', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           
            <?php } ?>    


            <?php if(isAdmin() || isLandLord()): ?>
            <div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-primary">
                    <i class="mdi mdi-home-map-marker float-right text-dark"></i>
                 <?php if(isAdmin()): ?>
                    <a href="<?php echo e(route('properties.export')); ?>">
                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">
                    <?php echo app('translator')->getFromJson('custom.dashboard.total-properties'); ?>
                    </h6>
                   </a>
                   <?php else: ?>
                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">
                    <?php echo app('translator')->getFromJson('custom.dashboard.total-properties'); ?>
                    </h6>
                   <?php endif; ?>
                    
                    <h2 class="m-b-10"><span data-plugin="counterup"><?php echo e($listings_count); ?></span></h2>
                </div>
            </div>
            <?php endif; ?>
           
           <?php if( isAdmin() ): ?>  
                <?php echo $__env->make('admin.dashboard.admin.dashboard-cards', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

        </div>
        <!-- 22 end row -->

       <div class="row">
          <?php 
            if( isAdmin() ){ 
           ?>
          <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('custom.dashboard.recent-users'); ?></h4>
                    <table class="table table-centered m-b-0">
                       <?php echo $__env->make('admin.dashboard.admin.recent-users',compact('latest_registered_users'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </table>
                </div>

            </div> 
            <!-- end col -->
          <!-- start col -->
            <div class="col-xl-6">
              <?php echo $__env->make('admin.dashboard.admin.recent-properties',compact('latest_properties'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div> <!-- end col -->
         
        <?php } else if( isCustomer() ) { ?>

                     <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('custom.recent-roperties-inquiry'); ?></h4>
                    <table class="table table-centered m-b-0">
                       <?php echo $__env->make('admin.dashboard.customer.customer-recent-inquiries',compact('customer_latest_inquiries'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </table>
                </div>

            </div> 
            <!-- end col -->
        

        <?php } else if(isLandlord()) { ?>
            
             <!-- start col -->
            <div class="col-xl-6">
                <?php echo $__env->make('admin.dashboard.landlord.recent-properties',compact('latest_landlord_properties'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div> 
            <!-- end col -->

        <?php } else if(isAgent()) { ?>
                 <!-- start col -->
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('others.recent-assigned-leads'); ?></h4>
                    <table class="table table-centered m-b-0">
                       <?php echo $__env->make('admin.dashboard.agent.agent-recent-inquiries',compact('latest_agent_assigned_leads'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </table>
                </div>

            </div> 
            <!-- end col -->

             <!-- start col -->
            <div class="col-xl-6">
              <?php echo $__env->make('admin.dashboard.agent.recent-approved-properties',compact('latest_approved_properties'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div> <!-- end col -->

        <?php } ?>    

     </div>
        <!-- end row -->   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>