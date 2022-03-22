 <tbody>
       <?php if( ! empty( $customer_latest_inquiries ) ): ?>
            <?php $__currentLoopData = $customer_latest_inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                    $properties = \App\Property::find( $inquiry->property_id );              
                    $cover_image = $properties ? $properties->cover_image : '';
              ?>

          <tr>

                <td>
                    <a class="user" href="javascript:void(0);">
                        <?php if($cover_image): ?>
                         <img src="<?php echo e($cover_image); ?>" alt="" class="rounded-circle img-thumbnail thumb-md">
                        <?php else: ?>
                          <img src="<?php echo e(PUBLIC_ASSETS.'images/default-imgs/1.jpg'); ?>" alt="" class="rounded-circle img-thumbnail thumb-md">
                        <?php endif; ?> 
                    </a>
                 </td>
             
              <td class="hide-phone">
                  <h5 class="m-0"><?php echo e($properties ? $properties->company : ''); ?> </h5>
                 
              </td>
              <td class="text-right">
                  <a href="<?php echo e(route('properties.show',$properties->slug)); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                 
              </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

       </tbody>