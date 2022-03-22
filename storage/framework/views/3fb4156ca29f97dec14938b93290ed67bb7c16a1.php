   <?php if($record): ?>
    <?php
      $icon_id = $record->icon_id;
    ?>

    <?php else: ?>

         <?php
           $icon_id = null;
        ?>

     <?php endif; ?>
      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                <?php echo Form::label('text', trans('global.internal-notifications.fields.text').'*' ); ?>


                <?php echo Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => trans('global.internal-notifications.fields.text'),'required'=>'true']); ?>


               </div>

                <div class="form-group m-b-20">

                  <?php
                    $type = array(
                        'topbar' => 'topbar',
                        'sidebar' => 'sidebar',
                    );

                  ?>   

              <?php echo Form::label('type',trans('custom.settings.type')); ?>


              <?php echo Form::select('type', $type, old('type') ,['class' => 'form-control'

              ]); ?>

                  

               </div>


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                   <?php echo Form::label('link', trans('global.internal-notifications.fields.link') ); ?>

                 
                  <?php echo Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => trans('global.internal-notifications.fields.link')]); ?>

                  <!-- end row -->
               </div>

                   <div class="form-group m-b-20">
                        <label for="icon_id"><?php echo app('translator')->getFromJson('custom.icons.select-icon'); ?> :&nbsp;</label>

                          <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <i class="<?php echo e($icon); ?>"></i>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                         <?php echo Form::select('icon_id', $icons ,$icon_id, ['class' => 'form-control', 'id' => 'icon_id','placeholder'=>'Please Select' ]); ?>


                       
                     </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e($button_name); ?></button>
      </div>