<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('new_content'); ?>

   <?php echo $__env->make('admin.common.breadcrumbs', compact('route','active_class','title') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('global.app_list'); ?>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable  ">
                <thead>
                    <tr>

                        <th><?php echo app('translator')->getFromJson('global.languages.fields.language'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.languages.fields.code'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.languages.fields.is-rtl'); ?></th>
                        <?php if( request('show_deleted') == 1 ): ?>
                        <th>&nbsp;</th>
                        <?php else: ?>
                        <th><?php echo app('translator')->getFromJson('custom.app_actions'); ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('new_admin_js_scripts'); ?>
    <script>

        $(document).ready(function () {
            "use strict";

            window.dtDefaultOptions.ajax = '<?php echo route('admin.languages.index'); ?>?show_deleted=<?php echo e(request('show_deleted')); ?>';
            window.dtDefaultOptions.columns = [

                {data: 'language', name: 'language'},
                {data: 'code', name: 'code'},
                {data: 'is_rtl', name: 'is_rtl'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>