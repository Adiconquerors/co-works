    <?php if($record): ?>
    <?php
      $membership_fee_id = $record->membership_fee_id;

    ?>

    <?php else: ?>

         <?php
           $membership_fee_id     = null;
        ?>

     <?php endif; ?>


            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">
                    <?php if( ! empty( $space_type_parent_list ) ): ?>
                     <div class="form-group m-b-20">
                        <label for="parent_id"><?php echo app('translator')->getFromJson('custom.spacetypes.parent_id'); ?></label>

                         <?php echo Form::select('parent_id', $space_type_parent_list, old('parent_id'), ['class' => 'form-control', 'id' => 'parent_id','placeholder'=>trans('custom.eforms.please-select'), 'required'=> 'true']); ?>


                     
                     </div>
                    <?php endif; ?>


                 <?php if( empty( $space_type_parent_list ) ): ?>
                     <div class="form-group m-b-20">
                        <label for="membership_fee_id"><?php echo app('translator')->getFromJson('custom.spacetypes.select_membership_fees'); ?></label>

                      <?php
                      $membership_fees = \App\MembershipFee::get();
                      $selected = [];
                      if ( $record ) {
                        $selected = $record->space_type_membership_fees()->pluck('membership_fee_id')->toArray();
                      }

                      ?>

                      <select class="form-control" id="membership_fee_id" name="membership_fee_id[]" multiple="" value="<?php echo e($membership_fee_id); ?>">

                        <?php $__currentLoopData = $membership_fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership_fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($membership_fee->id); ?>" <?php if(in_array($membership_fee->id, $selected)): ?> selected <?php endif; ?>)><?php echo e($membership_fee->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                     </div>
                    <?php endif; ?>

                     <?php if( ! empty( $space_type_parent_list ) ): ?>
                    <div class="form-group m-b-20">
                       <?php echo Form::label('des_one', trans('custom.spacetypes.description-one')); ?>


                          <?php echo Form::textarea('des_one', old('des_one'), ['class' => 'form-control' ,  'id'=>'sub-space-des_one', 'rows'=>'5', 'placeholder' => trans('custom.spacetypes.description-one'), 'maxlength'=>'250', 'required'=> 'true']); ?>

                     </div>
                     <?php endif; ?>

                     <?php if( ! empty( $space_type_parent_list ) ): ?>
                    <div class="form-group m-b-20">
                       <?php echo Form::label('des_three',trans('custom.spacetypes.description-three')); ?>


                          <?php echo Form::textarea('des_three', old('des_three'), ['class' => 'form-control' ,  'id'=>'sub-space-des_three', 'rows'=>'5', 'placeholder' => trans('custom.spacetypes.description-three'), 'required'=> 'true']); ?>

                     </div>
                        <?php endif; ?>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                      <?php if( ! empty( $space_type_parent_list ) ): ?>
                      <div class="form-group m-b-20">
                         <?php echo Form::label('des_two',trans('custom.spacetypes.description-two')); ?>


                            <?php echo Form::textarea('des_two', old('des_two'), ['class' => 'form-control' ,  'id'=>'sub-space-des_two', 'rows'=>'5', 'placeholder' => trans('custom.spacetypes.description-two'), 'required'=> 'true']); ?>

                       </div>


                       <?php if( ! empty( $space_type_parent_list ) ): ?>
                      <div class="form-group m-b-20">
                         <?php echo Form::label('des_four',trans('custom.spacetypes.description-four')); ?>


                            <?php echo Form::textarea('des_four', old('des_four'), ['class' => 'form-control' ,  'id'=>'sub-space-des_four', 'rows'=>'5', 'placeholder' => trans('custom.spacetypes.description-four'), 'required'=> 'true']); ?>

                       </div>
                          <?php endif; ?>



                     <div class="form-group m-b-20">
                           <?php echo Form::label('image',trans('global.app_image')); ?>


                           <?php
                              if( $record )
                              {
                                  $image_url = $record->image;

                              }else{
                                  $image_url = null;
                              }
                           ?>
                        <input type="file" class="dropify" name="image"  data-height="120" value="<?php echo e($image_url); ?>"  accept=".jpeg, .png, .jpg, .gif, .svg">
                        <br/>
                       
                         <?php if( $record ): ?>
                          <img src="<?php echo e(getDefaultimgagepath($record->image,'space-types')); ?>" height="100" width="100">
                         <?php endif; ?>

                     </div>
                      <?php endif; ?>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->


        <input type="hidden" name="action" value="<?php echo e($action ?? ''); ?>">