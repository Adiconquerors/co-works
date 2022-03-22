<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection( 'new_content' ); ?>
    <h3 class="page-title"><?php echo e($currency->name . '('.$currency->symbol.')'); ?></h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('global.app_view'); ?>
        </div>

        <?php
        $tabs = [
            'details_active' => 'active',
        ];
        
        if ( ! empty( $list ) ) {
            foreach ($tabs as $key => $value) {
                $tabs[ $key ] = '';
                if ( substr( $key, 0, -7) == $list ) {
                    $tabs[ $key ] = 'active';
                }
            }
        }
        ?>

        <div class="panel-body table-responsive">

<!-- Tab panes -->
<div class="tab-content">

  <div role="tabpanel" class="tab-pane <?php echo e($tabs['details_active']); ?>" id="details">

        <div class="pull-right">
            
                <a href="<?php echo e(route('currencies.edit',[$currency->id])); ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
            
       </div>   

      <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.currencies.fields.name'); ?></th>
                            <td field-key='name'><?php echo e($currency->name); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.currencies.fields.symbol'); ?></th>
                            <td field-key='symbol'><?php echo e($currency->symbol); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.currencies.fields.code'); ?></th>
                            <td field-key='code'><?php echo e($currency->code); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.currencies.fields.rate'); ?></th>
                            <td field-key='rate'><?php echo e($currency->rate); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('global.currencies.fields.status'); ?></th>
                            <td field-key='status'><?php echo e($currency->status); ?></td>
                        </tr>
                    </table>

    </div> 


</div>

            <p>&nbsp;</p>

            <a href="<?php echo e(route('currencies.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('global.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>