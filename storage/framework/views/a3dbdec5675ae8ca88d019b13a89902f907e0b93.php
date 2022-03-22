<!DOCTYPE html>
<html lang="en">
   <head>
   <?php echo $__env->make( 'partials.main-two.head' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </head>

    <body class="notransition">

	<?php echo $__env->make( 'partials.main-two.main-topbar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

	<?php echo $__env->make( 'partials.main-two.sidebar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>  	
  
    <div id="wrapper">
	 
	 <?php echo $__env->yieldContent( 'content_two' ); ?>
  
    </div>
    
    <?php echo $__env->make( 'partials.main-two.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    </body>

</html>