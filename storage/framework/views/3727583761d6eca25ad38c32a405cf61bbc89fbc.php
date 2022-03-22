  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Recent Approved Properties</h4>

                   <?php if( ! empty( $latest_approved_properties ) ): ?>
                     <?php $__currentLoopData = $latest_approved_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                         $cover_image = $latest_property->cover_image ?? '';
                         $property_created_by = \App\User::find( $latest_property->customer_id );
                       ?> 
                    <div class="media latest-post-item mt-3">
                        <?php if( $cover_image ): ?>
                        <div class="media-left mr-2">
                        <a href="javascript:void(0);"> <img class="media-object dn-img
                        dn-img" alt="64x64" src="<?php echo e(url( $cover_image )); ?>" > </a>
                        </div>
                        <?php else: ?>
                           <div class="media-left mr-2">
                            <a href="javascript:void(0);"> <img class="media-object dn-img" alt="64x64" src="<?php echo e(IMAGE_PATH_UPLOAD_SPACE_TYPES); ?>1.jpg"> </a>
                        </div>  
                        <?php endif; ?>
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><a href="#"><?php echo e($latest_property->name); ?></a> </h5>
                            <p class="font-13 text-muted">
                                <?php echo e($latest_property->created_at->format('M d , Y')); ?> | <?php echo e($property_created_by ? $property_created_by->name : '-'); ?>

                            </p>
                        </div>
                     <div class="text-right">
                        <a href="<?php echo e(route('properties.show',$latest_property->slug)); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                    </div>
                </div>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php endif; ?>
                </div> <!-- end card-box -->