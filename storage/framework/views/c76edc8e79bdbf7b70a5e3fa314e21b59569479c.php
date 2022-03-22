    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
          
      ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($site_favicon_im); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($site_favicon_im); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($site_favicon_im); ?>">
    
    <meta name="theme-color" content="#1e3144">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- title -->
    <title><?php echo e(getSetting('site_title', 'site_settings')); ?></title>
    <meta name="description" content="">
      
      <?php echo $__env->yieldContent( 'main_heads' ); ?> 

    <link href="<?php echo e(PUBLIC_ASSETS); ?>css/Login-register-modal.css" rel="stylesheet">
    <link href="<?php echo e(PUBLIC_ASSETS); ?>css/component.css" rel="stylesheet">
    <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/font-awesome.css" rel="stylesheet">
    <link href="<?php echo e(PUBLIC_ASSETS); ?>css/project2-style.css" rel="stylesheet">
    <link href="<?php echo e(PUBLIC_ASSETS); ?>css/simple-line-icons.css" rel="stylesheet">
    
     <!-- infographics -->   
     <link rel="stylesheet" href="<?php echo e(PUBLIC_ASSETS); ?>css/info-style.css" />
     <link rel="stylesheet" href="<?php echo e(PUBLIC_ASSETS); ?>css/aos.css"/>

     <script type="text/javascript">
        var baseurl = '<?php echo e(url('/')); ?>';
        var crsf_hash = '<?php echo e(csrf_token()); ?>';
        var prefix1 = '<?php echo e(PREFIX1); ?>';
    </script>


    <?php echo $__env->yieldContent( 'main_head_links' ); ?>

  
 
    <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-65415661-1');
    jQuery(document).ready(function($){
        $(window).scroll(function(){
          var sticky = $('.navbar-fixed-top'),
              scroll = $(window).scrollTop();

          if (scroll >= 100 ) sticky.addClass('fixed');
          else sticky.removeClass('fixed');


        });
      });
    </script>
     <?php echo $__env->yieldContent( 'main_header_scripts' ); ?>
     
   <style>
   .home:before{
    background: transparent;
   }
   </style>

   <?php echo $__env->yieldContent( 'main_header_styles' ); ?>