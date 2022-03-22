
        <script>
            var resizefunc = [];
        </script>

        <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>
         <script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/migrates/migrate.min.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/detect.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/fastclick.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jquery.blockUI.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/waves.js"></script> <!-- related to left side top bars toggle btn -->
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jquery.slimscroll.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>switchery/switchery.min.js"></script>

         <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/bootstrap-notify.min.js"></script>

         <!-- Select2 -->
    <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/select2.full.min.js"></script>

        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/sweetalert-dev.js"></script>

         <script type="text/javascript" src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/bootstrap-datepicker/1.4.1/bootstrap-datepicker.min.js"></script>


        <!-- COunter Up  -->
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>waypoints/jquery.waypoints.min.js"></script>
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>counterup/jquery.counterup.min.js"></script>

        <!-- client side form validation -->
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>parsleyjs/parsley.min.js"></script>

        <!-- Bootstrap select js -->
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>bootstrap-select/js/bootstrap-select.min.js"></script>

         <!-- dropify js -->
        <script src="<?php echo e(PUBLIC_PLUGINS_NEW_ADMIN); ?>dropify/js/dropify.min.js"></script>

        <!-- page specific js -->
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>pages/jquery.property-add.init.js"></script>


        <!-- App js -->
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jquery.core.js"></script>
        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jquery.app.js"></script><!-- related to left side top bars toggle btn -->

        <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>js/jqueryui/1.11.4/jquery-ui.min.js"></script>
   

        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/jquery.dataTables.min.js"></script>

        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/dataTables.buttons.min.js"></script>

        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/buttons.flash.min.js"></script>

        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/jszip.min.js"></script>

        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/pdfmake.min.js"></script>
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/vfs_fonts.js"></script>

        <!-- datatables -->
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/buttons.print.min.js"></script>
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/buttons.colVis.min.js"></script>
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/dataTables.select.min.js"></script>
        <script src="<?php echo e(PREFIX1); ?>js/cdn-js-files/datatables/dataTables.responsive.min.js"></script>
        <!--end datatables -->

        <script src="<?php echo e(PREFIX1); ?>js/main.js"></script>

         <?php echo $__env->yieldContent( 'new_admin_js_scripts' ); ?>

      <script>
            //Right sliding form open/close
            $(document).ready(function(){
                "use strict";
            $("#OpenForm-visits").on('click', function () {
            $(".feedback_form_area-visits").animate({
            width: "toggle"
            });
            });
            $("#OpenForm-shortlist").on('click', function () {
            $(".feedback_form_area-shortlist").animate({
            width: "toggle"
            });
            });
            });

            //right slider individual cards close
            $('.close-icon1').on('click',function() {
            $(this).closest('.card-body-shortlist').fadeOut();
            })

            //right slider individual full-card close
            $('.close-icon2').on('click',function() {
            $(this).closest('.feedback_form_area_inner').fadeOut();
            })



        </script>

         <script>
                  $(".notificationss-menu").on('click', function () {
                  if (!$(this).hasClass('open')) {
                  $('.notifications-menu .label-warning').hide();
                  $.get('internal_notifications/read');
                  }
                  });

               </script>

        <script type="text/javascript">
/**
 * type: info, success, danger
 */
function notifyMe( type, message ) {
    if ( type == '' ) {
        type = 'success';
    }
    if ( message == '' ) {
        message = '<?php echo e(trans("custom.messages.somethiswentwrong")); ?>';
    }

    var title = '<?php echo e(trans("custom.messages.failed")); ?>';
    var icon = 'glyphicon glyphicon-warning-sign';
    if ( type == 'success' ) {
        title = '<?php echo e(trans("custom.messages.success")); ?>';
        icon = 'glyphicon glyphicon-success-sign';
    }
    if ( type == 'info' ) {
        title = '<?php echo e(trans("custom.messages.info")); ?>';
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
        // showProgressbar: true,
        delay: 1000,
        newest_on_top: true,
        animate: {
            enter: 'animated lightSpeedIn',
            exit: 'animated lightSpeedOut'
        }

    });
}
<?php if(Session::has('message')): ?>
<?php
$message_type = getSetting('message_type', 'site_settings', 'onpage');
if ( 'notify' == $message_type ) { ?>
notifyMe("<?php echo e(Session::get('status', 'info')); ?>", "<?php echo e(Session::get('message')); ?>")
<?php } if ( 'sweetalert' == $message_type ) {
    // type: warning, error, success, info
    $type = Session::get('status', 'info');
    if ( 'danger' === $type ) {
        $type = 'error';
    }
    ?>
    swal({
            title: "<?php echo e(Session::get('status', 'info')); ?>",
            text: "<?php echo e(Session::get('message')); ?>",
            type: "<?php echo e($type); ?>",
            timer: 1700,
            showConfirmButton: false
        });
<?php } ?>
 <?php endif; ?>

 /**
 * List of all the available skins
 *
 * @type  Array
 */
var mySkins = [
    'skin-blue',
    'skin-black',
    'skin-red',
    'skin-yellow',
    'skin-purple',
    'skin-green',
    'skin-blue-light',
    'skin-black-light',
    'skin-red-light',
    'skin-yellow-light',
    'skin-purple-light',
    'skin-green-light'
]

<?php
$theme = getSetting( 'theme_color', 'site_settings');
if ( empty( $theme ) ) {
    $theme = 'skin-blue';
}
?>
// changeSkin( '<?php echo e($theme); ?>' );

 /**
 * Replaces the old skin with the new skin
 * @param  String cls the new skin class
 * @returns  Boolean false to prevent link's default action
 */
function changeSkin(cls) {
    $.each(mySkins, function (i) {
        $('body').removeClass(mySkins[i])
    })

    $('body').addClass(cls)
    store('skin', cls)
    return false
}

/**
 * Store a new settings in the browser
 *
 * @param  String name Name of the setting
 * @param  String val Value of the setting
 * @returns  void
 */
function store(name, val) {
    if (typeof (Storage) !== 'undefined') {
        localStorage.setItem(name, val)
    } else {
        window.alert('Please use a modern browser to properly view this template!')
    }
}


function confirmbootbox() {
    alert('You clicked me');
    $( ".confirmbootbox" ).trigger( "click" );
}

</script>

<script>
    $(document).ready(function() {
        "use strict";

        $('.searchable-field').select2({
            minimumInputLength: 3,
            ajax: {
                url: '<?php echo e(route("admin.mega-search")); ?>',
                dataType: 'json',
                type: "GET",
                delay: 200,
                data: function (term) {
                    return {
                        search: term
                    };
                },
                results: function (data) {
                    return {
                        data
                    };
                }
            },
            escapeMarkup: function (markup)
            { return markup; },
            templateResult: formatItem,
            templateSelection: formatItemSelection,
            placeholder : '<?php echo e(trans("others.search")); ?>'

        });
        function formatItem (item) {
            if (item.loading) {
                return '<?php echo e(trans("others.searching")); ?>';
            }
            let markup = "<div class='searchable-link' href='" + item.url + "'>";
            markup += "<div class='searchable-title'>" + item.model + "</div>";
            $.each(item.fields, function(key, field) {
                markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
            });
            markup += "</div>";

            return markup;
        }

        function formatItemSelection (item) {
            if (!item.model) {
                return '<?php echo e(trans("others.search")); ?>';
            }
            return item.model;
        }
        $(document).delegate('.searchable-link', 'click', function() {
            let url = $(this).attr('href');
            window.location = url;
        });
    });


</script>