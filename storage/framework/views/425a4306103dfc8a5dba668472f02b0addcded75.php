<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('new_content'); ?>
<style>
    .sty-alcen{
        text-align: center;
    }
</style>
     <?php echo $__env->make('admin.common.breadcrumbs', compact('route','active_class','title') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="panel panel-default">
       
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped <?php echo e(count($internal_notifications) > 0 ? 'datatable' : ''); ?> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internal_notification_delete')): ?> dt-select <?php endif; ?>">
                <thead>
                    <tr>
                        
                        <th><?php echo app('translator')->getFromJson('global.internal-notifications.fields.text'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.internal-notifications.fields.link'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.internal-notifications.fields.users'); ?></th>
                       <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>

                    </tr>
                </thead>
                
                <tbody>
                    <?php if(count($internal_notifications) > 0): ?>
                        <?php $__currentLoopData = $internal_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $internal_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($internal_notification->id); ?>">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internal_notification_delete')): ?>
                                    <td></td>
                                <?php endif; ?>

                                <td field-key='text'><?php echo e($internal_notification->text); ?></td>
                                <td field-key='link'><a href="<?php echo e($internal_notification->link); ?>" target="_blank"><?php echo e($internal_notification->link); ?></td>
                                <td field-key='users'>
                                    <?php $__currentLoopData = $internal_notification->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleUsers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="label label-info label-many"><?php echo e($singleUsers->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                                                <td>
                                    
                                    <a href="<?php echo e(route('internal_notifications.show',[$internal_notification->id])); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                                   
                                    <a href="<?php echo e(route('internal_notifications.edit',[$internal_notification->id])); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
                                  
                                    
                                    <?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['internal_notifications.destroy', $internal_notification->id])); ?>

                                    <?php echo Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                    
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td class="sty-alcen" colspan="8"><?php echo app('translator')->getFromJson('global.app_no_entries_in_table'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?> 
    <script>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internal_notification_delete')): ?>
            window.route_mass_crud_entries_destroy = '<?php echo e(route('internal_notifications.mass_destroy')); ?>';
        <?php endif; ?>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>