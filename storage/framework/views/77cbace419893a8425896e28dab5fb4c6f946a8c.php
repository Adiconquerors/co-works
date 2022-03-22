<?php $__env->startSection( 'new_content' ); ?>
<style>
  .sty-flex{
    display: flex;
  }
  .sty-mtfs{
    margin-top: 5px; font size: 13px;
  }

  ul.dtr-details {
    display: grid !important;
    grid-template-columns: auto auto auto;
    grid-gap: 10px;
}

.dtr-details li {
    padding: 10px !important;
    border: 1px solid #ccc !important;
}
.td_m td ul li {
    padding: 0px;
    margin: 0px !important;
    list-style-type: none !important;
}

</style>
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="sty-flex">
        <div class="col-sm-6 col-md-6">
          <div class="form-group">
            <label class="control-label sty-mtfs">
              <?php echo app('translator')->getFromJson('custom.dealtracker.deal-completed'); ?>
            </label>
          </div>
        </div>

      </div>

    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- end row -->

<div class="card">
  <div class="card-body" id="EnquireList">
    <?php echo $__env->make('admin.enquires.dealtracker.dealtracker-deal-completed-list',compact( $items ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

<?php echo $__env->make('admin.enquires.modal-loading', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'new_admin_js_scripts' ); ?>

<?php echo $__env->make('admin.enquires.scripts.formscripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function () {
        "use strict";
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault(); // Disable the " Entry " key
                return false;
            }
        });
    });
</script>

<script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>pages/jquery.datatables.editable.init.js"></script>

<script>
  $(document).ready(function() {
    "use strict";
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
      keys: true
    });
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
    var table = $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>