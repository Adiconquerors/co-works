<?php $__env->startSection( 'new_admin_head_links' ); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>

<?php if( isAdmin() || isAgent() ): ?>
<div class="row">
  <div class="col-sm-12">
    <?php echo $__env->make('admin.leads.filters.leads-filters',array('items'=>$items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
</div>
<?php endif; ?>

<!-- table -->
<div class="row">
 <div class="col-sm-12" id="DealStatusList">
    <?php echo $__env->make('admin.leads.lead-list',array('items'=>$items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 </div>
</div>
            <!-- end Table -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?>  
 
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
    $(document).on('click', '#DealStatusSearch', function(e) {
      e.preventDefault();
      $('#DealStatusList').val('');

      var _token = $("input[name='_token']").val();

      var deal_status = $("#deal_status").val();

      $.ajax({
        url: '<?php echo e(route("leads.dealstatusfilter")); ?>',
        type: 'POST',
        data: {
          _token: _token,
          deal_status: deal_status
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#DealStatusList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->

<?php $__env->stopSection(); ?>       


<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>