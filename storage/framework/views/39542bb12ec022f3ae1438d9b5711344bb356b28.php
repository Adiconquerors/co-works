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
                            <div class="breadcrumb p-0 m-0">
                                
                                    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                                    </i>
                                    <?php echo e(ucwords( $title )); ?></a>
                               
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
                                            <th><?php echo app('translator')->getFromJson('custom.users.name'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.currency'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.users.email'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.users.role'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.users.mobile'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                             <?php
                                                $user_role    = \App\Role::find($item->role_id);
                                                $image = $item->image;
                                                $listings_count = \App\Property::where('customer_id', $item->id)->count();    
                                            ?>
                         
                                        <tr>
                                      
                                            <td><?php echo e($item->name); ?> </td>

                                            <td><?php echo e($item->currency->name); ?> </td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e($user_role ? $user_role->name : '-'); ?></td>
                                            <td><?php echo e($item->mobile); ?></td>

                                            <td class="actions STY_inline">
                                                    <a href="<?php echo e(route('users.show',$item->id)); ?>" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>
                                                   
                                                    <a href="<?php echo e(route( 'users.edit',$item->id )); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >         
                                             <?php echo Form::open([
                                                'method'=>'delete',
                                                'route' =>['users.destroy',$item->id],
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

                                     <?php echo $__env->make('admin.common.delete-script',['users.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

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