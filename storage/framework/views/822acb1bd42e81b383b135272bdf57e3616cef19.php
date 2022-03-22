<?php $__env->startSection( 'new_admin_head_links' ); ?>
    <style>
    .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
    }
    .sty-br{
        border-radius: 10px;
    }
    .dtr-data{
        display: inline-flex;
        padding-left: 2px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>

       <div class="row">
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

                <!-- table -->
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.module'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.key'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.settings.moduletype'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.description'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          <?php $__currentLoopData = $master_setting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            
                                        <tr>
                                      
                                            <td><?php echo e($item->module); ?> </td>

                                            <td><?php echo e($item->key); ?> </td>
                                            <td><?php echo e($item->description); ?></td>
                                            <td><?php echo e($item->moduletype); ?></td>

                                            <td>
                                                    <a href="<?php echo e(url('admin/mastersettings/settings/view', $item->slug)); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('global.app_settings'); ?></a>
                                                        
                                                    <?php
                                                        $master_edit = $item->id;
                                                        $medit = url("admin/master_settings/".$master_edit."/edit");
                                                    ?>   

                                                    <a href="<?php echo e($medit); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>

                                      

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

    <?php $__env->stopSection(); ?>       


<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>