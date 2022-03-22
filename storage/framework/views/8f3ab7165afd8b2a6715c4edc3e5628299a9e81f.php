<?php $__env->startSection( 'new_admin_head_links' ); ?>
   <?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
<style>
.table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
}
.sty-br{
    border-radius: 10px;
}
</style>
   <div class="row">
     <div class="col-12">
         <div class="page-title-box">
             <h4 class="page-title">
                Sub Space Types
             </h4>
             <div class="breadcrumb p-0 m-0">
                 
                     <a href="<?php echo e(route('space_types.index')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
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
            <table id="datatables" class="table table-striped table-bordered dt-responsive nowrap table-collapse" >
                <thead>
                <tr>
                    <th><?php echo app('translator')->getFromJson('custom.spacetypes.image'); ?></th>
                    <th><?php echo app('translator')->getFromJson('custom.spacetypes.sub-space-type'); ?></th>
                    <th><?php echo app('translator')->getFromJson('custom.eforms.description'); ?></th>
                     <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
                </tr>
                </thead>


                <tbody>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php
                      $parents = \App\SpaceType::find($item->parent_id); 
                      $image = $item->image;
                       $default_path = getDefaultimgagepath($image,'space-types');
                    ?>
        
                <tr>
                    
                     <td>
                        <a href="javascript:void(0);">
                        <img src="<?php echo e($default_path); ?>" width="100" height="70" class="sty-br"> 
                        </a>
                       </td>   
                 
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->des_one); ?></td>
    
                    <td class="actions">
                       <?php if( ! empty( $item->parent_id ) ): ?>
                           
                            <a href="<?php echo e(route('space_types.edit',$item->slug,$item->parent_id)); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                
                <?php endif; ?>
                       
                        </td>

                </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
    
                </tbody>
            </table>

             <?php echo $__env->make('admin.common.delete-script',['space_types.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

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