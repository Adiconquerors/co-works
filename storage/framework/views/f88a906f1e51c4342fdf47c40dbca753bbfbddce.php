 <style>
 .table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
 }
</style>
 <div class="card-box table-responsive">
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
            <thead>
            <tr>
                <th><?php echo app('translator')->getFromJson('custom.eforms.company'); ?></th>
                <th><?php echo app('translator')->getFromJson('custom.listings.fields.contact-details'); ?></th>
                <th><?php echo app('translator')->getFromJson('custom.inquiries.no-of-seats'); ?></th>
                <?php if( isAdmin() || isAgent()): ?>
                <th><?php echo app('translator')->getFromJson('custom.eforms.deal-status'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
            </tr>
            </thead>


            <tbody>
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                 
                <?php
                    $sub_space_types =  \App\SpaceType::find( $item->sub_space_type_id);
                    $cities =  \App\City::find( $item->city_id);
                    $properties =  \App\Property::find( $item->property_id);
                ?>
                

            <tr>
             
                <td>
                    <?php echo e($item->company ?? '-'); ?>

                </td>
                <td>
                    <?php echo app('translator')->getFromJson('custom.eforms.name'); ?>   : <?php echo e($item->name ?? '-'); ?><br/>
                    <?php echo app('translator')->getFromJson('custom.eforms.email'); ?>  : <?php echo e($item->email ?? '-'); ?><br/>
                    <?php echo app('translator')->getFromJson('custom.eforms.mobile'); ?> : <?php echo e($item->phone_number ?? '-'); ?><br/>
                </td>
                <td><?php echo e($item->capacity_id ?? '-'); ?></td>
                <?php if( isAdmin() || isAgent()): ?> 
                <td>
                     <?php echo e($item->deal_status ?? '-'); ?>   
                </td>
                <?php endif; ?>

                <td class="actions">
                    <a href="<?php echo e(route('leads.show',$item->id)); ?>" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>

          
                    <?php echo Form::close(); ?> 

                    
                    </td>

            </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   

            </tbody>
        </table>

         <?php echo $__env->make('admin.common.delete-script',['users.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

    </div>