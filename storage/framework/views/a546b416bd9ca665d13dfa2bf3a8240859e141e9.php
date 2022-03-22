<?php $__env->startSection( 'new_content' ); ?>
<style>
 .table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
 }
 .sty-br{
    border-radius:10px;
 }
</style>
   <div class="row">
     <div class="col-12">
         <div class="page-title-box">
             <h4 class="page-title">
               <?php echo app('translator')->getFromJson('custom.spacetypes.space-types'); ?>
             </h4>
              <?php if( env('DEV_SPACETYPE') ): ?> 
             <div class="breadcrumb p-0 m-0">
                 
                     <a href="<?php echo e(route('space_types.create')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                     </i>
                     <?php echo e(ucwords( $title )); ?></a>
                
             </div>
             <?php endif; ?>
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
                    
                    <th><?php echo app('translator')->getFromJson('custom.spacetypes.name'); ?></th>
                    <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
                </tr>
                </thead>


                <tbody>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php
                        $image = $item->image;
                    ?>
    
                <tr>
                     
                 
                    <td><a href="<?php echo e(route( 'space-types.index', $item->id )); ?>"><?php echo e($item->name); ?></a></td>

                 
                    
                    <td class="actions">
                           
                            <a href="<?php echo e(route('space-types.mainedit',$item->slug)); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                            <?php
                              $app_debug = env('APP_DEBUG');
                            ?>
                  <?php if(  $app_debug == TRUE ): ?>         
                   <a  href="javascript:void(0);" >         
                     <?php echo Form::open([
                        'method'=>'delete',
                        'route' =>['space_types.destroy',$item->slug],
                        'onclick'=>'return checkDelete();'
                        ]); ?>

                        
                        <button type="submit" class="on-default remove-row">
                           <i class="far fa-trash-alt"></i> 
                        </button>

                        <?php echo Form::close(); ?> 
                    </a>
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