<!DOCTYPE html>
<html lang="en">
   <head>
   <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" >
      
     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')); ?>">
  
      <meta name="theme-color" content="#1e3144">
      
      <!-- title -->
      <title><?php echo e(getSetting('site_title', 'site_settings')); ?></title>
      <meta name="description" content="">

      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/maps-login-modal.css" rel="stylesheet">
      
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/font-awesome.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/simple-line-icons.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/jquery-ui.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/bootstrap-notify.css" rel="stylesheet">
      <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/datepicker.css" rel="stylesheet">
      

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
      <style>
        .sty-mr200{
         visibility: hidden;

        }
      </style>
   </head>

    <body class="notransition">

	    <div id="header">

          <div class="headerpromoWraper">
          <!-- backbtn -->
          <div class="backBtn ">
          <span class="line tLine"></span>
          <span class="line mLine"></span>
          <a href="<?php echo e(route( 'properties.index' )); ?>"><span class="label-back" ><b><?php echo app('translator')->getFromJson('custom.eforms.back'); ?></b></span></a>
          <span class="line bLine"></span>
          </div>
        <!-- /backbtn -->
        <button class="btn btn-promo blink sty-mr200"  type="submit">
        <span class="fa fa-gift fa-1x"> <b><?php echo app('translator')->getFromJson('main.home.upto-cashback'); ?></b></span>
        </button>
     </div>
       
      </div>

 <div id="wrapper">
	<div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span><?php echo app('translator')->getFromJson('custom.eforms.loading-map'); ?></div></div>  	
	 <?php echo $__env->yieldContent( 'content_two' ); ?>
  </div>
    
    <?php
    $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );
    $days = \App\Day::get();
 ?>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script> 
      
     
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/maps-login-modal-script.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/modernizr/2.8.3/modernizr.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/bootstrap/bootstrap337/bootstrap.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($google_api_key); ?>&libraries=geometry,places">
        </script>
        <script>
                    // highlight current day on opeining hours
                    $(document).ready(function() {
                    $('.opening-hours li').eq(new Date().getDay()).addClass('today');
                    });


                    // datetimepicker

                            $(function () {
                            $('#datetimepicker1').datetimepicker({
                            
                            format: 'YYYY/MM/DD'
                            });
                            });

                        $(function () {
                            $('#datetimepicker2').datetimepicker({
                                format: 'LT'
                            });
                        });

                        $(function () {
                            $('#datetimepicker3').datetimepicker({
                                format: 'LT'
                            });
                        });

                        <?php if( ! empty( $days ) ): ?>
                          <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            $(function () {
                                $('#datetimepicker<?php echo e($day->id); ?>from').datetimepicker({
                                    format: 'LT'
                                });
                            });

                            $(function () {
                                $('#datetimepicker<?php echo e($day->id); ?>to').datetimepicker({
                                    format: 'LT'
                                });
                            });
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

          </script>


           

            <!-- end notifyme -->

      

      <?php echo $__env->yieldContent( 'main_two_javascripts' ); ?>
      
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/bootstrap-notify.min.js"></script>
      
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui-touch-punch.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.cookie.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.placeholder.js"></script>
    
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.touchSwipe.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.slimscroll.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.visible.js"></script>
        
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/infobox.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.tagsinput.min.js"></script>

     <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/moment/2.9.0/moment-with-locales.js"></script>

     <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/rawgit/Eonasdan/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
    
  

<?php echo $__env->make('home-pages.common.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<!-- notifyme -->

      <script type="text/javascript">
      /**
      * type: info, success, danger
      */
      function notifyMe( type, message ) {
      

      if ( type == '' ) {
          type = 'success';
      }
      if ( message == '' ) {
          message = 'Something went wrong!';
      }

      var title = 'failed';
      var icon = 'glyphicon glyphicon-warning-sign';
      if ( type == 'success' ) {
          title = 'Success';
          icon = 'glyphicon glyphicon-success-sign';
      }
      if ( type == 'info' ) {
          title = 'Info';
          icon = 'glyphicon glyphicon-info-sign';
      }

      
        $.notify({
            // options
            title: title,
            message: message,
            icon: icon
        },{
            // settings
            type: type,
            showProgressbar: true,
            delay: 1000,
            newest_on_top: true,
            animate: {
                enter: 'animated lightSpeedIn',
                exit: 'animated lightSpeedOut'
            }

        });

        
      }

      </script>

      <?php echo $__env->yieldContent( 'main_two_javascripts_links' ); ?>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/compare.js"></script>

    <?php echo $__env->make('home-pages.scripts.common-login-modal-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    
    </body>

</html>