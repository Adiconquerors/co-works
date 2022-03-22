<?php $__env->startSection( 'new_admin_head_links' ); ?>
   <?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
<style>
.table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
}
</style>
       <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">
                                <?php echo app('translator')->getFromJson('global.sms-gateways.title'); ?>
                            </h4>
                            <div class="breadcrumb p-0 m-0">

                                    <a href="<?php echo e(route('admin.sms_gateways.create')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                                    </i>
                                    <?php echo app('translator')->getFromJson('global.app_add_new'); ?></a>

                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                        </div>
                    </div>

                <!-- table -->
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('global.sms-gateways.fields.name'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.sms-gateways.fields.key'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.sms-gateways.fields.description'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.membershipfees.actions'); ?></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                          <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>

                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->key); ?></td>
                                            <td><?php echo e($item->description); ?></td>

                                            <td class="actions">

                                                    <a href="<?php echo e(route( 'admin.sms_gateways.edit',$item->id )); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >
                                             <?php echo Form::open([
                                                'method'=>'delete',
                                                'route' =>['admin.sms_gateways.destroy',$item->id],
                                                'onclick'=>'return checkDelete();'
                                                ]); ?>


                                                <button type="submit" class="on-default remove-row">
                                                   <i class="far fa-trash-alt"></i>
                                                </button>

                                                <?php echo Form::close(); ?>

                                        	</a>
                                            </td>

                                        </tr>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>



                <!-- end Table -->
<?php $__env->stopSection(); ?>

    <?php $__env->startSection( 'new_admin_js_scripts' ); ?>
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
                    //ajax: "<?php echo e(route( 'articles.index' )); ?>",
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

    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>