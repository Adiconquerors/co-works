<?php $__env->startSection('content'); ?>
<style type="text/css">

html, body {
  	background: white;
  	background-size:cover;
  	width: 100%;
  	height: auto; background-repeat:no-repeat; background-attachment:local;  font-size: 90%;
	font-family: Helvetica,Arial,sans-serif;
	margin: 0 auto; 
}

.install {
	background: none repeat scroll 0 0 #fff;
    border-radius: 5px;
    margin: 65px auto 0;
    width: 32%;
}
.logo {
	margin-top: 25px;
}
.styy_nne{
	font-family: lato; font-size: 21px;
}
.styy_dddn{
	display: none;
}
.active {
    color: #3bf02d;
}
.stage {
	color: #171717;
}
.done {
    color: #fafafa;
}
.table {
	margin-top: 15px;
}
#styy_ttb{
	align: center; width: 100%; background-color: #f1f1f1; border: 2px solid #98acac;
}
.styy_reqq{
	font-family: lato; font-size: 17px;
}
 .button {
 	margin-bottom: 40px;
 	margin-top: 15px;
 }
 @media(max-width: 767px){
 	  .table {
           width: 100%;
 	  }
 	  .logo {
 	  	margin-top: 20px;
 	  	margin-bottom: -15px;
 	  }
 	  .button {
           font-size: 17px;
           padding: 6px 14px 6px 14px;
           margin-bottom: 30px;
 	  }
 }

</style>

<div class="login-content installation-page" >

		<div class="logo text-center"><img src="<?php echo e(url(PREFIX1 . 'assets/images/coworking-logs/Asset-1.png')); ?>" alt="" height="100" width="300"></div>
		<?php echo $__env->make('install.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::open(array('route' => ['install.requirements'], 'method' => 'POST', 'name'=>'registrationForm ', 'novalidate'=>'', 'class'=>"loginform", 'id'=>"install_form")); ?>

<div class="row" >
<?php $isInstallable = 1; ?>
    <div class="container">
	 <div class="col-md-12">
	 <table class="table" id="styy_ttb">
  <thead>
    <tr>
       
      <th class="styy_reqq">Requirement</th>
      <th class="styy_reqq">Status</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">PHP Version >= 7.1.3 </th>
      
      <td>
	      	<?php if(version_compare(phpversion(), '7.1.3', '>=')): ?>  
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
      
    </tr>

    <tr>
      <th scope="row">.env Writable</th>
      
      <td>
	      	<?php if( is_writable( base_path() . '/.env' ) ): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">PDO PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('PDO')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">libxml PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('libxml')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">Ctype PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('Ctype')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">JSON PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('JSON')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">BCMath PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('BCMath')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

  
    <tr>
      <th scope="row">max_execution_time</th>
      
      <td>
	      	<?php if(ini_get('max_execution_time')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>


      <tr>
      <th scope="row">Tokenizer PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('tokenizer')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">XML PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('xml')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>

    <tr>
      <th scope="row">GD Library</th>
      
      <td>
	      	<?php if(extension_loaded('gd')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>


    
    <tr>
      <th scope="row">fileinfo</th>
      
      <td>
	      	<?php if(extension_loaded('fileinfo')): ?> 
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">OpenSSL PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('openssl')): ?> 
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">Mbstring PHP Extension</th>
      
      <td>
	      	<?php if(extension_loaded('mbstring')): ?>
	      		<i class="fa fa-check text-success" aria-hidden="true"></i>
	      	<?php else: ?>
		      	<i class="fa fa-times text-danger" aria-hidden="true"></i>
		      	<?php $isInstallable = 0; ?>
	      	<?php endif; ?>
      </td>
    </tr>
   
  
  </tbody>
</table>
	 	
	 </div>
	</div>
	</div>
	
</div>
		
		

		

		
			<?php if($isInstallable): ?>
		
			<div class="text-center buttons">
<a href="<?php echo e(route('install.index')); ?>" title="Instructions" class="btn button btn-info btn-lg"><span class="styy_nne">Instructions</span></a>&nbsp;&nbsp;
				<button type="button"  class="btn button btn-success btn-lg" 

				ng-disabled='!registrationForm.$valid' onclick="submitForm();" ><span class="styy_nne">Next</span></button>

			</div>
			<?php else: ?>
			<p class="text-danger">Note: Please install/enable the above requirements to continue... </p>
			<?php endif; ?>

		<?php echo Form::close(); ?>

		

		 <div class="loadingpage text-center styy_dddn"  id="after_display">
		 	
		 	<p>Please Wait...</p>

		 	<img width="200" src="<?php echo e(url(PREFIX1 . 'assets/images/loading-small.gif')); ?>">
		 </div>

	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/bootstrap-toggle.min.js"></script>
 <script>
 	function submitForm() {
 		$('#install_form').hide();
 		$('.buttons').hide();
 		$('#after_display').show();
 		$('#install_form').submit();
 	}
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('install.install-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>