<?php $__env->startSection( 'main_two_header_styles' ); ?>
<style>
   .cd-user-modal-container .cd-switcher li {
      width: 48%;
      float: left;
      text-align: center;
      list-style-type:none;
   }

input[type="checkbox"] {
    display: block !important;

}

.cd-user-modal-container .cd-switcher a.selected {
    background: #FFF !important;
    color: #40c8f4 !important;;
    border-bottom: 2px solid #40c8f4 !important;
    text-decoration: none !important;
}

input[type=checkbox], input[type=radio] {
 width: auto;
}

</style>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'content_two' ); ?>

<?php echo $__env->make( 'home-pages.common.head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="content">
 <?php echo $__env->make('home-pages.explore-filters', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <div class="resultsList" id="resultsList">
 <?php echo $__env->make('home-pages.explore-list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 </div>
<?php echo $__env->make( 'home-pages.common.login-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="clearfix "></div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('main_two_javascripts_links'); ?>

<script type="text/javascript">
    function fetchData(loc, wstype, clear) {
        
        $('#excludefilters').val('');
        $('#resultsList').html('<img src="<?php echo e(PUBLIC_ASSETS); ?>images/loading.gif">');
        if ( typeof( clear ) === 'undefined' ) {
            clear = 'no';
        }

        $('#wstype').val( wstype );

        $('.subspacetypefilterbutton').hide();

        $('.spacetype').removeClass('active');
        $('.spacetype_' + wstype).addClass('active');
        $('.subspacetype_' + wstype).show();
        $('.clearFilters').show();

        var excludefilters = $('#excludefilters').val();
        var filter_available_date = $('#filter_available_date').val();
        var filter_months = $('#filter_months').val();
        var filter_seats = $('#filter_seats').val();
        var price_range_start = $('#price_range_start').val();
        var price_range_end = $('#price_range_end').val();

        $.ajax({
            url: '<?php echo e(route("properties.list")); ?>',
            type:'POST',
            data: { 
                location: loc, 
                wstype: wstype, 
                excludefilters: excludefilters,

                filter_available_date: filter_available_date,
                filter_months: filter_months,
                filter_seats: filter_seats,
                price_range_start: price_range_start,
                price_range_end: price_range_end,
                requestfrom: 'filter'
            },
            success: function(data) {
             $('#resultsList').html( data );
            }
        });
    }

    function fetchDataPoints( displayingMarkers )
    {
        
        if ( displayingMarkers.length == 0 ) {
            displayingMarkers = 'empty';
        }

        $('#resultsList').html('<img src="<?php echo e(PUBLIC_ASSETS); ?>images/loading.gif">');

        var loc = $('#search_property').val();
        var wstype = $('#wstype').val();
        var excludefilters = $('#excludefilters').val();
        var filter_available_date = $('#filter_available_date').val();
        var filter_months = $('#filter_months').val();
        var filter_seats = $('#filter_seats').val();
        var price_range_start = $('#price_range_start').val();
        var price_range_end = $('#price_range_end').val();

        $.ajax({
            url: '<?php echo e(route("properties.list")); ?>',
            type:'POST',
            data: { 
                displayingMarkers: displayingMarkers,

                location: loc, 
                wstype: wstype,
                filter_available_date: filter_available_date,
                filter_months: filter_months,
                filter_seats: filter_seats,
                price_range_start: price_range_start,
                price_range_end: price_range_end
            },
            success: function(data) {
                $('#resultsList').html( data );
            }
        });
        
    }
    $(document).on("click", '.subtypefilterclear', function(event) { 
        $(this).closest('button').slideUp();

        var subtype_id = $(this).data('subtype_id');
        var loc = $(this).data('location');
        var wstype = $(this).data('wstype');
        var filter_type = $(this).data('filter_type');
        
        console.log(subtype_id);
        var excludefilters = $('#excludefilters').val();
        if ( excludefilters == '' && subtype_id != '' ) {
            excludefilters = subtype_id;
        } else {
            if ( subtype_id != '' ) {
                excludefilters = excludefilters + ',' + subtype_id;
            }
        }

        var totalsubtypes = $('.subspacetype_' + wstype).length;
        var totalfiltered = 0;
        if ( excludefilters != '' ) {
            
        }
        if ( totalsubtypes == totalfiltered ) { // If user deselect all subtpes!
            excludefilters= '';
        }

        $('#excludefilters').val( excludefilters );
        var filterscount = $('#excludefilters').length;
        if ( filterscount == 0 ) {
            $('.clearFilters').slideUp();
        }
        
        

        if ( filter_type == 'available_date' ) {
            $('#filter_available_date').val('');
        }
        if ( filter_type == 'months' ) {
            $('#filter_months').val('');
        }
        if ( filter_type == 'seats' ) {
            $('#filter_seats').val('');
        }
        if ( filter_type == 'price_range' ) {
            $('#price_range_start').val('');
            $('#price_range_end').val('');
        }
        var filter_available_date = $('#filter_available_date').val();        
        var filter_months = $('#filter_months').val();        
        var filter_seats = $('#filter_seats').val();        
        var price_range_start = $('#price_range_start').val();
        var price_range_end = $('#price_range_end').val();                
        
        $.ajax({
            url: '<?php echo e(route("properties.list")); ?>',
            type:'POST',
            data: {
                location: loc, 
                wstype: wstype, 
                excludefilters: excludefilters,

                filter_available_date: filter_available_date,
                filter_months: filter_months,
                filter_seats: filter_seats,
                price_range_start: price_range_start,
                price_range_end: price_range_end,
                requestfrom: 'filter'
            },
            success: function(data) {
             $('#resultsList').html( data );
            },
            error: function (jqXHR, exception) {
                console.log( jqXHR.responseText );
            }
        });
        
        
    });

    $(document).on("click", '.clearFilters', function(event) { 
        $('.filterbutton').slideUp();
        $(this).slideUp();

        var loc = $(this).data('location');
        var wstype = $(this).data('wstype');

        $('#excludefilters').val('');
        $('#filter_available_date').val('');
        $('#filter_months').val('');
        $('#filter_seats').val('');
        $('#price_range_start').val('');
        $('#price_range_end').val('');

        fetchData( loc, wstype, 'yes');
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main_two' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>