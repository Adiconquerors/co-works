<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/font-awesome.css" rel="stylesheet">
 	 <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
          
      ?>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($site_favicon_im); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($site_favicon_im); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($site_favicon_im); ?>">

 <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	
<title><?php echo e(getSetting('site_title', 'site_settings')); ?></title>	

<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/bootstrap.css" rel="stylesheet">
<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/app.css" rel="stylesheet" id="app">
<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/jquery-ui.css" rel="stylesheet" id="jquery-ui">
    <script type="text/javascript">
        var baseurl = '<?php echo e(url('/')); ?>';
        var crsf_hash = '<?php echo e(csrf_token()); ?>';
        var prefix1 = '<?php echo e(PREFIX1); ?>';
    </script>
<?php if( ! empty( $direction ) && 'rtl' === $direction): ?>
<link href="<?php echo e(PREFIX1); ?>css/rtl.css" rel="stylesheet">
<?php endif; ?>