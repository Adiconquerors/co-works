    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" >

       <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
      ?>
      
     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($site_favicon_im); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($site_favicon_im); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($site_favicon_im); ?>">
  
      <meta name="theme-color" content="#1e3144">
      
      <!-- title -->
      <title><?php echo e(getSetting('site_title', 'site_settings')); ?></title>
      <meta name="description" content="">

      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/maps-login-modal.css" rel="stylesheet">
      
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/font-awesome.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/simple-line-icons.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/jquery-ui.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/bootstrap-notify.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css/newdatepicker.css" rel="stylesheet">

      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/compare.css" rel="stylesheet">

      <?php if( ! empty( $direction ) && 'rtl' === $direction): ?>
      <link href="<?php echo e(PREFIX1); ?>css/rtl.css" rel="stylesheet">
      <?php endif; ?>
      <?php echo $__env->yieldContent( 'main_two_header_links' ); ?>
      <style>
         .nav-pills > li.active > a, .no-touch .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
         color: #333;
         background-color:#c1ab77;
         }
         .nav-justified > li > a {
         margin-bottom: 0;
         border: 1px solid #c1ab77;
         border-radius: 0;
         color: #333;
         }
        .cd-user-modal-container .cd-switcher a.selected {
            background: #FFF !important;
            color: #40c8f4 !important;
            border-bottom: 2px solid #40c8f4 !important;
            text-decoration: none !important;
        }
      </style>

    <script type="text/javascript">
        var baseurl = '<?php echo e(url('/')); ?>';
        var crsf_hash = '<?php echo e(csrf_token()); ?>';
        var prefix1 = '<?php echo e(PREFIX1); ?>';
    </script>
   <?php echo $__env->yieldContent( 'main_two_header_styles' ); ?>
   <?php echo $__env->yieldContent( 'main_two_header_scripts' ); ?>