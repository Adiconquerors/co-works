<?php $__env->startSection('content'); ?>

<style>
.sty-dn{
	display: none;
}
</style>

<div class="login-content installation-page" >

		<div class="logo text-center"><img src="<?php echo e(url(PREFIX1 . 'assets/images/coworking-logs/Asset-1.png')); ?>" alt="Coworking" height="100" width="300"></div>
		<div class="row">
			<div class="col-md-6 col-xs-offset-3">
		<?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
		<?php echo Form::open(array('route' => ['install.register'], 'method' => 'POST', 'name'=>'registrationForm ', 'novalidate'=>'', 'class'=>"loginform", 'id'=>"install_form")); ?>


<div class="row" >
	<div class="col-md-6 col-md-offset-3">

	<div class="info">
		<h3>Coworking System User Details</h3>
			<p>Please enter Owner details for this system</p>
	</div>

	<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>

			<?php echo e(Form::text('first_name', $value = null , $attributes = array('class'=>'form-control',
				'placeholder' => 'First Name',
				'ng-model'=>'system_name',
				'required'=> 'true',
				'ng-class'=>'{"has-error": registrationForm.system_name.$touched && registrationForm.system_name.$invalid}',
				'ng-minlength' => '1',
			))); ?>

		</div>

		<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>

			<?php echo e(Form::text('last_name', $value = null , $attributes = array('class'=>'form-control',
				'placeholder' => 'Last name',
				'ng-model'=>'system_user_name',
				'required'=> 'true',
				'ng-class'=>'{"has-error": registrationForm.system_user_name.$touched && registrationForm.system_user_name.$invalid}',
				'ng-minlength' => '1',
			))); ?>

		</div>



		<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
			<?php echo e(Form::email('owner_email', '' , $attributes = array('class'=>'form-control',
				'placeholder' => 'Email address',
				'ng-model'=>'owner_email',
				'required'=> 'true',
				'ng-class'=>'{"has-error": registrationForm.owner_email.$touched && registrationForm.owner_email.$invalid}',
				'ng-minlength' => '1',
			))); ?>

		</div>

		<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
			<?php echo e(Form::password('owner_password', $attributes = array('class'=>'form-control',
				'placeholder' => 'Password',
				'ng-model'=>'owner_password',
			))); ?>


		</div>
	</div>

</div>
	<div class="text-center buttons">
	<button type="button"  class="btn button btn-primary btn-lg"

	ng-disabled='!registrationForm.$valid' onclick="submitForm();" >Next</button>

	If you have already user details to login, <a href="<?php echo e(route('login')); ?>">click</a> here.
	</div>

		<?php echo Form::close(); ?>



		 <div class="loadingpage text-center sty-dn" id="after_display">

		 	<p>Please Wait...</p>

		 	<img width="200" src="<?php echo e(url(PREFIX1 . 'assets/images/loading-small.gif')); ?>">
		 </div>

	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/bootstrap-toggle.min.js"></script>
 <script>
 	$().ready(function() {
 		"use strict";

 		$("#install_form").validate();
 	});
 	function submitForm() {
 		$('#install_form').hide();
 		$('#after_display').show();
 		$('#install_form').submit();
 	}
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('install.install-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>