<?php $__env->startSection( 'main_header_styles' ); ?>
   <style>
   .hiw-content-image{
      max-width: 100%;
   }
   .sty-h420 img{
   	width: auto;
   	height: auto;
   }
   </style>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'content' ); ?>
<main class="main">
   <?php
        $background_image_heading = getSetting('background_image_heading','landlord-settings');
        $background_image = getSetting('background_image','landlord-settings');
        $content = getSetting('content','landlord-settings');
        
        $content_heading = getSetting('content_heading','landlord-settings');
       
        $content_image = getSetting('content_image','landlord-settings');
        $content_one_main_heading = getSetting('content_one_main_heading','landlord-settings');
        
        $content_one_card_one_heading = getSetting('content_one_card_one_heading','landlord-settings');
        $content_one_card_two_heading = getSetting('content_one_card_two_heading','landlord-settings');
        $content_one_card_one_heading_caption = getSetting('content_one_card_one_heading_caption','landlord-settings');
        $content_one_card_two_heading_caption = getSetting('content_one_card_two_heading_caption','landlord-settings');
        $contact = getSetting('contact','landlord-settings');
        $contact_heading = getSetting('contact_heading','landlord-settings');
        $contact_image = getSetting('contact_image','landlord-settings');
     
      ?>         
<div class="home-hero__wrap home--height" style="background-image: url(<?php echo e(IMAGE_PATH_SETTINGS.$background_image); ?>); height: 20em;">
         <div class="home-hero__overlay"></div>
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12">
                  <h1 class="home-hero__title"><?php echo e($background_image_heading); ?></h2>
               </div>
            </div>
         </div>
      </div>
   <!-- about -->
   <div class="home-section home-section__white">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h2 class="home-section__title"><?php echo e($content_heading); ?></h2>
            </div>
         </div>
         <div class="row">
         <div class="col-lg-8 col-xs-12">
            <p class="about-us-h3"><?php echo e($content); ?> 
            </p>
            </div>
            <div class="col-lg-4 col-xs-12">
              <?php
                $default_im_path = getDefaultimgagepath($content_image,'settings')
             ?>  
             
                <img src="<?php echo e($default_im_path); ?>"  class="hiw-content-image"  alt="icon">
               
            </div>
         </div>
      </div>
   </div>
   <!-- /about -->
   <div class="home-section home-section__white" style="background-image: url(<?php echo e(PUBLIC_ASSETS); ?>images/exp-bg.jpg);background-repeat: no-repeat;">
      <div class="container expertise-margin">
         <div class="row">
            <div class="col-md-12">
               <h2 class="home-section__title"><?php echo e($content_one_main_heading); ?></h2>
            </div>
         </div>
        <br/>
    
         <div class="row card-margin">
            <div class="col-md-6 col-xs-12">
               <div class="home-section__work-wrap sty-h420">
                  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/service.png" alt="icon">
                  <h3><?php echo e($content_one_card_one_heading); ?></h3>
                  <p><?php echo e($content_one_card_one_heading_caption); ?>

                  </p>
               </div>
            </div>
            <div class="col-md-6 col-xs-12">
               <div class="home-section__work-wrap sty-h420">
                  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/market.png" alt="icon">
                  <h3><?php echo e($content_one_card_two_heading); ?></h3>
                  <p><?php echo e($content_one_card_two_heading_caption); ?>

                  </p>
               </div>
            </div>
             
         </div>
      </div>
   </div>

 


   <!-- about -->
   <div class="home-section home-section__white">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h2 class="home-section__title"><?php echo e($contact_heading); ?></h2>
            </div>
         </div>
         <div class="row">
         <div class="col-lg-4 col-xs-12">
          <?php
             $contact_im_path = getDefaultimgagepath($contact_image,'settings')
          ?>
           
            <img src="<?php echo e($contact_im_path); ?>"  class="hiw-content-image"  alt="icon">
           
            </div>
         <div class="col-lg-8 col-xs-12">
            <p class="about-us-h3"><?php echo e($contact); ?> 
            </p>
          
            </div>
          
         </div>
      </div>
   </div>
   <!-- /about -->


</main>

<!-- footer -->
<?php echo $__env->make( 'partials.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>