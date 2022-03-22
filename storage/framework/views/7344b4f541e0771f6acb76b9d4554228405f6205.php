 <tbody>
       <?php if( ! empty( $latest_registered_users ) ): ?>
            <?php $__currentLoopData = $latest_registered_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registered_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $image = $registered_user->image;
            ?>

          <tr>

              <td>
                  <a class="user" href="javascript:void(0);">
                      <img src="<?php echo e(getDefaultimgagepath($image,'users','')); ?>" alt="" class="rounded-circle img-thumbnail thumb-md">
                  </a>
              </td>

              <td class="hide-phone">
                  <h5 class="m-0"><?php echo e($registered_user->name); ?> </h5>
                 
              </td>
              <td class="text-right">
                  <a href="<?php echo e(route( 'users.edit',$registered_user->id )); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
                 
              </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

       </tbody>