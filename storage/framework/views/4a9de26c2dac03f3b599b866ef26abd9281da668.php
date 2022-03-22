<?php $__env->startSection( 'new_content' ); ?>
<div class="row" >
<div class="col-12">
    <div class="page-title-box">
        <h4 class="page-title">
            <?php echo e(ucwords( $active_class )); ?>

        </h4>
      
        <div class="clearfix">
        </div>
    </div>
    </div>
</div>

 <div class="row text-center">
  <div class="col-sm-12">
    <h3 class="m-t-20">
      <?php echo app('translator')->getFromJson('custom.eforms.search'); ?> 
    </h3>
    <div class="border mx-auto d-block m-b-20"></div>
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">
    <?php echo $__env->make('admin.venues.filters.venue-filter', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>
<!-- end row -->
    <!-- table -->
         <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive" id="VenueList">
                     <?php echo $__env->make('admin.venues.venue-list',compact( $items ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>

                   

                <!-- end Table -->
<?php $__env->stopSection(); ?>

    <?php $__env->startSection( 'new_admin_js_scripts' ); ?>
     <?php echo $__env->make('home-pages.common.autocomplete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
     
        <script>
            $(document).ready(function () {
              "use strict";
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    //ajax: "<?php echo e(route( 'venues.index' )); ?>",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            
        </script>

        <!-- filters -->
<script>
  $(document).ready(function() {
    "use strict";

    $(document).on('click', '#venueSearch', function(e) {
      e.preventDefault();
      $('#VenueList').val('');

      var _token = $("input[name='_token']").val();

      var property_name = $("#property_name").val();
      var property_address = $("#property_address").val();
      var manager_name = $("#manager_name").val();
      var manager_email = $("#manager_email").val();
      var manager_phone = $("#manager_phone").val();

      $.ajax({
        url: '<?php echo e(route("venues.filter")); ?>',
        type: 'POST',
        data: {
          _token: _token,
          property_name: property_name,
          property_address: property_address,
          manager_name: manager_name,
          manager_email: manager_email,
          manager_phone: manager_phone,
          
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#VenueList').html(data);

          } else {
            alert("<?php echo e(trans('others.went-wrong')); ?>");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->

    <?php $__env->stopSection(); ?>       
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>