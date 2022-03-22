<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo e($language->language); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('admin.languages.index')); ?>"> <?php echo e(ucfirst($title)); ?></a>
            </li>
            <li class="breadcrumb-item">
               <?php echo e(ucfirst($title)); ?>

            </li>
         </ol>
         <div class="clearfix"></div>  
      </div>
   </div>
</div>
<!-- end row -->

<div class="card led-view">
 
 
      <ul class="list-group list-group-flush">
 
<li class="list-group-item"><?php echo app('translator')->getFromJson('global.languages.fields.language'); ?> <span> <?php echo e($language->language); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('global.languages.fields.code'); ?> <span> <?php echo e($language->code); ?></span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('global.languages.fields.is-rtl'); ?><span><?php echo e($language->is_rtl); ?> </span> </li>

</ul>
 
</div>

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>