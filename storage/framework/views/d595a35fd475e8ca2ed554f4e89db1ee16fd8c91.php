<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo app('translator')->getFromJson('custom.icons.amenities'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('amenities.index')); ?>"><?php echo e(ucwords( $active_class )); ?></a>
            </li>
            <li class="breadcrumb-item">
               <?php echo e($title); ?>

            </li>
         </ol>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
   
 <!-- Start -->
<div class="card led-view">
 
 
<ul class="list-group list-group-flush">
 
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.icons.name'); ?> <span> <?php echo e($record->name); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.icons.icon'); ?> <span> <i class="<?php echo e($record->icon->name); ?>"> </i> </span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.icons.icon-name'); ?><span><?php echo e($record->icon->name); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.icons.description'); ?><span><?php echo e($record->description); ?> </span> </li>

</ul>
 
</div>
<!-- End -->  


<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>