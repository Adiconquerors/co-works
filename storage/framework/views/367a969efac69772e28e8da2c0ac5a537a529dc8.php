<?php $__env->startSection('new_content'); ?>
<style>
    #sty-mr15{
      margin-right: 15px;
    }
    #sty-mrpl{
        margin-right: 5px;color:#ff0000;padding-left: 20px;
    }
  </style>
   <h3 class="page-title"><?php echo e($master_setting->module); ?>

        <?php echo $__env->make('admin.common.drop-down-menu', [
        'links' => [
            [
                'route' => 'admin.master_settings.edit',
                'title' => trans('global.app_edit'),
                'type' => 'edit',
                'icon' => '<i class="fa fa-pencil-square-o" id="sty-mr15"></i>',
                'permission_key' => 'master_setting_edit',
            ],
            [
                'route' => 'admin.master_settings.destroy',
                'title' => trans('global.app_delete'),
                'type' => 'delete',
                'icon' => '<i class="fa fa-trash-o" id="sty-mrpl"></i>',
                'redirect_url' => url()->previous(),
                'permission_key' => 'master_setting_delete',
            ],
        ],
        'record' => $master_setting,
        ] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </h3>

    <div class="panel panel-default">

        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('global.app_view'); ?>
        </div>


        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.module'); ?></th>
                            <td field-key='module'><?php echo e($master_setting->module); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.key'); ?></th>
                            <td field-key='key'><?php echo e($master_setting->key); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('custom.settings.moduletype'); ?></th>
                            <td field-key='moduletype'><?php echo e($master_setting->moduletype); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('custom.settings.status'); ?></th>
                            <td field-key='status'><?php echo e($master_setting->status); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.master-settings.fields.description'); ?></th>
                            <td field-key='description'><?php echo clean($master_setting->description); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="<?php echo e(route('admin.master_settings.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('custom.translationmanager.back'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>