 <?php if($record): ?>

        <?php
            $phone_number          = $record->phone_number;
            $email                 = $record->email;
            $no_of_workstation      = $record->no_of_workstation;
            $no_of_meeting_office   = $record->no_of_meeting_office;
            $no_of_training_office   = $record->no_of_training_office;
            $no_of_private_office   = $record->no_of_private_office;
            $offer_title   = $record->offer_title;
            $property_manager_name   = $record->property_manager_name;
            $agent_id   = $record->agent_id;

            $property_address   = $record->property_address;

            $property_address_latitude = $record->property_address_latitude;
            $property_address_longitude = $record->property_address_longitude;
            $property_address_street_number = $record->property_address_street_number;
            $property_address_city = $record->property_address_city;
            $property_address_state = $record->property_address_state;
            $property_address_country = $record->property_address_country;
            $property_addrress_postal_code = $record->property_addrress_postal_code;

            $property_manager_email   = $record->property_manager_email;
            $property_manager_number   = $record->property_manager_number;
            $property_address   = $record->property_address;
            $near_by_landmark   = $record->near_by_landmark;
            $company   = $record->company;
            $description   = $record->description;

            $pan_no   = $record->pan_no;
            $cin_no   = $record->cin_no;
            $billing_address   = $record->billing_address;
            $registered_address   = $record->registered_address;
            $bank_name   = $record->bank_name;
            $cover_image   = $record->cover_image;
            $images     = json_decode($record->image,true);
            $account_holder_name   = $record->account_holder_name;
            $account_number   = $record->account_number;
            $ifsc_code   = $record->ifsc_code;
            $is_approved   = $record->is_approved;
            $capacity   = $record->capacity;
            $gst   = $record->gst;
            $area   = $record->area;
        ?>

          <?php else: ?>

          <?php
          $phone_number               =  old('phone_number');
          $no_of_workstation          =  old('no_of_workstation');
          $no_of_meeting_office       =  old('no_of_meeting_office');
          $no_of_training_office      =  old('no_of_training_office');
          $no_of_private_office       =  old('no_of_private_office');
          $offer_title                =  old('offer_title');
          $property_manager_name      =  old('property_manager_name');
          $property_manager_email     =  old('property_manager_email');
          $property_manager_number    =  old('property_manager_number');
          $property_address           =  null;
          $company                    =  old('company');
          $pan_no                     =  old('pan_no');
          $billing_address            =  old('billing_address');
          $description                =  old('description');
          $near_by_landmark           =  null;
          $agent_id                   =  old('agent_id');
          $registered_address         =  old('registered_address');
          $bank_name                  =  old('bank_name');
          $cover_image                =  null;
          $email                      =  old('email');
          $images                     =  null;
          $account_holder_name        =  old('account_holder_name');
          $account_number             =  old('account_number');


          $ifsc_code                  =  old('ifsc_code');
          $is_approved                =  old('is_approved');
          $capacity                   =  old('capacity');
          $area                       =  old('area');
          $gst                        =  old('gst');
          $cin_no                     =  old('cin_no');

          $property_address_latitude = old('property_address_latitude');
          $property_address_longitude = old('property_address_longitude');
          $property_address_street_number = old('property_address_street_number');
          $property_address_city = old('property_address_city');
          $property_address_state = old('property_address_state');
          $property_address_country = old('property_address_country');
          $property_addrress_postal_code = old('property_addrress_postal_code');
        ?>

      <?php endif; ?>

  <style>
    .sty-cfs{
        color:#40c8f4; font-size: 18px;
    }
    .sty-hw{
        height:70px;width:70px;
    }
    .sty-dn{
      display:none; 
    }
