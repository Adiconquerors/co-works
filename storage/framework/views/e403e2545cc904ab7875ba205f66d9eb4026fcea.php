  
  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('others.recent-unpaid-invoices'); ?></h4>

                   <?php if( ! empty( $customer_latest_unpaid_invoices ) ): ?>
                     <?php $__currentLoopData = $customer_latest_unpaid_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                            $properties = \App\Property::find( $latest_invoice->property_id );              
                             $cover_image = $properties ? $properties->cover_image : '';
                        ?>
                    <div class="media latest-post-item mt-3">
                        <?php if( $cover_image ): ?>
                        <div class="media-left mr-2">
                        <a href="javascript:void(0);"> <img class="media-object dn-img
                        dn-img" alt="64x64" src="<?php echo e(url( $cover_image )); ?>" > </a>
                        </div>
                        <?php else: ?>
                           <div class="media-left mr-2">
                            <a href="javascript:void(0);"> <img class="media-object dn-img" alt="64x64" src="<?php echo e(PUBLIC_ASSETS); ?>images/default-imgs/1.jpg"> </a>
                        </div>  
                        <?php endif; ?>
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><a href="#"><?php echo e($properties ? $properties->company : ''); ?></a> </h5>
                           
                        </div>
                     <div class="text-right">
                        <a href="<?php echo e(route('unpaidinvoice.show',$latest_invoice->id)); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank"><?php echo app('translator')->getFromJson('custom.dashboard.pay'); ?></a>
                    </div>
                </div>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php endif; ?>
                </div> <!-- end card-box -->