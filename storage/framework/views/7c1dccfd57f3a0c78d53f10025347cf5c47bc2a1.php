<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('new_content'); ?>


    <?php echo $__env->make('admin.common.breadcrumbs', compact('route','active_class','title') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
    <div class="panel panel-default">
       
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped <?php echo e(count($menus) > 0 ? 'datatable' : ''); ?> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu_delete')): ?> dt-select <?php endif; ?>">
                <thead>
                    <tr>
                        
                        <th><?php echo app('translator')->getFromJson('custom.eforms.text'); ?></th>
                        <th><?php echo app('translator')->getFromJson('custom.eforms.link'); ?></th>
                        <th><?php echo app('translator')->getFromJson('custom.settings.type'); ?></th>
                        <th><?php echo app('translator')->getFromJson('custom.icons.icon-name'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>

                    </tr>
                </thead>
                
                <tbody>
                    <?php if(count($menus) > 0): ?>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($menu->id); ?>">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('internal_notification_delete')): ?>
                                    <td></td>
                                <?php endif; ?>

                                <td field-key='text'><?php echo e($menu->text); ?></td>
                                <td field-key='link'><a href="<?php echo e($menu->link); ?>" target="_blank"><?php echo e($menu->link); ?></td>
                                 <td field-key='type'><?php echo e($menu->type); ?></td>
                                 <td field-key='icon'><?php echo e($menu->icon->name); ?></td>
                                <td>
                                    
                                    <a href="<?php echo e(route('menus.show',[$menu->id])); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>
                                   
                                    <a href="<?php echo e(route('menus.edit',[$menu->id])); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
                                  
                                    
                                    <?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['menus.destroy', $menu->id])); ?>

                                    <?php echo Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                    
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8"><?php echo app('translator')->getFromJson('global.app_no_entries_in_table'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('new_admin_js_scripts'); ?> 
    <script>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu_delete')): ?>
            window.route_mass_crud_entries_destroy = '<?php echo e(route('menus.mass_destroy')); ?>';
        <?php endif; ?>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>