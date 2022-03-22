<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
<style>
  .sty-df{
      display: flex;
  }
  .sty-mtfs{
    margin-top: 5px; font size: 13px;
  }
</style>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="sty-df">
            <div class="col-sm-6 col-md-6">
               <div class="form-group">
                  <label class="control-label sty-mtfs">
                    <?php echo app('translator')->getFromJson('custom.paymenthistory.unpaid-invoices'); ?>
                  </label>
               </div>
            </div>
 
         </div>
      
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<!-- end row -->
<?php if( isAdmin() ): ?>
<div class="row">
  <div class="col-sm-12">
   <?php echo $__env->make('admin.common.payment-filters',array('route'=>['unpaid.invoices']),compact($items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>
<?php endif; ?>

<div class="card">
   <div class="card-body">
      <?php echo $__env->make('admin.invoices.unpaid-list',compact( $items ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </div>
</div>

<?php echo $__env->make('admin.invoices.modal-loading', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?>

<?php echo $__env->make('admin.invoices.scripts.formscripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>pages/jquery.datatables.editable.init.js"></script>
<?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-script-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
            TableManageButtons.init();

        </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>