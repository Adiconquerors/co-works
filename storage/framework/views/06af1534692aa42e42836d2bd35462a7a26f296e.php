<?php $__env->startSection( 'new_admin_head_links' ); ?>
   
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
                                <?php echo e(ucwords( $active_class )); ?>

                            </h4>
                            <div class="breadcrumb p-0 m-0">
                                    <?php if(  env('APP_DEV') ): ?> 
                                    <a href="<?php echo e(route('templates.create')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                                    </i>
                                    <?php echo e(ucwords( $title )); ?>

                                </a>
                                <?php endif; ?>
                               
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
                                            
                                            <th><?php echo app('translator')->getFromJson('custom.templates.key'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.templates.type'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.templates.subject'); ?></th>
                                        
                                            <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                          
                         
                                        <tr>

                                            
                                            <td><?php echo e($item->key); ?></td>
                                            <td><?php echo e($item->type); ?></td>
                                            <td><?php echo e($item->subject); ?></td>

 
                                            <td class="actions">
                                                    <a href="<?php echo e(route('templates.show',$item->id)); ?>" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>
                                                   
                                                    <a href="<?php echo e(route( 'templates.edit',$item->id )); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                             <?php if(  env('APP_DEV') ): ?>              
                                                 <?php if( isAdmin() ): ?> 

                                                    <a href="<?php echo e(route( 'templates.duplicate',$item->id )); ?>" class="on-default edit-row" title="duplicate"><i class="fa fa-files-o"></i></a>
                                               
                                           <a  href="javascript:void(0);" >         
                                             <?php echo Form::open([
                                                'method'=>'delete',
                                                'route' =>['templates.destroy',$item->id],
                                                'onclick'=>'return checkDelete();'
                                                ]); ?>

                                                
                                                <button type="submit" class="on-default remove-row">
                                                   <i class="far fa-trash-alt"></i> 
                                                </button>

                                                <?php echo Form::close(); ?> 
                                            </a>
                                           <?php endif; ?>
                                         <?php endif; ?>      
                                                </td>

                                        </tr>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            
                                        </tbody>
                                    </table>

                                     <?php echo $__env->make('admin.common.delete-script',['templates.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

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