<?php $__env->startSection( 'new_admin_head_links' ); ?>
 <!-- Bx slider css -->
<link href="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>bx-slider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
 <style>
      
      #sty-mr8{
        margin-right: 8px;
      }
      .sty-tc{
        text-align: center;
      }
      .sty-fs16{
        font-size: 16px;
      }
      .styy_ohto{
        overflow:hidden;
        text-overflow:ellipsis;white-space:nowrap;
      }
  </style>

      <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?php echo app('translator')->getFromJson('custom.listings.fields.property-detail'); ?></h4>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

<?php if($record): ?>
    <?php
        $images            = json_decode($record->image,false);
        $description       = $record->description;
        $property_address  = $record->property_address;
        $records[] = $record;

    ?>

    <?php else: ?>

         <?php

           $description      = null;
           $property_address  = null;

        ?>

     <?php endif; ?>


    <div class="property-detail-wrapper">
        <div class="row">
            <div class="col-lg-8">
            <?php if($images): ?>
                <div class="">
                    <ul class="bxslider property-slider">
                          <?php if(is_array($images) || is_object($images)): ?>
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $image_path = PREFIX1 . 'thumb/' . $image;
                                $water_mark = getSetting('carousel_head_two','login-settings');
                            ?>

                        <li><img src="<?php echo e(url( $image_path )); ?>" alt="slide-image" />  <div class="watermark"><?php echo e($water_mark); ?> </div> </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </ul>

                    <div id="bx-pager" class="text-center hide-phone">
                        <?php if(is_array($images) || is_object($images)): ?>
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $image_path = PREFIX1 . 'thumb/' . $image;
                            ?>
                        <a data-slide-index="<?php echo e($loop->index); ?>" href="javascript:void(0);"><img src="<?php echo e(url( $image_path )); ?>" alt="slide-image" height="70" /></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <!-- end slider -->

                <div class="m-t-30">
                    <h3><?php echo e($record->company); ?></h3>
                    <p class="text-muted text-overflow"><i class="mdi mdi-map-marker-radius m-r-5"></i><?php echo e($record->property_address); ?></p>

                    <p class="m-t-20">
                        <?php echo e($record->description); ?>

                    </p>

                      <h5><?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-details'); ?></h5>
                    <p class="text-muted text-overflow">
                      <span><b><?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>  </span>&nbsp;&nbsp;  <?php echo e($record->property_manager_name); ?><br/>
                      <span><b><?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-email'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b></span>&nbsp;&nbsp; <?php echo e($record->property_manager_email); ?><br/>
                      <span><b><?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-phone'); ?>&nbsp;&nbsp;:</b> </span> &nbsp;&nbsp;<?php echo e($record->property_manager_number); ?>

                    </p>


                 <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                             <h4 class=""><?php echo app('translator')->getFromJson('custom.listings.fields.general-amenities'); ?></h4>

                            <ul class="list-unstyled proprerty-features">
                            <?php if(count( $record->property_amenities ) > 0): ?>
                                <?php $__currentLoopData = $record->property_amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                 
                                    <i class="<?php echo e($property_amenity->icon->name); ?>" id="sty-mr8"></i>
                                  <?php echo e($property_amenity->name); ?>

                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php else: ?>
                                <h5 class="sty-tc"><?php echo app('translator')->getFromJson('custom.listings.fields.no-amenities-avaliable'); ?></h5>
                             <?php endif; ?>
                            </ul>
                        </div> <!--- end col -->

                            <div class="col-sm-6">
                             <h4 class=""><?php echo app('translator')->getFromJson('custom.listings.fields.property-timings'); ?></h4>

                                <table width=100%>
                                        <thead>
                                        <tr class="sty-fs16">
                                            <th><?php echo app('translator')->getFromJson('custom.listings.fields.days'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.listings.fields.from'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.listings.fields.to'); ?></th>
                                          
                                        </tr>
                                        </thead>

                                <tbody>         
                                <?php $__currentLoopData = $record->property_timings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_timing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php
                                        $days = \App\Day::find($property_timing->day_id);
                                   ?> 
                                <tr>
                                  <td><?php echo e($days ? $days->name : ''); ?></td>
                                  <td><?php echo e($property_timing->time_from ?? ''); ?></td>
                                  <td><?php echo e($property_timing->time_to ?? ''); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                         </table>   
                           
                        </div> <!--- end col -->


                    </div> <!-- end row -->
                </div>

                    <h4 class="m-t-30 m-b-20"><?php echo app('translator')->getFromJson('custom.listings.fields.location'); ?></h4>

                    <div class="card-box">
                        <div id="map-property"></div>
                    </div>

                </div> <!-- end m-t-30 -->

            </div> <!-- end col -->

            <div class="col-lg-4">
                <?php if( isAgent() || isAdmin()): ?>

                <?php
                        $agents = \App\User::find($record->agent_id);
                        if( ! empty($agents) ){
                          $agent_image = $agents->image;
                        }

                    ?> 
                  <?php if(! empty($agents)): ?>    
                <div class="text-center card-box">
                  
                    <div class="text-left">
                        <h4 class="header-title m-t-0 m-b-20"><?php echo app('translator')->getFromJson('custom.listings.fields.agent'); ?></h4>
                    </div>
                    <div class="member-card">
                    
                        <div class="thumb-xl member-thumb m-b-10 mx-auto d-block">
                            
                               <img src="<?php echo e(getDefaultimgagepath($agent_image,'users')); ?>" class="rounded-circle img-thumbnail" alt="profile-image">
                          
                        </div>

                        <div class="" >
                            <h4 class="m-b-5"><?php echo e($agents ? $agents->name : '-'); ?></h4>
                            <br/>
                            <p>
                               <span>  <?php echo app('translator')->getFromJson('custom.listings.fields.mobile'); ?> :</span>
                               <span> <?php echo e($agents ? $agents->mobile : '-'); ?> </span>
                            </p>
                            <p>
                               <span>   <?php echo app('translator')->getFromJson('custom.listings.fields.email'); ?> :</span>
                               <span> <?php echo e($agents ? $agents->email : '-'); ?> </span>
                            </p>
                        </div>

                        <div class="m-t-20">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                <?php
                                $agent_properties = \App\Property::where('agent_id',$record->agent_id)->count();
                                ?>

                                    <h4><?php echo e($agent_properties); ?></h4>
                                    <p><?php echo app('translator')->getFromJson('custom.listings.fields.listed-properties'); ?></p>
                                </li>

                             
                            </ul>
                        </div>
                      
                    </div> <!-- end membar card -->
                </div> <!-- end card-box -->
                   <?php endif; ?>
                <?php endif; ?>

                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-bordered m-b-0">
                            <tbody>

                              <?php
                                 $property_sub_space_types = $record->property_sub_space_types;
                                  $count = 1;
                              ?>

                                <tr>
                                    <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.price-per-month'); ?></th>
                                    <td>
                                    <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                      $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                                    ?>    
                                    <b>

                                    <span class="badge badge-pill badge-dark"> <?php echo e($count++); ?> </span>
                                    <br/>  

                                    <?php if($space_types): ?>    
                                      <?php if( $space_types->name == "Virtual Offices" ): ?>
                                        <?php
                                         $vo_price_per_month = '-'
                                        ?>
                                         Price Per Month <?php echo e($space_types->name); ?> : <?php echo e($vo_price_per_month); ?>

                                      <?php else: ?> 

                                       Avaliable Seats For <?php echo e($sub_space_types->name); ?> : <?php echo e($property_sub_space_type->avaliable_seats ?? ''); ?>


                                      <br/><br/>
                                      Price Per Month <?php echo e($space_types->name); ?> ( <?php echo e($sub_space_types->name); ?> ) : <?php echo e($property_sub_space_type->price_per_month ? $property_sub_space_type->price_per_month.' / month' : ''); ?>

                                     
                                      <br/>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                 
                                    </b>
                                    <br/>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                	</td>
                                </tr>

                                 <?php if($space_types): ?>    
                                  <?php if( $space_types->name == "Virtual Offices" ): ?>
                                <tr>
                                    <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-bussiness-reg-no'); ?></th>
                                    <td><?php echo e($space_types ? $property_sub_space_type->vo_reg_no : '-'); ?></td>
                                </tr>

                                 <tr>
                                    <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-mailing-address'); ?></th>
                                    <td><?php echo e($space_types ? $property_sub_space_type->vo_mailing_address : '-'); ?></td>
                                </tr>

                               <?php endif; ?>
                               <?php endif; ?> 

                                <?php
                                  $count = 1;
                                ?>


                                 <tr>
                                    <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.price-per-day'); ?></th>
                                    <td>
                                    <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                     <?php 
                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                      $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                                    ?>    
                                      
                                     <span class="badge badge-pill badge-dark"> <?php echo e($count++); ?> </span>
                                     <br/>    

                                    <?php if($space_types): ?>    
                                      <?php if( $space_types->name == "Virtual Offices" ): ?>
                                        <?php
                                         $vo_price_per_day = '-'
                                        ?>
                                        Price Per Day <?php echo e($space_types->name); ?> : <?php echo e($vo_price_per_day); ?>

                                       <?php else: ?>    
                                        <b> 
                                          Price Per Day <?php echo e($space_types->name); ?> ( <?php echo e($sub_space_types->name); ?> ) : <?php echo e($property_sub_space_type->price_per_day ? $property_sub_space_type->price_per_day.' /Day' : ''); ?>

                                          <br/>
                                        </b>
                                        <br/>
                                       <?php endif; ?> 
                                      <?php endif; ?> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>

                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.is-approved')); ?></th>
                                    <td><?php echo e($record->is_approved); ?></td>
                                </tr>

                                

                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.contact-person-name')); ?> </th>
                                    <td><span class="label label-danger"><?php echo e($record->cotact_person_name); ?></span></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.phone-number')); ?>:</th>
                                    <td><?php echo e($record->phone_number); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.email')); ?>:</th>
                                    <td><?php echo e($record->email); ?></td>
                                </tr>
                                <tr>
                                   
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.near-by-land-marks')); ?>:</th>
                                    
                                    <td><?php echo e($record->near_by_landmark); ?></td>
                                </tr>

                                <?php if( isAdmin() ): ?>
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.no-of-workstation')); ?>:</th>
                                    <td><?php echo e($record->no_of_workstation); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.no-of-private-office')); ?></th>
                                    <td><?php echo e($record->no_of_private_office); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.no-of-meeting-rooms')); ?></th>
                                    <td><?php echo e($record->no_of_meeting_office); ?></td>
                                </tr>
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.no-of-training-rooms')); ?></th>
                                    <td><?php echo e($record->no_of_training_office); ?></td>
                                </tr>
                                
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.pan-no')); ?></th>
                                    <td><?php echo e($record->pan_no); ?></td>
                                </tr>
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.billing-address')); ?></th>
                                    <td><?php echo e($record->billing_address); ?></td>
                                </tr>
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.registered-address')); ?></th>
                                    <td><?php echo e($record->registered_address); ?></td>
                                </tr>
                                  <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.bank-name')); ?></th>
                                    <td><?php echo e($record->bank_name); ?></td>
                                </tr>
                                  <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.account-holder-name')); ?></th>
                                    <td><?php echo e($record->account_holder_name); ?></td>
                                </tr>
                                  <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.account-number')); ?></th>
                                    <td><?php echo e($record->account_number); ?></td>
                                </tr>
                                  <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.ifsc-code')); ?></th>
                                    <td><?php echo e($record->ifsc_code); ?></td>
                                </tr>
                                 <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.cin-no')); ?></th>
                                    <td><?php echo e($record->cin_no); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php echo e(trans('custom.listings.fields.gst')); ?></th>
                                    <td><?php echo e($record->gst); ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-box -->

            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- end property-detail-wrapper -->
       <?php $__env->stopSection(); ?>

       <?php $__env->startSection( 'new_admin_js_scripts' ); ?>

       <?php
         $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );
       ?>

              <!-- Bx slider js -->
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>bx-slider/jquery.bxslider.min.js"></script>

        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo e($google_api_key); ?>"></script>
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>gmaps/gmaps.js"></script>

        <script>
            $(document).ready(function () {
              "use strict";
                $('.property-slider').bxSlider({
                    pagerCustom: '#bx-pager'
                });
            });
            var map = new GMaps({
                el: '#map-property',
                lat: '<?php echo e($record->property_address_latitude); ?>',
                lng: '<?php echo e($record->property_address_longitude); ?>',
                mapTypeControlOptions: {
                    mapTypeIds : ["hybrid", "roadmap", "satellite", "terrain", "osm"]
                }
            });
            var marker = map.addMarker({
                lat: '<?php echo e($record->property_address_latitude); ?>',
                lng: '<?php echo e($record->property_address_longitude); ?>',
                title: 'Im your custom marker',
                
                animation: google.maps.Animation.DROP
            });

            var infoboxContent = '<div class="infoW">' +
                            '<div class="propImg">' +
                                
                                '</div>' +
                            '</div>' +
                            '<div class="paWrapper">' +

                                '<div class="propTitle"><?php echo e($record->company); ?></div>' +

                        '<div class="propAddress styy_ohto" title="<?php echo e($record->property_address); ?>"><?php echo e($record->property_address); ?></div>' +
                            '</div>'  +
                '<div class="clearfix"></div>' +
                '<div class="infoButtons">' +
                    '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Close</a></div>' +
             '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: infoboxContent,
                disableAutoPan: false,
                maxWidth: 202,
                
                zIndex: null,
                boxStyle: {
                    background: "url(<?php echo e(PREFIX); ?>'images/infobox-bg.png') no-repeat",
                    opacity: 1,
                    width: "202px",
                    height: "245px"
                },
                closeBoxMargin: "28px 26px 0px 0px",
                closeBoxURL: "",
                infoBoxClearance: new google.maps.Size(1, 1),
                pane: "floatPane",
                enableEventPropagation: false
            });
            

            marker.addListener('click', function() {
                infowindow.setContent(infoboxContent);
                infowindow.open(map, marker);
              });
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>