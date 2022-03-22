      <?php 
        if( count( $items ) > 0 ) {
      ?>
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="property-card property-horizontal bg-white">
        <div class="row">
          <?php
            $property_sub_space_types = $item->property_sub_space_types;
            $property_amenities = $item->property_amenities;
            $property_timings = $item->property_timings;
            $cover_image = $item->cover_image;
            $agents = \App\User::find($item->agent_id);
            $item_heart_color = $item->heart_color;
            $item_schedule_visit = $item->schedule_visit;
            
          ?>

          <style>
            .sty-w{
                width:130px;
            }
            .sty-pw{
                padding: 5px 26px;
            }
          </style>
 
        <div class="col-sm-2">
          <?php if( $cover_image ): ?>
            <div class="property-image" style="background: url('<?php echo e(url( $cover_image )); ?>') center center / cover no-repeat;">
              <?php if( isAdmin() ): ?>      
                <span class="property-label badge badge-darkblue">
                  <input id="toggle-heart" type="checkbox" />
                  <label for="toggle-heart" id="property-toggle-heart">

                    <i class="fa fa-heart" id="property-heart_<?php echo e($item->id); ?>" style="color: <?php if($item_heart_color == 'red' ): ?> red <?php else: ?> white <?php endif; ?>"></i>
                  </label>
                </span>
               <?php endif; ?>

              <?php if( 'yes' === $item->is_approved ): ?>
                <span class="property-label-bottom badge badge-success">
                  <?php echo app('translator')->getFromJson('custom.explore.avaliable'); ?>
                </span>
               <?php else: ?>
                <span class="property-label-bottom badge badge-danger">
                  <?php echo app('translator')->getFromJson('custom.explore.not-avaliable'); ?>
                </span>
              <?php endif; ?> 
            </div>
          <?php else: ?>
             <div class="property-image" style="background: url('<?php echo e(url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' )); ?>') center center / cover no-repeat;">
              <?php if( isAdmin() ): ?>      
                <span class="property-label badge badge-darkblue">
                  <input id="toggle-heart" type="checkbox" />
                  <label for="toggle-heart" id="property-toggle-heart">

                    <i class="fa fa-heart" id="property-heart_<?php echo e($item->id); ?>" style="color: <?php if($item_heart_color == 'red' ): ?> red <?php else: ?> white <?php endif; ?>"></i>
                  </label>
                </span>
               <?php endif; ?>

              <?php if( 'yes' === $item->is_approved ): ?>
                <span class="property-label-bottom badge badge-success">
                  <?php echo app('translator')->getFromJson('custom.explore.avaliable'); ?>
                </span>
               <?php else: ?>
                <span class="property-label-bottom badge badge-danger">
                  <?php echo app('translator')->getFromJson('custom.explore.not-avaliable'); ?>
                </span>
              <?php endif; ?> 
            </div>
         <?php endif; ?>  

          </div>

          <!-- /col 4 -->
          <div class="col-sm-4 col-12">
 
              <div class="listingInfo">
                <div class="">
                  <h4><a href="javascript:void(0);" class="text-dark property-lab"><?php echo e($item->company); ?></a>
                  </h4>
                  <p  ><?php echo e($item->property_address); ?> </p>
                  <p  ><span class="badge badge-pill badge-secondary"><?php echo e(getSetting('invoice-prefix', 'invoice-settings')); ?> - <?php echo e($item->id); ?> </span></p>
    

                  <div class="vew-prp">
                    <a href="<?php echo e(route('properties.show',$item->slug)); ?>" target="_blank" class="btn btn-purple waves-effect waves-light">
                      <?php echo app('translator')->getFromJson('custom.explore.view-property'); ?>
                    </a>
                  
                  </div>

              </div>
              
            

            </div>
          </div>
          <!-- /col 8 -->
          <!-- /col 4 -->
          <div class="col-sm-3 col-12" >
            <div class="property-content">
              <div class="listingInfo">
        
                    <p href="javascript:void(0);" class="badge badge-pill badge-secondary" >
                      <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                              $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                               $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                              if( $space_types ){
                              $property_space_type_name = $space_types->name;
                              }else{
                              $property_space_type_name = '-';
                              }
                              ?>

                      <?php echo e($space_types ? $space_types->name : '-'); ?> ( <?php echo e($sub_space_types->name); ?> )
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
               
                  
                  <div class="detilphon">
                    <p > <i class="fab fa-whatsapp" id="all-watsapp"></i><span>&nbsp; <b><?php echo e($item->phone_number); ?></b></span></p>

                    <p><a href="javascript:void(0);" class="btn btn-outline-secondary " data-toggle="modal" data-target="#modalContactForm_<?php echo e($item->id); ?>"> <?php echo app('translator')->getFromJson('custom.explore.alter'); ?></a>  </p>
                <p>  <span class="updated-date"><?php echo app('translator')->getFromJson('custom.inquiries.updated-on'); ?>: <?php echo e($item->updated_at->format('M d , Y')); ?></span></p>
                    <input type="hidden" name="heart_property_id" id="heart_property_id" value="<?php echo e($item->id); ?>">

                  </div>
             
              </div>
            </div>
          </div>
          <!-- /col 8 -->
          <!-- /col 4 -->

          <div class="col-sm-3 col-12">
            <div class="property-content">

               <?php if( isAdmin() ): ?>
       
                <?php echo Form::open([
                'method'=>'delete',
                'route' =>['properties.destroy', $item->slug],
                'onclick'=>'return checkDelete();'
                ]); ?>

              <p class="sty-w">
                <button type="submit" class="btn btn-danger sty-mb10">
                  <?php echo app('translator')->getFromJson('custom.explore.delete-property'); ?>
                </button>
             </p>
                <?php echo Form::close(); ?>

            
              <?php endif; ?>
              
               <?php echo $__env->make('admin.common.delete-script',['properties.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
              
              <?php if( isAdmin() || isLandlord() ): ?>
             <p>   <div class="btn-group sty-w">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   class="sty-pw">
                    <i class="fa fa-angle-double-down" aria-hidden="true" ></i>&nbsp;<?php echo app('translator')->getFromJson('custom.explore.action'); ?>&nbsp;<span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                   <?php if( isAdmin() ): ?>
                    <li>
                        <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['properties.availability','slug' => $item->slug,'is_approved'=>'no']

                        ]); ?>


                       
                     <button type="submit" class="dropdown-item">
                        <?php echo app('translator')->getFromJson('custom.explore.not-avaliable'); ?>
                    </button>
                        
                        <?php echo Form::close(); ?>

                      
                    </li>



                    <li>
                        <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['properties.availability','slug' => $item->slug,'is_approved'=>'yes']

                        ]); ?>


                       
                     <button type="submit" class="dropdown-item">
                         <?php echo app('translator')->getFromJson('custom.explore.avaliable'); ?>
                    </button>
                        
                        <?php echo Form::close(); ?>

                      
                    </li>
                   <?php endif; ?> 

                    <li>
                     
                        <a href="<?php echo e(route('prop.edit',$item->slug)); ?>" class="dropdown-item">
                       <?php echo app('translator')->getFromJson('custom.explore.update-property'); ?>
                       </a>
                     
                    </li>

                  </ul>
                </div> </p>
              <?php endif; ?>

            <?php if( isAdmin() ): ?>    
              <p  class="sty-w">
           <a href="javascript:void(0);" class="btn btn-medium-dark  mmt-10" id="schedule-visit_<?php echo e($item->id); ?>" style="display: <?php if($item_schedule_visit == 'no' ): ?> none <?php else: ?> block <?php endif; ?>"><?php echo app('translator')->getFromJson('custom.svisit'); ?></a>
           </p>
          <?php endif; ?> 
 
                

            </div>
          </div>
          <!-- /col 8 -->
        </div>
        <!-- /inner row -->
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- End property item -->
      <div>


           <ul class="pagination pagination-split justify-content-end">
                <?php echo e($items->links()); ?>

       
        </ul>


      </div>

      <?php
       } else {
      ?>
      <h4 class="sty-tc"><?php echo app('translator')->getFromJson('custom.explore.no-records'); ?></h4>
      <?php 
        }
     ?>

      <!-- /Alternative Contact Modal -->
