
              <?php $__currentLoopData = $booking_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $cover_image = $property->cover_image;
                  $property_sub_space_types = $property->property_sub_space_types;
                  $property_amenities = $property->property_amenities;
              ?>

            <style>
              .sty-mb{
                margin-bottom: 20px;
              }
              #fawhatsappicon{
                color: green; font-size: 20px;
              }
              .styp5{
                padding:5px;
              }
            </style>
                      <div class="property-card property-horizontal bg-white">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="property-image" style="background: url('<?php echo e($cover_image); ?>') center center / cover no-repeat;">
                                         
                                    </div>
                                </div>

                                <input type="hidden" name="booking_property_name"  value="<?php echo e($property->name); ?>">
                                <!-- /col 4 -->
                                <div class="col-sm-4">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                                <h4>
                                                    <a href="#" class="text-dark property-lab">
                                                        <?php echo e($property->company); ?>

                                                    </a>
                                                </h4>
                                                <p class="font-13 text-muted">
                                                    <?php echo e($property->property_address); ?>

                                                </p>
                                            </div>
                                        </div>


                               <h4 class="text-success price-tag sty-mb">
                       <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php 
                            $spacetypes = \App\SpaceType::find($property_type->space_type_id);
                            
                            $subspacetypes = \App\SpaceType::find($property_type->sub_space_type_id);
                            
                          ?> 
                            <?php if($spacetypes): ?>
                             <?php if( $spacetypes->name == "Virtual Offices" ): ?>
                                        <?php
                                         $vo_price_per_month = ''
                                        ?>
                                        <?php echo e($vo_price_per_month); ?>

                              <?php else: ?>
                                 <?php echo app('translator')->getFromJson('custom.inquiries.avalible-for'); ?> <?php echo e($subspacetypes->name ?? ''); ?> : <?php echo e($property_type->avaliable_seats ?? ''); ?>

                                 <br/>
                                 <?php echo app('translator')->getFromJson('custom.inquiries.avalible-month'); ?><?php echo e($spacetypes->name ?? ''); ?> ( <?php echo e($subspacetypes->name ?? ''); ?> ) : <?php echo e($property_type->price_per_month.' / month' ?? ''); ?><br/>

                              <?php endif; ?>
                              <?php endif; ?>     
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </h4>
                                    </div>
                                   
                                </div>
                                <!-- /col 8 -->
                                <!-- /col 4 -->
                                <div class="col-sm-3">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                                <div>
                                                    
                                                    <p href="javascript:void(0);" class="btn-property badge btn-dark-property">
                                                    <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <?php
                                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                                      if( $space_types ){
                                                      $property_space_type_name = $space_types->name;
                                                      }else{
                                                      $property_space_type_name = '-';
                                                      }
                                                      ?>

                                                      <?php echo e($space_types ? $space_types->name : '-'); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </p>
                                                </div>
                                            
                                                <div class="detilphon">
                                                    <p >
                                                        <i class="fab fa-whatsapp" id="fawhatsappicon">
                                                        </i>
                                                        <span>
                                                   
                                                            <b>
                                                                <?php echo e($property->phone_number); ?>

                                                            </b>
                                                        </span>
                                                    </p> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- /col 4 -->
                                <div class="col-sm-2">
                                    <div class="property-content">
                                    
                                      <a href="javascript:void(0);" id="booking_property_select_<?php echo e($property->id); ?>" class="btn btn-medium-dark styp5" >
                                          <?php echo app('translator')->getFromJson('custom.inquiries.select-property'); ?>
                                      </a>
                                        
                                    </div>
                                </div>
                                <!-- /col 8 -->
                            </div>
                            <!-- /inner row -->
                        </div>
                        <!-- End property item -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>