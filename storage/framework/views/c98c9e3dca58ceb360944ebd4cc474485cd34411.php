<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
  <div class="row">
   <div class="col-md-12">
      <div class="card-box">

      <?php if(session('success')): ?>
		<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				<?php echo e(session('success')); ?>

			</div>
		</div>
	<?php else: ?>	

		<?php echo Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]); ?>


        <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                <?php echo Form::label('current_password',trans('custom.eforms.currentpassword') ); ?>


				<?php echo Form::password('current_password', ['class' => 'form-control','id'=>'current_password','placeholder'=>trans('custom.eforms.currentpassword'), 'required'=>'true'

				]); ?>


				<?php if($errors->has('current_password')): ?>
					<p class="help-block">
					<?php echo e($errors->first('current_password')); ?>

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
                    <?php echo Form::label('new_password', trans('custom.eforms.newpassword')); ?>

                 
                  <div class="row">
                     <div class="col-12">

					<?php echo Form::password('new_password', ['class' => 'form-control','id'=>'new_password','placeholder'=>trans('custom.eforms.newpassword'), 'required'=>'true'

						]); ?>


					<?php if($errors->has('new_password')): ?>
					<p class="help-block">
					<?php echo e($errors->first('new_password')); ?>

					</p>
					<?php endif; ?>		

                     </div>

                      <div class="col-12">

                      	<?php echo Form::label('new_password_confirmation', trans('custom.eforms.confirm-new-password')); ?>



						<?php echo Form::password('new_password_confirmation',['class' => 'form-control','id'=>'new_password_confirmation','placeholder'=>trans('custom.eforms.confirm-new-password'), 'required'=>'true'

						]); ?>


						<?php if($errors->has('new_password_confirmation')): ?>
							<p class="help-block">
								<?php echo e($errors->first('new_password_confirmation')); ?>

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
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo app('translator')->getFromJson('custom.eforms.change-password'); ?></button>
      </div>
      
         <?php echo Form::close(); ?>

      <?php endif; ?>
         <!-- end form -->
            <!-- change password form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?>  
  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.newadmin.common.parseley-clientside-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>