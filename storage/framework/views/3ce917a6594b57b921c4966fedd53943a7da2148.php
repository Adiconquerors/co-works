  <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('custom.dashboard.recent-properties'); ?></h4>

                   <?php if( ! empty( $latest_landlord_properties ) ): ?>
                     <?php $__currentLoopData = $latest_landlord_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_landlord_property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                         $cover_image = $latest_landlord_property->cover_image ?? '';
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
                            <h5 class="media-heading mt-0"><a href="#"><?php echo e($latest_landlord_property->company); ?></a> </h5>
                          
                        </div>
                     <div class="text-right">
                        <a href="<?php echo e(route('properties.show',$latest_landlord_property->slug)); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary" target="_blank"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                    </div>
                </div>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php endif; ?>
                </div> <!-- end card-box -->