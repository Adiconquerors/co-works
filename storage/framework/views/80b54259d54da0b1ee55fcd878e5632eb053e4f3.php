<?php $__env->startSection( 'new_content' ); ?>
<style>
  .lglvh{
      visibility:hidden;
  }
</style>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo app('translator')->getFromJson('custom.eforms.tdetails'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('testimonials.index')); ?>"><?php echo e(ucwords( $active_class )); ?></a>
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
 
<li class="list-group-item">

    <?php
     $image = $record->image;
     $description = strip_tags($record->description);
    ?>

 <?php echo app('translator')->getFromJson('custom.users.name'); ?> 
  <span> 
    <?php echo e($record->name ?? ''); ?> 
  </span> 
</li>
<li class="list-group-item">
  <?php echo app('translator')->getFromJson('custom.users.image'); ?>
  <span> 
    <?php if($image): ?>
    <img src="<?php echo e(IMAGE_PATH_UPLOAD_TESTIMONALS.$image); ?>" alt="" class="img-fluid  d-block" height="120" width="120">
    <?php else: ?>
      <img src="<?php echo e(IMAGE_PATH_UPLOAD_SPACE_TYPES); ?>1.jpg" alt="" class="img-fluid  d-block" height="120" width="120">
    <?php endif; ?>
  </span>
</li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.description'); ?> <span><?php echo e($record->description ? $description : '-'); ?> </span> </li>
<li class="list-group-item lglvh"><?php echo app('translator')->getFromJson('custom.users.description'); ?> <span><?php echo e($record->description ? $description : '-'); ?> </span> </li>


</ul>
 
</div>
<!-- End -->  
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>