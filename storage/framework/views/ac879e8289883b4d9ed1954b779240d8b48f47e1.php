<?php echo $__env->make( 'home-pages.common.head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/24hrs-time.css" rel="stylesheet" id="app">
<style>
   .prop{
      font-weight: bold;
   }
   .new-checkbox{
    display: inline-flex;

   }
   .new-checkbox2{
     display: inline-flex;
        padding: 3px;
        width: 200px;
   }
   .check-box-slash:before{
    content: "\002F";
    padding-left:10px;
    }
    .sty-dn{
      display: none;
    }.sty-cfs18{
      color:#c1ab77; font-size: 18px;
    }.sty-tc{
      text-align: center;
    }

</style>
<?php $__env->startSection( 'content_two' ); ?>
<div id="content" class="mob-max">
   <div class="rightContainer">
      <h1><b><?php echo app('translator')->getFromJson('custom.properties.list-a-new-property'); ?></b></h1>

  <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
  <?php endif; ?>

  <?php if(session('success')): ?>
        <div class="alert alert-success">
          <?php echo e(session('success')); ?>

        </div>    
        <?php endif; ?>


   <?php echo Form::open(['method' => 'POST', 'route' => ['properties.store'], 'files' => true,'name'=>'formPropertyType','id'=>'prevent_enter_property_form']); ?>

    
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

            <?php echo Form::label('name',trans('custom.listings.fields.property-name').'*', ['class'=>'prop']); ?>

            <?php echo Form::text('name', old('name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.property-name'),

               ]); ?>

                  
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

               <?php echo Form::label('cotact_person_name',trans('custom.listings.fields.full-name-of-contact-person').'*',['class'=>'prop'] ); ?>


                  <?php echo Form::text('cotact_person_name', old('cotact_person_name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.full-name-of-contact-person'),
               
               ]); ?>

              
               </div>
            </div>
         </div>

           <div class="form-group">
                  <label for="description"><b><?php echo app('translator')->getFromJson('custom.properties.description'); ?></b></label>

                   <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.description'); ?>" name="description" class="form-control" value="<?php echo e(old('description')); ?>">
              </div>

           <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <?php echo Form::label('phone_number',trans('custom.listings.fields.phone-number').'*',['class'=>'prop'] ); ?>

                    

                 <?php echo Form::number('phone_number', old('phone_number'), ['class' => 'form-control',
                 'placeholder'=>trans('custom.listings.fields.phone-number'),'min'=>'0','required'=>'true'

                 ]); ?>

                 
                 </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                  <?php echo Form::label('email',trans('custom.listings.fields.email-id').'*',['class'=>'prop'] ); ?>


                  <?php echo Form::email('email', old('email'), ['class' => 'form-control',
                 'placeholder'=>trans('custom.listings.fields.email-id'),
                 
                 ]); ?>



                 </div>
              </div>
           </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">
                  <?php echo Form::label('alter_cotact_person_number',trans('custom.listings.fields.alternate-contact-number'),['class'=>'prop'] ); ?>


                  <?php echo Form::number('alter_cotact_person_number', old('alter_cotact_person_number'), ['class' => 'form-control','min'=>'0',
               'placeholder'=>trans('custom.listings.fields.alternate-contact-number'),

               
               ]); ?>

               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <!-- price -->
            
               <!-- /price -->
               <div class="form-group">
                  <?php echo Form::label('alter_email',trans('custom.listings.fields.alternate-email-id'),['class'=>'prop'] ); ?>

                  
                  <?php echo Form::email('alter_email', old('alter_email'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.alternate-email-id'),

               ]); ?>

               </div>
            </div>
         </div>

         <div class="row">
          
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

               <?php echo Form::label('alter_cotact_person_name',trans('custom.listings.fields.alternate-contact-person-name'),['class'=>'prop'] ); ?>


                  <?php echo Form::text('alter_cotact_person_name', old('alter_cotact_person_name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.alternate-contact-person-name'),
               
               ]); ?>

              
               </div>
            </div> 

         </div>

           <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="area"><b><?php echo e(trans('custom.listings.fields.area')); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.area'); ?>" name="area" class="form-control" min="0" value="<?php echo e(old('area')); ?>">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="capacity"><b><?php echo e(trans('custom.listings.fields.capacity')); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.capacity'); ?>" name="capacity"class="form-control" min="0" value="<?php echo e(old('capacity')); ?>"> 
                    </div>
                </div>

                
            </div>
 
    

            <?php if( isAdmin() ): ?>

            <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

            <?php echo Form::label('is_approved',trans('custom.listings.fields.is-approved')); ?>


             <?php
                    $verified = array(
                        trans('custom.eforms.no') => trans('custom.eforms.no'),
                        trans('custom.eforms.yes') => trans('custom.eforms.yes'),
                    );
                    ?>  

            <?php echo Form::select('is_approved', $verified, old('is_approved'),['class' => 'form-control'

               ]); ?>

                  
               </div>
            </div>
         

             
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
             <div class="form-group">

            <?php echo Form::label('agent_id',trans('custom.listings.fields.assigned-to').'*'); ?>


            <?php echo Form::select('agent_id', $agents, old('agent_id'),['class' => 'form-control','placeholder'=>trans('custom.listings.fields.assigned-to')

             ]); ?>

                
             </div>
            </div>
            </div>



            <?php endif; ?>
         
       
         <div class="form-group">
            <label for="property_address"><b><?php echo e(trans('custom.listings.fields.property-address').'*'); ?></b>
               <span id="property_address_latitude_span" class="label label-default"></span> 
               <span id="property_address_longitude_span" class="label label-default"></span></label>
            <input class="form-control" type="text" id="property_address" onClick="initialize(this.id);" onFocus="initialize(this.id);" name="property_address" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.enter-location'); ?>" autocomplete="off" value="<?php echo e(old('property_address')); ?>">
            <input type="hidden" name="property_address_latitude" id="property_address_latitude" value="">
            <input type="hidden" name="property_address_longitude" id="property_address_longitude" value="">
            
            <input type="hidden" name="property_address_street_number" id="property_address_street_number" value="">
            <input type="hidden" name="property_address_city" id="property_address_city" value="">
            <input type="hidden" name="property_address_state" id="property_address_state" value="">
            <input type="hidden" name="property_address_country" id="property_address_country" value="">
            <input type="hidden" name="property_address_postal_code" id="property_addrress_postal_code" value="">

            
            <p class="help-block"><?php echo e(trans('custom.listings.fields.drag-marker')); ?></p>
         </div>

         <div class="form-group">
            <label for="near_by_landmark"><b><?php echo e(trans('custom.listings.fields.nearby-landmarks').'*'); ?> </b>
               <span id="near_by_landmark_latitude_span" class="label label-default"></span> 
               <span id="near_by_landmark_longitude_span" class="label label-default"></span> 
               <span id="longitude" class="label label-default"></span></label>
            <input class="form-control" type="text" name="near_by_landmark" id="near_by_landmark" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.nearby-landmarks'); ?>" autocomplete="off" onClick="initialize(this.id);" onFocus="initialize(this.id);" value="<?php echo e(old('near_by_landmark')); ?>"> 

            <input type="hidden" name="near_by_landmark_latitude" id="near_by_landmark_latitude" value="">
            <input type="hidden" name="near_by_landmark_longitude" id="near_by_landmark_longitude" value="">
         </div>
         <div class="row">
          
      <?php
       $space_types = \App\SpaceType::getSpaceTypes(0);
      ?>
           
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

               <div class="form-group">
                  <label for="space_type_id"><b><?php echo e(trans('custom.listings.fields.workspace-avaliable-in-office')); ?></b></label>

                  <?php $__currentLoopData = $space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <div class="checkbox custom-checkbox new-checkbox">
                   
                  <?php
                  $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);

                  $sub_space_type_old = old('sub_space_type_id');
                  
                  ?>
                  <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $type_subtype = $sub->parent_id . '_' . $sub->id;
                  $selected = false;
                  if ( ! empty( $sub_space_type_old ) && in_array( $type_subtype, $sub_space_type_old)) {
                    $selected = true;
                  }
                  ?>
                  <label>
                      <input type="checkbox"  name="sub_space_type_id[]" value="<?php echo e($type_subtype); ?>" class="subtype" data-space_type_id="<?php echo e($sub->parent_id); ?>" data-sub_space_type_id="<?php echo e($sub->id); ?>" <?php if($selected): ?> checked <?php endif; ?>>
                     <span class="fa fa-check"> </span> <?php echo e($sub->name); ?>&nbsp;

                  </label>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               </div>
                 
            </div>
                        
         </div>
        
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_workstation"><b><?php echo e(trans('custom.listings.fields.no-of-workstation')); ?></b></label>
                  <input type="number" min="0" name="no_of_workstation" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-workstation'); ?>" value="<?php echo e(old('no_of_workstation')); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_private_office"><b><?php echo e(trans('custom.listings.fields.no-of-private-office')); ?></b></label>
                  <input type="number" min="0" name="no_of_private_office" class="form-control"  placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-private-office'); ?>" value="<?php echo e(old('no_of_private_office')); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_meeting_office"><b><?php echo e(trans('custom.listings.fields.no-of-meeting-rooms')); ?></b></label>
                  <input type="number" min="0" name="no_of_meeting_office" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-meeting-rooms'); ?>" value="<?php echo e(old('no_of_meeting_office')); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_training_office"><b><?php echo e(trans('custom.listings.fields.no-of-training-office')); ?></b></label>
                  <input type="number" min="0" name="no_of_training_office" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-training-office'); ?>" value="<?php echo e(old('no_of_training_office')); ?>">
               </div>
            </div>
         </div>

         <?php $__currentLoopData = $space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

           <?php
            $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);
            ?>
            <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if( SUBSPACE_TYPE_VIRTUAL == $sub->id): ?>

                <?php
              $type_subtype = $sub->parent_id . '_' . $sub->id;
              $selected = false;

              $vo_reg_no = $vo_mailing_address  = null;
            
              
              ?>

              <!-- virtual offices -->
               <div class="row sty-dn" id="hd_hidden_fields_<?php echo e($sub->id); ?>" >
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_reg_no[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.vo-with-bussiness-reg-no')); ?></b></label>
                        <input type="text" name="vo_reg_no[<?php echo e($sub->id); ?>]" id="vo_reg_no" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-bussiness-reg-no'); ?>">
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_mailing_address[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.vo-with-mailing-address')); ?></b></label>
                        <input type="text" min="0" name="vo_mailing_address[<?php echo e($sub->id); ?>]" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-mailing-address'); ?>" class="form-control">
                     </div>
                  </div>
               </div>
               <!-- end virtual offices -->
              <?php else: ?> 

              <?php
             $type_subtype = $sub->parent_id . '_' . $sub->id;
            $selected = false;
      
            $avaliable_seats = $price_per_day = $price_per_month = null;
           
             ?>

            
             <div class="row" id="hd_hidden_fields_<?php echo e($sub->id); ?>" style="display: <?php if($selected): ?> block <?php else: ?> none <?php endif; ?>;">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="avaliable_seats[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.avaliable-seats-for')); ?> <?php echo e($sub->name); ?> *</b></label>
                      <input type="number" min="0" name="avaliable_seats[<?php echo e($sub->id); ?>]" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.avaliable-seats-for'); ?> <?php echo e($sub->name); ?>">
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_day"><b><?php echo e($sub->name); ?> <?php echo e(trans('custom.listings.fields.price-per-day')); ?></b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" name="price_per_day[<?php echo e($sub->id); ?>]" step=0.01 type="number" placeholder="<?php echo e($sub->name); ?> <?php echo app('translator')->getFromJson('custom.listings.fields.price-per-day'); ?>">
                      </div>
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_month"><b><?php echo e($sub->name); ?> <?php echo e(trans('custom.listings.fields.price-per-month')); ?></b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" step=0.01 name="price_per_month[<?php echo e($sub->id); ?>]" type="number" placeholder="<?php echo e($sub->name); ?> <?php echo app('translator')->getFromJson('custom.listings.fields.price-per-month'); ?>">
                      </div>
                   </div>
                </div>
             </div>
             <?php endif; ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
<div class="row">
   <?php
       $amenities = \App\Amenity::get();
       $amenity_old = old('amenity_id');
    ?> <!-- >Open hours -->
   
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <div class="form-group">
            <label><b><?php echo e(trans('custom.listings.fields.amenities')); ?></b></label>
            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
            $type_amenity = $amenity->id;
            $selected = false;
            if ( ! empty( $amenity_old ) && in_array( $type_amenity, $amenity_old)) {
              $selected = true;
            }
            ?>
            <div class="checkbox custom-checkbox new-checkbox2"><label><input type="checkbox" name="amenity_id[]" value="<?php echo e($amenity->id); ?>" <?php if($selected): ?> checked <?php endif; ?>><span class="fa fa-check"></span> <?php echo e($amenity->name); ?></label></div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
        
    </div>

</div>
   
 
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="sty-cfs18"><b><?php echo e(trans('custom.listings.fields.offer-details')); ?></b></label>

                <div class="form-group">
                <label for="offer_title"><b><?php echo e(trans('custom.listings.fields.offer-title')); ?></b></label>
                <input type="text" name="offer_title" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.offer-title'); ?>" class="form-control" value="<?php echo e(old('offer_title')); ?>">
            </div>
        
             

                
            </div>
        </div>
    </div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="form-group">
        <div class="row">
        <div class='col-sm-4'>
        <label class="sty-tc"><b><?php echo e(trans('custom.listings.fields.open-hours')); ?></b></label></div>
        <div class='col-sm-4'>
        <label for="time_from"><b><?php echo e(trans('custom.listings.fields.from')); ?></b></label></div>
        <div class='col-sm-4'>
        <label for="time_to"><b><?php echo e(trans('custom.listings.fields.to')); ?></b></label></div>
        </div>


   <?php
       $days = \App\Day::get();
       $day_old = old('day_id');
    ?> <!-- >Open hours -->


  <label for="days"><b><?php echo e(trans('custom.listings.fields.days')); ?></b></label>
  <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <?php
      $type_day = $day->id;
      $selected = false;
      if ( ! empty( $day_old ) && in_array( $type_day, $day_old)) {
      $selected = true;
      }
      ?>
   <div class='col-sm-4'>   
      <div class="form-group">

        <div class='checkbox custom-checkbox'>
          <label><input type="checkbox" name="day_id[]" value="<?php echo e($day->id); ?>" data-day_id="<?php echo e($day->id); ?>" <?php if($selected): ?> checked <?php endif; ?>>
          <span class="fa fa-check"></span> <?php echo e($day->name); ?></label>
        </div>
      </div>
    </div>
        <div class='col-sm-4'>
           <div class="form-group">
            <?php
            $time_from = ! empty($record->time_from) ?  $record->time_from  : '';
            ?>
                  
                  <div class='input-group date' id='datetimepicker<?php echo e($day->id); ?>from'>
                    <input type="text" name="time_from[]" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.from'); ?>" value="<?php echo e($time_from); ?>"/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group">
             <?php
            $time_to = ! empty($record->time_to) ?  $record->time_to  : '';
            ?>
                 
                  <div class='input-group date' id='datetimepicker<?php echo e($day->id); ?>to'>
                    <input type="text" name="time_to[]"class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.to'); ?>" value="<?php echo e($time_to); ?>"/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              

      
  </div>
</div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      
        <div class="form-group">
                   
            <label for="cover_image"><b><?php echo e(trans('custom.listings.fields.cover-image')); ?></b></label>
            
            <input type="file" class="file file-upload"  data-show-upload="false" data-show-caption="false" data-show-remove="false" name="cover_image"accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">     
            </div>

        </div>
   

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="image"><b><?php echo e(trans('custom.listings.fields.image-gallery')); ?></b></label>
            <input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" name="image[]"accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">
            <p class="help-block"><?php echo e(trans('custom.listings.fields.multilple-imgs-at-once')); ?><</p>
        </div>
    </div>
</div>
 <!-- new section 2-->

<!-- >Contact section -->
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="sty-cfs18"><b><?php echo e(trans('custom.listings.fields.contact-details')); ?></b></label>

                        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_name"><b><?php echo e(trans('custom.listings.fields.property-manager-name').'*'); ?></b></label>
                        <input type="text" name="property_manager_name" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-name'); ?>" class="form-control" value="<?php echo e(old('property_manager_name')); ?>"> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_email"><b><?php echo e(trans('custom.listings.fields.property-manager-email').'*'); ?></b></label>
                            <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-email'); ?>" name="property_manager_email"type="email" value="<?php echo e(old('property_manager_email')); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_number"><b><?php echo e(trans('custom.listings.fields.property-manager-phone').'*'); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-phone'); ?>" name="property_manager_number"class="form-control" value="<?php echo e(old('property_manager_number')); ?>">
                    </div>
                </div>
                
            </div>

           
                     
  
                        
                    </div>
                </div>
            </div>
        

   <!-- >Invoice Related Details -->
          <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group">
                     <label class="sty-cfs18"><b><?php echo e(trans('custom.listings.fields.invoice-related-details')); ?></b></label>

                     <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="company"><b><?php echo e(trans('custom.listings.fields.company-name')); ?></b></label>
                     <input type="text" name="company" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.company-name'); ?>" class="form-control" value="<?php echo e(old('company')); ?>">
                 </div>
             </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="pan_no"><b><?php echo e(trans('custom.listings.fields.pan-no')); ?></b></label>
                          <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.pan-no'); ?>" name="pan_no"type="text" value="<?php echo e(old('pan_no')); ?>">
                       </div>
                   </div>
         
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="cin_no"><b><?php echo e(trans('custom.listings.fields.cin-no')); ?></b></label>
                     <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.cin-no'); ?>" name="cin_no" class="form-control" value="<?php echo e(old('cin_no')); ?>">
                 </div>
             </div>

             
             
         
       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
           <div class="form-group">
               <label for="gst"><b><?php echo e(trans('custom.listings.fields.gst')); ?></b></label>
               <input type="number" min="0" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.gst'); ?>" name="gst"class="form-control" value="<?php echo e(old('gst')); ?>">
           </div>
       </div>
       
   </div>

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="billing_address"><b><?php echo e(trans('custom.listings.fields.billing-address')); ?></b></label>

             <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.billing-address'); ?>" name="billing_address" class="form-control" value="<?php echo e(old('billing_address')); ?>"> 

         </div>

             </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="registered_address"><b><?php echo e(trans('custom.listings.fields.registered-address')); ?></b></label>

              <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.registered-address'); ?>" name="registered_address" class="form-control" value="<?php echo e(old('registered_address')); ?>"> 

           
         </div>
         
             </div>
             
         </div>
                  

                     
                 </div>
             </div>
         </div>
                <!-- new section 4-->

                    <!-- new section 4-->
                <!-- >Bank Details -->
                <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="form-group">
                           <label class="sty-cfs18"><b><?php echo e(trans('custom.listings.fields.bank-details')); ?></b></label>

                  <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="bank_name"><b><?php echo e(trans('custom.listings.fields.bank-name')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.bank-name'); ?>" name="bank_name" class="form-control" value="<?php echo e(old('bank_name')); ?>">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_holder_name"><b><?php echo e(trans('custom.listings.fields.account-holder-name')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.account-holder-name'); ?>" name="account_holder_name" class="form-control" value="<?php echo e(old('account_holder_name')); ?>"> 
                       </div>
                   </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_number"><b><?php echo e(trans('custom.listings.fields.account-number')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.account-number'); ?>" name="account_number" class="form-control" value="<?php echo e(old('account_number')); ?>">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="ifsc_code"><b><?php echo e(trans('custom.listings.fields.ifsc-code')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.ifsc-code'); ?>" name="ifsc_code" class="form-control" value="<?php echo e(old('ifsc_code')); ?>">
                       </div>
                   </div>


                  </div>

                           
                       </div>
                   </div>
               </div>


<div class="form-group">
   <button type="submit" name="send" class="btn btn-green btn-lg isThemeBtn"><?php echo e(trans('custom.listings.fields.add-property')); ?></button>
</div>
 <?php echo Form::close(); ?>   
</div>
</div>
<div class="clearfix"></div>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script> 

<script>

$('.subtype').on("click", function() {
  var sub_space_type_id = $(this).data('sub_space_type_id');
  var checked = $(this).is(':checked');

  if ( checked ) {
    $('#hd_hidden_fields_' + sub_space_type_id).slideDown();
  } else {
    $('#hd_hidden_fields_' + sub_space_type_id).slideUp();
  }
});

</script>

<script>
  $('#prevent_enter_property_form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
</script>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/fileinput.min.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.main_two' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>