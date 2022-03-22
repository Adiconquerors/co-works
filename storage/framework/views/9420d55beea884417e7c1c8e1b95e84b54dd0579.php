  <?php $__env->startSection( 'new_admin_head_links' ); ?>

  <?php $__env->stopSection(); ?>
<?php $__env->startSection( 'new_content' ); ?>

<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><?php echo app('translator')->getFromJson('global.sms-gateways.title'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('admin.sms_gateways.index')); ?>"><?php echo e(ucwords($active_class)); ?></a>
            </li>
           
            <li class="breadcrumb-item">
               <?php echo e($title); ?>

            </li>
         </ol>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- end row -->
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
        <!-- sms_gateway form start -->
   <?php $button_name = trans('global.app_create'); ?>
          
      <?php if($sms_gateway): ?>
          <?php $button_name = trans('global.app_update'); ?>

      <?php echo Form::model($sms_gateway, ['method' => 'PUT', 'route' => ['admin.sms_gateways.update',$sms_gateway->id,'class'=>'formvalidation'], 'files' => true,'name'=>'formMemberType' ]); ?>

            
      <?php else: ?>

      <?php echo Form::open(['method' => 'POST', 'route' => ['admin.sms_gateways.store'], 'files' => true,'name'=>'formMemberType','class'=>'formvalidation']); ?>



        <?php endif; ?>

        <?php echo $__env->make('admin.sms_gateways.form-elements', 
                array('button_name'=> $button_name,'sms_gateway'=>$sms_gateway), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

         <?php echo Form::close(); ?>

         <!-- end form -->
            <!-- sms_gateways form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'new_admin_js_scripts' ); ?>  
  <?php echo $__env->make('partials.newadmin.common.parseley-clientside-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>