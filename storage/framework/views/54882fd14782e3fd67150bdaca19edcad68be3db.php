<style>
.table-collapse{
  border-collapse: collapse; border-spacing: 0; width: 100%;
}.dtr-title{
  padding-right:10px;
}
 .maintainht { 
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
</style>
 <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('custom.eforms.property-name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('custom.eforms.property-address'); ?></th>
                            <th><?php echo app('translator')->getFromJson('custom.venues.manager-name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('custom.venues.manager-email'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('custom.venues.manager-phone'); ?></th>
                        </tr>
                        </thead>


                        <tbody>
                          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                             
                        <tr>
                         
                            <td><?php echo e($item->property_name ?? '-'); ?></td>
                            <td title="<?php echo e($item->property_address ?? '-'); ?>"><div class="maintainht"><?php echo e($item->property_address ?? '-'); ?></div></td>
                            <td><?php echo e($item->manager_name ?? '-'); ?></td>
                            <td> <?php echo e($item->manager_email ?? '-'); ?></td>
                            <td> <?php echo e($item->manager_phone ?? '-'); ?></td>


                        </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            
                        </tbody>
                    </table>

                     <?php echo $__env->make('admin.common.delete-script',['venues.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 