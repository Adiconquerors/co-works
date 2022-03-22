<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
   <?php echo $__env->make( 'partials.head' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </head>
   
   <body class="home">
      <div id="app">
       
         <header class="masthead">
            <nav class="navbar navbar-default navbar-fixed-top"> 
               <div class="container-fluid">
                  <!-- sidebar -->
                  <?php echo $__env->make( 'partials.sidebar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <!-- end sidebar -->

                  <!-- main-homepage-topbar --> 
                  <?php echo $__env->make( 'partials.main-topbar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <!-- end main-homepage-topbar -->
                  
               </div>
            </nav>
         </header>
         <?php echo $__env->yieldContent( 'content' ); ?>
      </div>

      <!-- javascripts -->
      <?php echo $__env->make( 'partials.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- end javascripts -->
      
   </body>
</html>