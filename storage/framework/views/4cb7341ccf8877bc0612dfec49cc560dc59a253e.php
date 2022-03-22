<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('new_content'); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><?php echo app('translator')->getFromJson('global.master-settings.title'); ?> </h4>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- end row -->

<div class="row">
   <div class="col-md-12">
      <div class="card-box">

        <!-- record form start -->
        <?php echo Form::model($master_setting, ['method' => 'PUT', 'route' => ['admin.master_settings.update', $master_setting->id],'class'=>'formvalidation']); ?>

        
           <!-- Start  -->

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                  <div class="form-group m-b-20">
                   

                    <?php echo Form::label('module', trans('global.master-settings.fields.module').'*'); ?>


                     <?php echo Form::text('module', old('module'), ['class' => 'form-control', 'placeholder' => trans('global.master-settings.fields.module'), 'required' => '']); ?>


                      <p class="help-block"></p>
                    <?php if($errors->has('module')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('module')); ?>

                        </p>
                    <?php endif; ?>

                  </div>

                  <div class="form-group m-b-20">
                   
                    <?php echo Form::label('key', trans('global.master-settings.fields.key').'*'); ?>


                    <?php echo Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => trans('global.master-settings.fields.key'), 'required' => '']); ?>


                      <p class="help-block"></p>
                    <?php if($errors->has('key')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('key')); ?>

                        </p>
                    <?php endif; ?>

                  </div>

                     <div class="form-group m-b-20">
                        

                        <?php echo Form::label('moduletype', trans('custom.settings.moduletype').'*'); ?>



                        <?php echo Form::select('moduletype', $enum_moduletype, old('moduletype'), ['class' => 'form-control', 'required' => '']); ?>


                        <p class="help-block"></p>
                    <?php if($errors->has('moduletype')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('moduletype')); ?>

                        </p>
                    <?php endif; ?>

                     </div>
                 
                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">

                   <div class="form-group m-b-20">

                   <?php
                      $statuses = array(
                          'Active' => trans( 'custom.common.active' ),
                      'Inactive' => trans( 'custom.common.inactive' ),
                      );
                   ?>

                    <?php echo Form::label('status', trans('custom.settings.status').'*'); ?>


                      <?php echo Form::select('status', $statuses, old('status'), ['class' => 'form-control', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('status')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('status')); ?>

                        </p>
                    <?php endif; ?>

                        
                  </div>

                     <div class="form-group m-b-20">

                           <?php echo Form::label('description', trans('global.master-settings.fields.description').''); ?>


                        <div class="row">
                           <div class="col-12">

                              <?php echo Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('global.master-settings.fields.description'),'rows'=>'4']); ?>

                          <p class="help-block"></p>
                          <?php if($errors->has('description')): ?>
                              <p class="help-block">
                                  <?php echo e($errors->first('description')); ?>

                              </p>
                          <?php endif; ?>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>

                   
                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
            <div class="text-center">
               <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo app('translator')->getFromJson('global.app_update'); ?></button>
            </div>
           <!-- End  -->

         <?php echo Form::close(); ?>       
       
         <!-- end form -->
            <!-- users form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>