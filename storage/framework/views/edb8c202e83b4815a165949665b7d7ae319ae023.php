
<script>
  window.utilsUrl = "<?php echo e(PUBLIC_ASSETS); ?>js/utils.homepage.js";
</script>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js/modernizr/2.8.3/modernizr.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js/app.homepage.js"></script>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js/font-awesome/use-fontawesome.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js/Login-modal-script.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js/select2.full.min.js"></script>

<?php echo $__env->make('home-pages.scripts.common-login-modal-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


  <!-- Scripts -->
    <!-- sidebar -->
    <script src="<?php echo e(PUBLIC_ASSETS); ?>js/classie.js"></script>
    <script src="<?php echo e(PUBLIC_ASSETS); ?>js/gnmenu.js"></script>
        <script>

        $('.gn-icon-menu').hover(function(){
          $('.gn-menu-wrapper').toggleClass('gn-open-part');
        });


         $('.gn-icon-menu').click(function() {

          $(this).toggleClass('gn-open-all');

          $(".navbar-right").css("display", "none");
          $(".navbar-brand").css("display", "none");


          $(".fixed").css('background-color', 'transparent !important');


        });

        $(".home").click(function() {
            $(".navbar-right").css("display", "block");
            $(".navbar-brand").css("display", "block");

            $(".fixed").css('background-color', '#fff !important');

        });
    </script>

        <script>
            new gnMenu( document.getElementById( 'gn-menu' ) );
        </script>
        <!-- sidebar -->


  <script>
$(document).ready(function(){
    "use strict";

    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
<!-- /Slider -->

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
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatItem,
            templateSelection: formatItemSelection,
            placeholder : 'Search...'

        });
        function formatItem (item) {
            if (item.loading) {
                return 'Searching...';
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
                return 'Search...';
            }
            return item.model;
        }
        $(document).delegate('.searchable-link', 'click', function() {
            let url = $(this).attr('href');
            window.location = url;
        });
    });


</script>
 <?php echo $__env->yieldContent( 'main_javascripts' ); ?>

