<?php $__env->startSection('new_admin_head_links'); ?>
<link href="<?php echo e(CSS); ?>checkbox.css" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('new_content'); ?>
<style>
  .tcbm{
    margin-top:25px; 
  }
</style>
    <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title"><?php echo e(trans('custom.settings.settings')); ?></h4>
           <ol class="breadcrumb p-0 m-0">
              <li class="breadcrumb-item">
                 <a href="<?php echo e(route('admin.master_settings.index')); ?>"><?php echo e(ucwords($active_class)); ?></a>
              </li>
             
              <li class="breadcrumb-item">
                 <?php echo e(isset($title) ? $title : ''); ?>

              </li>
           </ol>
           <div class="clearfix"></div>
        </div>
     </div>
  </div>

  <div class="row">
     <div class="col-md-12">
        <div class="card-box">
           
    <?php if(count($errors) > 0): ?>
      <div class="alert alert-danger">
          <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
      </div>
    <?php endif; ?>
          <!-- spacetypes form start -->
     <?php $button_name = trans('app_create'); ?>

        <?php echo Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH',
                        'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')); ?>


          <div class="row">


              <?php $__empty_1 = true; $__currentLoopData = $settings_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                
                $type_name = 'text';
                if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
                    $type_name = 'text';
                else
                    $type_name = $value->type;
                ?>
                <?php if( $key == 'system_timezone'): ?>
                  <div class="col-md-6">
                    <label for="system_timezone">system_timezone</label>
                      <?php
                      $OptionsArray = timezone_identifiers_list();
                      $selected = getSetting('system_timezone', 'site_settings', 'Asia/Kolkata');
                      ?>
                      <select name="system_timezone[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="system_timezone">
                        <?php $__currentLoopData = $OptionsArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time_zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($time_zone); ?>" <?php if( $time_zone == $selected ): ?> selected="selected" <?php endif; ?>><?php echo e($time_zone); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" name="system_timezone[type]" value="select">
                    <input type="hidden" name="system_timezone[tool_tip]" value="System time zone">
                  </div>
                <?php elseif( 'default_payment_gateway' === $key ): ?>
                  <div class="col-md-6">
                    <label for="default_payment_gateway"><?php echo app('translator')->getFromJson('custom.settings.default-payment-gateway'); ?></label>
                      <?php
                       $payment_gateways = \App\Settings::where('moduletype', 'payment')->get();

                       $selected = getSetting('default_payment_gateway', 'site_settings', 'offline');
                       ?>
                      <select name="default_payment_gateway[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="default_payment_gateway">
                        <?php $__currentLoopData = $payment_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gateway->key); ?>" <?php if( $gateway->key == $selected ): ?> selected="selected" <?php endif; ?>><?php echo e($gateway->module); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" name="default_payment_gateway[type]" value="select">
                    <input type="hidden" name="default_payment_gateway[tool_tip]" value="<?php echo app('translator')->getFromJson('custom.settings.default-payment-gateway'); ?>">
                  </div>
                <?php elseif( 'default_sms_gateway' === $key ): ?>
                  <div class="col-md-6">
                    <label for="default_sms_gateway"><?php echo app('translator')->getFromJson('custom.settings.default-sms-gateway'); ?></label>
                      <?php
                       $sms_gateways = \App\Settings::where('moduletype', 'sms')->get();
                       $selected = getSetting('default_sms_gateway', 'site_settings', '');
                       ?>
                      <select name="default_sms_gateway[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="default_sms_gateway">
                        <?php $__currentLoopData = $sms_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gateway->key); ?>" <?php if( $gateway->key == $selected ): ?> selected="selected" <?php endif; ?>><?php echo e($gateway->module); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" name="default_sms_gateway[type]" value="select">
                    <input type="hidden" name="default_sms_gateway[tool_tip]" value="<?php echo app('translator')->getFromJson('custom.settings.default-sms-gateway'); ?>">
                  </div>
                <?php else: ?>
                  <?php echo $__env->make(
                            'admin.general_settings.sub-list-views.'.$type_name.'-type',
                            array('key'=>$key, 'value'=>$value)
                        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p><?php echo e(trans('custom.settings.no_records_found')); ?></p>
              <?php endif; ?>


          </div>

           <div class="text-center tcbm">
             <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo app('translator')->getFromJson('global.update'); ?></button>
           </div>

           <?php echo Form::close(); ?>

           <!-- end form -->
              <!-- space_types form close  -->
        </div>
        <!-- end card-box -->
     </div>
     <!-- end col -->
  </div>
  <!-- end row -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('new_admin_js_scripts'); ?>

<script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>