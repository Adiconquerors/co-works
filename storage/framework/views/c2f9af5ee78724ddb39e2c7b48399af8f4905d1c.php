<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="modal-header">
  <h4 class="modal-title"><?php echo app('translator')->getFromJson('custom.inquiries.properties-shared'); ?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
 
            <form class="" role="form" id="properties_shared_form" method="post">
              <div class="shrelist">
                  <?php
                    $shortlisted_data = json_decode($item->shortlisted_properties, true);
                    $count = 1;
                  ?>

                 <?php if(is_array($shortlisted_data) || is_object($shortlisted_data)): ?>
                  <?php $__currentLoopData = $shortlisted_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $property_sub_space_types = $shortlist["property_sub_space_types"];
                    ?>
                       
                    <div class="listydei">
                    <div class="cobting">

                       
                       <?php if( $shortlist['cover_image'] && file_exists(public_path("/thumb/coverimages/". $shortlist['cover_image']))): ?>
                          <img src="<?php echo e($shortlist['cover_image']); ?>" height="100" width="100">
                       <?php else: ?>
                         <img src="<?php echo e(url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg')); ?>" height="100" width="100">
                       <?php endif; ?>
                    
                      
                       
                    <h2>   <?php echo e($shortlist["name"]); ?></h2> 
                    <h4>    <?php echo e($shortlist["company"]); ?></h4> 
                    <h6>    <?php echo e($shortlist["property_address"]); ?></h6> 

          </div>
                     <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php 
                        $space_types = \App\SpaceType::find($property_sub_space_type["space_type_id"]);
                        $sub_space_types = \App\SpaceType::find($property_sub_space_type["sub_space_type_id"]);
                       
                      ?>    

                          <div class="tbgrid">
                       
                      
                          <?php if($space_types): ?>    
                                      <?php if( $space_types["name"] == "Virtual Offices" ): ?>
                                        <?php
                                         $vo_price_per_month = ''
                                        ?>
                                        <?php echo e($vo_price_per_month); ?>

                                      <?php else: ?> 
                                    <p>
                                        <?php echo app('translator')->getFromJson('custom.eforms.ava-seats-for'); ?> <?php echo e($sub_space_types["name"]); ?> : <span> <?php echo e($property_sub_space_type["avaliable_seats"] ?? ''); ?></span> 
                                  </p>
                                   <p>  
                                    <?php echo app('translator')->getFromJson('custom.eforms.price-per-m'); ?>  <?php echo e($space_types["name"]); ?> ( <?php echo e($sub_space_types["name"]); ?> ) : <span> <?php echo e($property_sub_space_type["price_per_month"] ? $property_sub_space_type["price_per_month"].' / month' : ''); ?></span> 
                                     
                                     </p> <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
 
                 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php endif; ?> 
               
              </div>

              <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="customer_id" name="customer_id" value="<?php echo e($item->customer_id); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>">

            </form>

  </div>

  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>