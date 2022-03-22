<?php $__env->startSection('new_content'); ?>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('global.payment-gateways.title'); ?></h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('global.app_view'); ?>
        </div>

        <div class="panel-body table-responsive">



<!-- Tab panes -->
<div class="tab-content">

   <div role="tabpanel" class="tab-pane active" id="details">

         <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.payment-gateways.fields.name'); ?></th>
                            <td field-key='name'><?php echo e($payment_gateway->name); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.payment-gateways.fields.description'); ?></th>
                            <td field-key='description'><?php echo e($payment_gateway->description); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.payment-gateways.fields.logo'); ?></th>
                            <td field-key='logo'><?php if($payment_gateway->logo): ?><a href="<?php echo e(asset(env('UPLOAD_PATH').'/' . $payment_gateway->logo)); ?>" target="_blank"><img src="<?php echo e(asset(env('UPLOAD_PATH').'/thumb/' . $payment_gateway->logo)); ?>"/></a><?php endif; ?></td>
                        </tr>
                    </table>

    </div>




</div>

            <p>&nbsp;</p>

            <a href="<?php echo e(route('admin.payment_gateways.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('global.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>