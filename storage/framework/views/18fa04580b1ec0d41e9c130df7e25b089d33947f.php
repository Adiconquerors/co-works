 <?php $__env->startSection( 'main_header_styles' ); ?>
   <style>
   .content-image{
      max-width: 100%;
   }
   .sty-h420 img{
    height: auto;
    width: auto !important;
    margin: 0 auto 3rem;
    display: block;
   }
   </style>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'content' ); ?>
<main class="main">

    <?php
       $background_image_heading = getSetting('background_image_heading','about-us-settings');
        $background_image = getSetting('background_image','about-us-settings');
        $content = getSetting('content','about-us-settings');
 
        $content_heading = getSetting('content_heading','about-us-settings');
        $content_image = getSetting('content_image','about-us-settings');
        $our_expertise_heading = getSetting('our_expertise_heading','about-us-settings');
        $our_expertise_caption = getSetting('our_expertise_caption','about-us-settings');
        
        $our_expertise_card_one_heading = getSetting('our_expertise_card_one_heading','about-us-settings');
        $our_expertise_card_two_heading = getSetting('our_expertise_card_two_heading','about-us-settings');
        $our_expertise_card_three_heading = getSetting('our_expertise_card_three_heading','about-us-settings');
        $our_expertise_card_one_heading_caption = getSetting('our_expertise_card_one_heading_caption','about-us-settings');
        $our_expertise_card_two_heading_caption = getSetting('our_expertise_card_two_heading_caption','about-us-settings');
        $our_expertise_card_three_heading_caption = getSetting('our_expertise_card_three_heading_caption','about-us-settings');
        
        $why_heading = getSetting('why_heading','about-us-settings');
        $why_card_one_heading = getSetting('why_card_one_heading','about-us-settings');
        $why_card_two_heading = getSetting('why_card_two_heading','about-us-settings');
        $why_card_three_heading = getSetting('why_card_three_heading','about-us-settings');
        $why_card_four_heading = getSetting('why_card_four_heading','about-us-settings');
        $why_card_one_heading_caption = getSetting('why_card_one_heading_caption','about-us-settings');
        $why_card_two_heading_caption = getSetting('why_card_two_heading_caption','about-us-settings');
        $why_card_three_heading_caption = getSetting('why_card_three_heading_caption','about-us-settings');
        $why_card_four_heading_caption = getSetting('why_card_four_heading_caption','about-us-settings');
       
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
                $default_im_path = getDefaultimgagepath($content_image,'settings');
             ?>
            
                  <img src="<?php echo e($default_im_path); ?>"  class="content-image"  alt="icon">
                  
            </div>
         </div>
      </div>
   </div>
   <!-- /about -->
   <div class="home-section home-section__white" style="background-image: url(<?php echo e(PUBLIC_ASSETS); ?>images/exp-bg.jpg);background-repeat: no-repeat;">
      <div class="container expertise-margin">
         <div class="row">
            <div class="col-md-12">
               <h2 class="home-section__title"><?php echo e($our_expertise_heading); ?></h2>
            </div>
         </div>
         <div class="row ">
            <p class="about-us-h3"><?php echo e($our_expertise_caption); ?>

            </p>
         </div>
         <br><br>
         <div class="row card-margin">
            <div class="col-md-4">
               <div class="home-section__work-wrap sty-h420">
                  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/service.png" alt="icon">
                  <h3><?php echo e($our_expertise_card_one_heading); ?> </h3>
                  <p><?php echo e($our_expertise_card_one_heading_caption); ?>

                  </p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="home-section__work-wrap sty-h420">
                  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/market.png" alt="icon">
                  <h3><?php echo e($our_expertise_card_two_heading); ?></h3>
                  <p><?php echo e($our_expertise_card_two_heading_caption); ?>

                  </p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="home-section__work-wrap sty-h420">
                  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/side.png" alt="icon">
                  <h3><?php echo e($our_expertise_card_three_heading); ?></h3>
                  <p><?php echo e($our_expertise_card_three_heading_caption); ?>

                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /Our Expertise -->
   <!-- Our Expertise -->
   <div class="home-section home-section__white" style="background-image: url(<?php echo e(PUBLIC_ASSETS); ?>images/whyworklease-bg-fade);background-repeat: no-repeat;">
      <div class="container expertise-margin">
         <div class="row">
            <div class="col-md-12">
               <h2 class="home-section__title"><?php echo e($why_heading); ?></h2>
            </div>
         </div>
       
         <br><br>
         <div class="row card-margin">
            <div class="col-md-6 col-sm-12 col-xs-12 benefit-item">
               <div class="benefit-card row">
                  <div class="benefit-icon col-xs-2">
                     <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/ease-of-finding.png">
                  </div>
                  <div class="benefit-content col-xs-10">
                     <h3>
                        <?php echo e($why_card_one_heading); ?>

                     </h3>
                     <p>
                        <?php echo e($why_card_one_heading_caption); ?>

                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 benefit-item">
               <div class="benefit-card row">
                  <div class="benefit-icon col-xs-2">
                     <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/agility.png">
                  </div>
                  <div class="benefit-content col-xs-10">
                     <h3>
                        <?php echo e($why_card_two_heading); ?>

                     </h3>
                     <p>
                       <?php echo e($why_card_two_heading_caption); ?>

                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 benefit-item">
               <div class="benefit-card row">
                  <div class="benefit-icon col-xs-2">
                     <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/flexible.png">
                  </div>
                  <div class="benefit-content col-xs-10">
                     <h3>
                        <?php echo e($why_card_three_heading); ?>

                     </h3>
                     <p>
                       <?php echo e($why_card_three_heading_caption); ?>

                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 benefit-item">
               <div class="benefit-card row">
                  <div class="benefit-icon col-xs-2">
                     <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/negobot.png">
                  </div>
                  <div class="benefit-content col-xs-10">
                     <h3>
                       <?php echo e($why_card_four_heading); ?>

                     </h3>
                     <p>
                        <?php echo e($why_card_four_heading_caption); ?>

                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /Our Expertise -->
</main>

<!-- footer -->
<?php echo $__env->make( 'partials.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>