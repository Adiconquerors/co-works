<div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-pink">
                    <i class="mdi mdi-comment-multiple-outline float-right text-dark"></i>
                    <a href="<?php echo e(route('thismonthinquiries.export')); ?>">
                    <h6 class="text-pink text-uppercase m-b-15 m-t-10"> <?php echo app('translator')->getFromJson('custom.dashboard.inquiries-this-month'); ?> ( <?php echo e(\Carbon\Carbon::now()->format('M')); ?> )</h6>
                    </a>
                    <h2 class="m-b-10" data-plugin="counterup"><?php echo e($inquiries_count); ?>  </h2>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-info">
                    <i class="mdi mdi-account-multiple float-right text-dark"></i>
                    <h6 class="text-info text-uppercase m-b-15 m-t-10">
                     <a href="<?php echo e(route('users.export')); ?>" > 
                        <?php echo app('translator')->getFromJson('custom.dashboard.registered-users'); ?>
                    </a>
                    </h6>
                    <h2 class="m-b-10"><span data-plugin="counterup"><?php echo e($total_users_count); ?></span></h2>
                </div>
            </div>