</style>

      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

            <?php echo Form::label('name',trans('custom.listings.fields.property-name').'*', ['class'=>'prop']); ?>

            <?php echo Form::text('name', old('name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.property-name'),'required'=>'true'

               ]); ?>


               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">

               <?php echo Form::label('cotact_person_name',trans('custom.listings.fields.full-name-of-contact-person').'*',['class'=>'prop'] ); ?>


                  <?php echo Form::text('cotact_person_name', old('cotact_person_name'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.full-name-of-contact-person'),'required'=>'true'

               ]); ?>


               </div>
            </div>
         </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="form-group">
        <label for="description"><b><?php echo e(trans('custom.listings.fields.description')); ?></b></label>

         <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.description'); ?>" name="description" class="form-control" value="<?php echo e($record->description ?? ''); ?>">

        </div>

        </div>
        </div>

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">
                   <?php echo Form::label('phone_number',trans('custom.listings.fields.phone-number').'*',['class'=>'prop'] ); ?>



               <?php echo Form::number('phone_number', old('phone_number') , ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.phone-number'),'min'=>'0','required'=>'true'

               ]); ?>


               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">
                <?php echo Form::label('email',trans('custom.listings.fields.email-id').'*',['class'=>'prop'] ); ?>


                <?php echo Form::email('email', old('email'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.email-id'),'required'=>'true'

               ]); ?>



               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="form-group">
                  <?php echo Form::label('alter_cotact_person_number',trans('custom.listings.fields.alternate-contact-number'),['class'=>'prop'] ); ?>


                  <?php echo Form::number('alter_cotact_person_number', old('alter_cotact_person_number'), ['class' => 'form-control',
               'placeholder'=>trans('custom.listings.fields.alternate-contact-number'),'min'=>'0'


               ]); ?>

               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <!-- price -->

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


                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="area"><b> <?php echo e(trans('custom.listings.fields.area')); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.area'); ?>" name="area" class="form-control" value="<?php echo e($area); ?>">
                    </div>
                </div>
                <div class="sty-dn">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="capacity"><b><?php echo e(trans('custom.listings.fields.capacity')); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.capacity'); ?>" name="capacity"class="form-control" value="<?php echo e($capacity); ?>">
                    </div>
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

            <?php echo Form::select('is_approved', $verified, $is_approved,['class' => 'form-control'

               ]); ?>


               </div>
            </div>

              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">

              <?php echo Form::label('agent_id',trans('custom.listings.fields.assigned-to')); ?>


              <?php echo Form::select('agent_id', $agents, $agent_id,['class' => 'form-control','placeholder'=>trans('custom.listings.fields.assigned-to')

              ]); ?>


              </div>
              </div>

         </div>

            <?php endif; ?>

            <?php
              $customer_id = \Auth::id();
            ?>
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo e($customer_id ? $customer_id : ''); ?>">

         <div class="form-group">
            <label for="property_address"><b><?php echo e(trans('custom.listings.fields.property-address').'*'); ?></b>
              <span class="fa fa-info-circle" title="<?php echo e(trans('custom.listings.fields.property-address-info')); ?>"></span>
               <span id="property_address_latitude_span" class="label label-default"></span>
               <span id="property_address_longitude_span" class="label label-default"></span>
             </label>
            <input class="form-control" type="text" id="property_address" onClick="initialize(this.id);" onFocus="initialize(this.id);" name="property_address" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.enter-location'); ?>" autocomplete="off" value="<?php echo e($record->property_address ?? ''); ?>" required>
            <input type="hidden" name="property_address_latitude" id="property_address_latitude" value="<?php echo e($record->property_address_latitude ?? ''); ?>">
            <input type="hidden" name="property_address_longitude" id="property_address_longitude" value="<?php echo e($record->property_address_longitude ?? ''); ?>">

            <input type="hidden" name="property_address_street_number" id="property_address_street_number" value="<?php echo e($property_address_street_number); ?>">
            <input type="hidden" name="property_address_city" id="property_address_city" value="<?php echo e($record->property_address_city ?? ''); ?>">
            <input type="hidden" name="property_address_state" id="property_address_state" value="<?php echo e($record->property_address_state ?? ''); ?>">
            <input type="hidden" name="property_address_country" id="property_address_country" value="<?php echo e($record->property_address_country ?? ''); ?>">
            <input type="hidden" name="property_addrress_postal_code" id="property_addrress_postal_code" value="<?php echo e($record->property_addrress_postal_code ?? ''); ?>">


            <p class="help-block"><?php echo e(trans('custom.listings.fields.drag-marker')); ?></p>
         </div>
         <div class="form-group">
            <label for="near_by_landmark"><b><?php echo e(trans('custom.listings.fields.nearby-landmarks').'*'); ?> </b>
               <span id="near_by_landmark_latitude_span" class="label label-default"></span>
               <span id="near_by_landmark_longitude_span" class="label label-default"></span>
               <span id="longitude" class="label label-default"></span></label>
            <input class="form-control" type="text" name="near_by_landmark" id="near_by_landmark" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.nearby-landmarks'); ?>" autocomplete="off"  onClick="initialize(this.id);" onFocus="initialize(this.id);" value="<?php echo e($record->near_by_landmark ?? ''); ?>">

            <input type="hidden" name="near_by_landmark_latitude" id="near_by_landmark_latitude" value="<?php echo e($record->near_by_landmark_latitude ?? ''); ?>">
            <input type="hidden" name="near_by_landmark_longitude" id="near_by_landmark_longitude" value="<?php echo e($record->near_by_landmark_longitude ?? ''); ?>">
         </div>
         <div class="row">

      <?php
       $space_types = \App\SpaceType::getSpaceTypes(0);
      ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

               <div class="form-group">
                  <label for="space_type_id"><b> <?php echo e(trans('custom.listings.fields.workspace-avaliable-in-office')); ?></b></label>

                  <?php $__currentLoopData = $space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <div class="checkbox custom-checkbox new-checkbox">

                <?php
                  $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);

                  $sub_space_type_old = old('sub_space_type_id');
                  $db_selected = $attached_subtypes = [];
                  if ( $record ) {
                    $attached_subtypes_collection = DB::table('property_sub_space_types')->where('property_id', $record->id)->get();
                    foreach ($attached_subtypes_collection as $row) {
                      $attached_subtypes[ $row->sub_space_type_id ] = $row;
                    }
                    $db_selected = $attached_subtypes_collection->pluck('sub_space_type_id')->toArray();
                  }

                  ?>
                  <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $type_subtype = $sub->parent_id . '_' . $sub->id;
                  $selected = false;
                  if ( ! empty( $sub_space_type_old ) && in_array( $type_subtype, $sub_space_type_old) || in_array( $sub->id, $db_selected)) {
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
                  <label for="no_of_workstation"><b> <?php echo e(trans('custom.listings.fields.no-of-workstation')); ?></b></label>
                  <input type="number" min="0" name="no_of_workstation" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-workstation'); ?>" value="<?php echo e($no_of_workstation); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_private_office"><b><?php echo e(trans('custom.listings.fields.no-of-private-office')); ?></b></label>
                  <input type="number" min="0" name="no_of_private_office" class="form-control"  placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-private-office'); ?>" value="<?php echo e($no_of_private_office); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_meeting_office"><b><?php echo e(trans('custom.listings.fields.no-of-meeting-rooms')); ?></b></label>
                  <input type="number" min="0" name="no_of_meeting_office" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-meeting-rooms'); ?>" value="<?php echo e($no_of_meeting_office); ?>">
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
               <div class="form-group">
                  <label for="no_of_training_office"><b><?php echo e(trans('custom.listings.fields.no-of-training-office')); ?></b></label>
                  <input type="number" min="0" name="no_of_training_office" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.no-of-training-office'); ?>" value="<?php echo e($no_of_training_office); ?>">
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
              if ( ! empty( $sub_space_type_old ) && in_array( $type_subtype, $sub_space_type_old) || in_array( $sub->id, $db_selected )) {
              $selected = true;
              }
              $dbvalues = ! empty( $attached_subtypes[ $sub->id ] ) ? $attached_subtypes[ $sub->id ] : null;
              $vo_reg_no = $vo_mailing_address  = null;
              if ( $dbvalues ) {
              $vo_reg_no = $dbvalues->vo_reg_no;
              $vo_mailing_address = $dbvalues->vo_mailing_address;
              }

              ?>

              <!-- virtual offices -->
               <div class="row" id="hd_hidden_fields_<?php echo e($sub->id); ?>" style="display: <?php if($selected): ?> block <?php else: ?> none <?php endif; ?>;">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_reg_no[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.vo-with-bussiness-reg-no')); ?></b></label>
                        <input type="text" name="vo_reg_no[<?php echo e($sub->id); ?>]"  class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-bussiness-reg-no'); ?>" value="<?php echo e($vo_reg_no); ?>">
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group">
                        <label for="vo_mailing_address[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.vo-with-mailing-address')); ?></b></label>
                        <input type="text"  name="vo_mailing_address[<?php echo e($sub->id); ?>]" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.vo-with-mailing-address'); ?>" class="form-control" value="<?php echo e($vo_mailing_address); ?>">
                     </div>
                  </div>
               </div>
               <!-- end virtual offices -->
              <?php else: ?>
             <?php
             $type_subtype = $sub->parent_id . '_' . $sub->id;
            $selected = false;
            if ( ! empty( $sub_space_type_old ) && in_array( $type_subtype, $sub_space_type_old) || in_array( $sub->id, $db_selected )) {
              $selected = true;
            }
            $dbvalues = ! empty( $attached_subtypes[ $sub->id ] ) ? $attached_subtypes[ $sub->id ] : null;
            $avaliable_seats = $price_per_day = $price_per_month = null;
            if ( $dbvalues ) {
              $avaliable_seats = $dbvalues->avaliable_seats;
              $price_per_day = $dbvalues->price_per_day;
              $price_per_month = $dbvalues->price_per_month;
            }

             ?>
             <div class="row" id="hd_hidden_fields_<?php echo e($sub->id); ?>" style="display: <?php if($selected): ?> block <?php else: ?> none <?php endif; ?>;">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="avaliable_seats[<?php echo e($sub->id); ?>]"><b><?php echo e(trans('custom.listings.fields.avaliable-seats-for')); ?> <?php echo e($sub->name); ?> *</b></label>
                      <input type="number" min="0" name="avaliable_seats[<?php echo e($sub->id); ?>]" class="form-control"   placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.avaliable-seats-for'); ?> <?php echo e($sub->name); ?>" value="<?php echo e($avaliable_seats); ?>">
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_day"><b><?php echo e($sub->name); ?> <?php echo e(trans('custom.listings.fields.price-per-day')); ?></b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" name="price_per_day[<?php echo e($sub->id); ?>]" step=0.01 type="number" placeholder="<?php echo e($sub->name); ?> <?php echo app('translator')->getFromJson('custom.listings.fields.price-per-day'); ?>" value="<?php echo e($price_per_day); ?>">
                      </div>
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                   <div class="form-group">
                      <label for="ws_per_month"><b><?php echo e($sub->name); ?> <?php echo e(trans('custom.listings.fields.price-per-month')); ?> </b></label>
                      <div class="input-group">
                         <div class="input-group-addon">₹</div>
                         <input class="form-control" step=0.01 name="price_per_month[<?php echo e($sub->id); ?>]" type="number" placeholder="<?php echo e($sub->name); ?> <?php echo app('translator')->getFromJson('custom.listings.fields.price-per-month'); ?>" value="<?php echo e($price_per_month); ?>">
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
       $db_selected = $attached_amenities = [];
      if ( $record ) {
        $attached_amenities_collection = DB::table('property_amenities')->where('property_id', $record->id)->get();
        foreach ($attached_amenities_collection as $row) {
          $attached_amenities[ $row->amenity_id ] = $row;
        }
        $db_selected = $attached_amenities_collection->pluck('amenity_id')->toArray();
      }
    ?> <!-- >Open hours -->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">



            <label><b><?php echo e(trans('custom.listings.fields.amenities')); ?></b></label>
            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
            $type_amenity = $amenity->id;
            $selected = false;
            if ( ! empty( $amenity_old ) && in_array( $type_amenity, $amenity_old) || in_array($amenity->id,$db_selected)) {
              $selected = true;
            }
            ?>
            <div class="checkbox custom-checkbox"><label>
              <input type="checkbox" name="amenity_id[]" value="<?php echo e($type_amenity); ?>" <?php if($selected): ?> checked <?php endif; ?>><span class="fa fa-check"></span> <?php echo e($amenity->name); ?>

            </label>
        </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

</div>


     <div class="row sty-dn">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label class="sty-cfs"><b><?php echo e(trans('custom.listings.fields.offer-details')); ?></b></label>

                <div class="form-group">
                <label for="offer_title"><b><?php echo e(trans('custom.listings.fields.offer-title')); ?></b></label>
                <input type="text" name="offer_title" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.offer-title'); ?>" class="form-control" value="<?php echo e($offer_title); ?>">
            </div>


            </div>
        </div>
    </div>

<div class="row">
  <div class="form-group">
    <label><b><?php echo e(trans('custom.listings.fields.open-hours')); ?></b></label><br/>
      <label for="days">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e(trans('custom.listings.fields.days')); ?></b></label>
  </div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="form-group">
    

   <?php
       $days = \App\Day::get();
       $day_old = old('day_id');
       $db_selected = $attached_timings = [];
       if ( $record ) {
        $attached_timings_collection = DB::table('property_timings')->where('property_id', $record->id)->get();
        foreach ($attached_timings_collection as $row) {
          $attached_timings[ $row->day_id ] = $row;
        }
        $db_selected = $attached_timings_collection->pluck('day_id')->toArray();
      }

    ?>

  <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
      $type_day = $day->id;
      $selected = false;
      if ( ! empty( $day_old ) && in_array( $type_day, $day_old) || in_array($day->id , $db_selected)) {
      $selected = true;
      }
      ?>
      
   <div class='col-sm-4'>
      <div class="form-group">

        <div class='checkbox custom-checkbox'>
          <label><input type="checkbox" name="day_id[]" value="<?php echo e($type_day); ?>" data-day_id="<?php echo e($day->id); ?>" <?php if($selected): ?> checked <?php endif; ?>>
          <span class="fa fa-check"></span> <?php echo e($day->name); ?></label>
        </div>
      </div>
    </div>

        <div class='col-sm-4'>
           <div class="form-group">

            <?php
             $type_day = $day->id;
            $selected = false;
            if ( ! empty( $day_old ) && in_array( $type_day, $day_old) || in_array( $day->id, $db_selected )) {
              $selected = true;
            }
            $dbvalues = ! empty( $attached_timings[ $day->id ] ) ? $attached_timings[ $day->id ] : null;
            $time_from = $time_to = null;
            if ( $dbvalues ) {
              $time_from = $dbvalues->time_from;
              $time_to = $dbvalues->time_to;

            }

             ?>

                  <label for="time_from"><b><?php echo e(trans('custom.listings.fields.from')); ?></b></label>
                  <div class='input-group date' id='datetimepicker<?php echo e($day->id); ?>from'>
                    <input type="text" name="time_from[<?php echo e($day->id); ?>]" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.from'); ?>" value="<?php echo e($time_from); ?>"/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group">

                  <label for="time_to"><b><?php echo e(trans('custom.listings.fields.to')); ?></b></label>
                  <div class='input-group date' id='datetimepicker<?php echo e($day->id); ?>to'>
                    <input type="text" name="time_to[<?php echo e($day->id); ?>]"class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.to'); ?>" value="<?php echo e($time_to); ?>"/>
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

            <input type="file" class="file file-upload"  data-show-upload="false" data-show-caption="false" data-show-remove="false" name="cover_image" accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images" value="<?php echo e($cover_image); ?>">
            </div>


          <?php if($record): ?>
          <?php if($record->cover_image): ?>
          <img src="<?php echo e($cover_image); ?>" class="sty-hw">
          <?php endif; ?>
          <?php endif; ?>
      </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="image"><b><?php echo e(trans('custom.listings.fields.image-gallery')); ?></b></label>



            <input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" name="image[]"accept="image/jpeg,image/png" files="true" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images" value="<?php echo e(serialize($images)); ?>">
            <p class="help-block"> <?php echo e(trans('custom.listings.fields.multilple-imgs-at-once')); ?></p>

             <?php if($record): ?>
           <?php if(is_array($images) || is_object($images)): ?>
           <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $image_path = PREFIX1 . 'thumb/' . $image;
            ?>
          <img src="<?php echo e(url( $image_path )); ?>" class="sty-hw" >
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php endif; ?>

        </div>




    </div>

</div>
 <!-- new section 2-->

<!-- >Contact section -->
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="sty-cfs"><b><?php echo e(trans('custom.listings.fields.contact-details')); ?></b></label>

                        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_name"><b><?php echo e(trans('custom.listings.fields.property-manager-name').'*'); ?></b></label>
                        <input type="text" name="property_manager_name" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-name'); ?>" class="form-control" value="<?php echo e($property_manager_name); ?>" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_email"><b><?php echo e(trans('custom.listings.fields.property-manager-email').'*'); ?></b></label>
                            <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-email'); ?>" name="property_manager_email"type="email" value="<?php echo e($property_manager_email); ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="property_manager_number"><b><?php echo e(trans('custom.listings.fields.property-manager-phone').'*'); ?></b></label>
                        <input type="number" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.property-manager-phone'); ?>" name="property_manager_number"class="form-control" value="<?php echo e($property_manager_number); ?>" required>
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
                     <label class="sty-cfs"><b><?php echo e(trans('custom.listings.fields.invoice-related-details')); ?></b></label>

                     <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="company"><b><?php echo e(trans('custom.listings.fields.company-name')); ?></b></label>
                     <input type="text" name="company" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.company-name'); ?>" class="form-control" value="<?php echo e($company); ?>">
                 </div>
             </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="pan_no"><b> <?php echo e(trans('custom.listings.fields.pan-no')); ?></b></label>
                          <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.pan-no'); ?>" name="pan_no"type="text" value="<?php echo e($pan_no); ?>">
                       </div>
                   </div>

             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                     <label for="cin_no"><b><?php echo e(trans('custom.listings.fields.cin-no')); ?></b></label>
                     <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.cin-no'); ?>" name="cin_no" class="form-control" value="<?php echo e($cin_no); ?>">
                 </div>
             </div>




       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
           <div class="form-group">
               <label for="gst"><b><?php echo e(trans('custom.listings.fields.gst')); ?></b></label>
               <input type="number" min="0" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.gst'); ?>" name="gst" class="form-control" value="<?php echo e($gst); ?>">
           </div>
       </div>

   </div>

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="billing_address"><b><?php echo e(trans('custom.listings.fields.billing-address')); ?></b></label>

             <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.billing-address'); ?>" name="billing_address" class="form-control" value="<?php echo e($billing_address); ?>">
         </div>

             </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
             <label for="registered_address"><b><?php echo e(trans('custom.listings.fields.registered-address')); ?></b></label>

             <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.registered-address'); ?>" name="registered_address" class="form-control" value="<?php echo e($registered_address); ?>">

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
                           <label class="sty-cfs"><b><?php echo e(trans('custom.listings.fields.bank-details')); ?></b></label>

                  <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="bank_name"><b><?php echo e(trans('custom.listings.fields.bank-name')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.bank-name'); ?>" name="bank_name" class="form-control" value="<?php echo e($bank_name); ?>">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_holder_name"><b><?php echo e(trans('custom.listings.fields.account-holder-name')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.account-holder-name'); ?>" name="account_holder_name" class="form-control" value="<?php echo e($account_holder_name); ?>">
                       </div>
                   </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="account_number"><b><?php echo e(trans('custom.listings.fields.account-number')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.account-number'); ?>" name="account_number" class="form-control" value="<?php echo e($account_number); ?>">
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group">
                           <label for="ifsc_code"><b><?php echo e(trans('custom.listings.fields.ifsc-code')); ?></b></label>
                           <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.ifsc-code'); ?>" name="ifsc_code" class="form-control" value="<?php echo e($ifsc_code); ?>">
                       </div>
                   </div>


                  </div>


                       </div>
                   </div>
               </div>


<div class="form-group">
   <button type="submit" name="send" class="btn btn-green btn-lg isThemeBtn"><?php echo e($button_name); ?></button>
</div>
 <?php echo Form::close(); ?>

</div>
</div>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/fileinput.min.js"></script>

<script>
// highlight current day on opeining hours
$(document).ready(function() {
"use strict";
$('.opening-hours li').eq(new Date().getDay()).addClass('today');
});


// datetimepicker

        $(function () {
        $('#datetimepicker1').datetimepicker({

        format: 'YYYY/MM/DD'
        });
        });

    $(function () {
        $('#datetimepicker2').datetimepicker({
            format: 'LT'
        });
    });

    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });

    <?php if( ! empty( $days ) ): ?>
      <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        $(function () {
            $('#datetimepicker<?php echo e($day->id); ?>from').datetimepicker({
                format: 'LT'
            });
        });

        $(function () {
            $('#datetimepicker<?php echo e($day->id); ?>to').datetimepicker({
                format: 'LT'
            });
        });
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</script>

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
<!-- client side form validation -->