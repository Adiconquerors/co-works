<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo app('translator')->getFromJson('custom.users.user-details'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('users.index')); ?>"><?php echo e(ucwords( $active_class )); ?></a>
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
     $user_role    = \App\Role::find($record->role_id);
    ?>

 <?php echo app('translator')->getFromJson('custom.users.name'); ?>
  <span> 
    <?php echo e($record->name ?? '-'); ?> 
  </span> 
</li>
<li class="list-group-item">
  <?php echo app('translator')->getFromJson('custom.users.image'); ?>
  <span> 
    <?php if($image): ?>
    <img src="<?php echo e(IMAGE_PATH_UPLOAD_USERS.$image); ?>" alt="" class="img-fluid  d-block" height="120" width="120">
    <?php else: ?>
      <img src="<?php echo e(IMAGE_PATH_UPLOAD_SPACE_TYPES); ?>1.jpg" alt="" class="img-fluid  d-block" height="120" width="120">
    <?php endif; ?>
  </span>
</li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.email'); ?><span><?php echo e($record->email ?? '-'); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.role'); ?><span><?php echo e($user_role ? $user_role->name : '-'); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.mobile'); ?><span><?php echo e($record->mobile ? $record->mobile : '-'); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.skype-email'); ?><span><?php echo e($record->skype_email ?? '-'); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.phone'); ?><span><?php echo e($record->phone ?? '-'); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.description'); ?><span><?php echo e($record->description ?? '-'); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.mobile-verified'); ?><span><?php echo e($record->is_mobile_verified); ?></span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('global.currency'); ?><span><?php echo e($record->currency->name); ?></span> </li>

</ul>
 
</div>
<!-- End -->  
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>