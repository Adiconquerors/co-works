<div class="col-xl-3 col-md-6">
       <div class="card-box tilebox-two tilebox-success">
            <i class="mdi mdi-currency-usd float-right text-dark"></i>
            <h6 class="text-success text-uppercase m-b-15 m-t-10"><?php echo app('translator')->getFromJson('custom.dashboard.total-inquiries'); ?></h6>

            <h2 class="m-b-10"><span data-plugin="counterup"><?php echo e($total_inquiries); ?></span></h2>
        </div>
    </div>

     <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two tilebox-pink">
            <i class="mdi mdi-comment-multiple-outline float-right text-dark"></i>
            <a href="javascript:void(0);">
            <h6 class="text-pink text-uppercase m-b-15 m-t-10">  <?php echo app('translator')->getFromJson('custom.dashboard.booking-initiated'); ?></h6>
            </a>
            <h2 class="m-b-10" data-plugin="counterup"><?php echo e($booking_initiated); ?>  </h2>
        </div>
    </div>

     <div class="col-xl-3 col-md-6">
       <div class="card-box tilebox-two tilebox-success">
            <i class="mdi mdi-currency-usd float-right text-dark"></i>
            <h6 class="text-success text-uppercase m-b-15 m-t-10"> <?php echo app('translator')->getFromJson('custom.dashboard.deals-completed'); ?></h6>

            <h2 class="m-b-10"><span data-plugin="counterup"><?php echo e($deals_completed); ?></span></h2>
        </div>
 </div>