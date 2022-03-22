 <?php
    $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );
    $days = \App\Day::get();
 ?>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>

      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/bootstrap/bootstrap337/bootstrap.min.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/maps-login-modal-script.js"></script>
      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/modernizr/2.8.3/modernizr.min.js"></script>
      <script async defer src="//maps.googleapis.com/maps/api/js?key=<?php echo e($google_api_key); ?>&libraries=geometry,places">
        </script>

              <script>
                    // highlight current day on opeining hours
                    $(document).ready(function() {
                    $('.opening-hours li').eq(new Date().getDay()).addClass('today');
                    });



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

      <script src="<?php echo e(PUBLIC_ASSETS); ?>js/bootstrap-datepicker.js"></script>






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

