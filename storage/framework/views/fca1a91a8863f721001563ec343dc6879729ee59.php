<?php $__env->startSection('content'); ?>

<style type="text/css">

		.styy_inp{
			margin-top: 20px; background-color: #fafafa;
		}
		.styy_bsdr{
			border: 2px solid #d3cfcf; border-radius: 10px;
		}
		.styy_tt{
			font-family: lato; font-size: 34px; font-weight: bold;
		}
		.styy_cll{
			font-size: 17px; margin-bottom: 18px; text-align: justify; margin-top: 15px;
		}
		.styy_fs{
			font-size: 17px;
		}
		.styy_mtf{
			margin-top: 15px; text-align: justify; font-size: 17px;
		}
		.styy_mty{
			text-align: justify; font-size: 17px;
		}
		#styy_mtt{
			margin-top: 25px;
		}
		.styy_spaa{
			font-family: lato; font-size: 21px;
		}

      @media(max-width: 767px){
      .col-md-8 {
      	margin-left: 28px;
      	margin-right: 28px;
      	margin-top: 15px;
      }
      .btn-success{
      	font-size: 17px;
        padding: 8px 10px 8px 10px;
        margin-bottom: 30px;
      }
   }

</style>

<div class="login-content installation-page styy_inp">

		<div class="logo text-center"><img src="<?php echo e(url(PREFIX1 . 'assets/images/coworking-logs/Asset-1.png')); ?>" alt="Coworking Space" height="100" width="300"></div>
		
<div class="container">
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 styy_bsdr">
		<div class="info">
		<h3 class="styy_tt">Before you proceed...</h3>
		<p class="styy_cll">
			Welcome to Coworking Space. Before getting started, we need some information on the database. You will need to know the following items before proceeding.</p>
<span class="styy_fs">
<li>Database name</li>
<li>Database username</li>
<li>Database password</li>
<li>Database host</li>
</span>
<p class="styy_mtf">We’re going to use this information to update a .env file.	If for any reason this automatic file creation doesn’t work, don’t worry. All this does is fill in the database information to a configuration file called .env in root folder. You may also simply open .env which is located in root folder in a text editor, fill in your information, and save it.</p>

<p class="styy_mty">In all likelihood, these items were supplied to you by your Web Host. If you don’t have this information, then you will need to contact them before you can continue. If you’re all ready…</p>
		
	</div>
</div>
	<div class="col-md-2"></div>
	
</div>
</div>
		
<div class="text-center buttons" id="styy_mtt">

<a class="btn button btn-success btn-lg" href="<?php echo e(url('install-check-requiremetns')); ?>"><span class="styy_spaa">Let’s go!</span></a>

</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('install.install-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>