<script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/migrates/migrate.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery-ui-touch-punch.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.cookie.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.placeholder.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/bootstrap.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.touchSwipe.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/jquery.visible.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/blog.js" type="text/javascript"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		"use strict";
		$('.top-blog-search').change();
	});

	$( function() {
	    function log( message ) {
	      $( "<div>" ).text( message ).prependTo( "#log" );
	      $( "#log" ).scrollTop( 0 );
	    }

	    $( ".top-blog-search" ).autocomplete({
	      source: function(request, response) {
		        $.ajax({
		            url: "<?php echo e(route('blog.search.ajax')); ?>",
		            dataType: "json",
		            method: 'post',
		            data: {
		                term : request.term,
		                _token : "<?php echo e(csrf_token()); ?>"
		            },
		            success: function(data) {
		                response(data);
		            }
		        });
		    },
	      //method:'post',
	      minLength: 2,
	      select: function( event, ui ) {
	        log( "Selected: " + ui.item.value + " aka " + ui.item.id );
	        console.log(ui);
	        window.location = '<?php echo e(url("blog-article")); ?>/' + ui.item.value;
	      }
	    });
	  } );
</script>

<?php $loader = LOADER; ?>
<!-- Subscribe to news letter -->
  <script  type="text/javascript">
  	jQuery(document).ready(function($) {
    "use strict";

    $(document).on('submit', '#suscribe_to_news_letter', function(e) {
      e.preventDefault();
      var _token = $("input[name='_token']").val();
      var email = $("#blog_subscribe_email").val();
       var image = "<?php echo e($loader); ?>";
       $('#subscribe_loader').html("<img src='" + image + "' />");

      $.ajax({
        url: "<?php echo e(route('blog.subscribenewsletter')); ?>",
        type: 'POST',
        data: {
          _token: _token,
          email: email,
        },
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
          	$('#subscribe_loader').html("").hide();
            alert(data.success);
            $("#blog_subscribe_email").val('');
          }else{
            alert(data.not_found);
          }
        }
      });

    });
});

</script>
