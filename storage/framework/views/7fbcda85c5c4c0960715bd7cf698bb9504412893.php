<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection( 'new_content' ); ?>
<style>
    .p_10{
        padding: 10px;
        }
</style>
    
      <?php echo $__env->make('admin.common.breadcrumbs', compact('route','active_class','title') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <div class="panel panel-default">
        <p class="p_10"><?php echo app('translator')->getFromJson('custom.currencies.currency_layer_message', ['url' => '<a href="https://currencylayer.com" target="_blank">https://currencylayer.com</a>', 'settings_url' => '<a href="'.url('admin/mastersettings/settings/view/currency-settings').'" target="_blank">here</a>']); ?>

        <a href="<?php echo e(route('currency.update_rates')); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('global.update_currency_rates'); ?></a>
        
        </p>
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('global.app_list'); ?>
        </div>

        <div class="panel-body table-responsive">
          <?php echo $__env->make('admin.currencies.display-records', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?> 
 <?php echo $__env->make('admin.currencies.display-records-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>