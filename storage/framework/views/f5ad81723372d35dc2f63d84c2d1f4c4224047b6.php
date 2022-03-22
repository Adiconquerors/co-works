
 <tbody>
       <?php if( ! empty( $latest_agent_assigned_leads ) ): ?>
            <?php $__currentLoopData = $latest_agent_assigned_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                    $leads = \App\User::find( $inquiry->customer_id ); 
                    $cover_image = $leads ? $leads->image : '';                   
              ?>

          <tr>
             
                 <td>
                    <a class="user" href="javascript:void(0);">
                        <img src="<?php echo e(getDefaultimgagepath($cover_image,'users','')); ?>" alt="" class="rounded-circle img-thumbnail thumb-md">
                    </a>
                 </td>

              <td class="hide-phone">
                  <h5 class="m-0"><?php echo e($leads ? $leads->name : ''); ?> </h5>
                 
              </td>
              <td class="text-right">
                  <a href="<?php echo e(route( 'leads.show',$inquiry->id )); ?>" class="btn btn-sm btn-bordered waves-effect waves-light btn-primary"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                 
              </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

       </tbody>