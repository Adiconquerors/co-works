<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><?php echo e($title); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('menus.index')); ?>"><?php echo e(ucwords($active_class)); ?></a>
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

<!-- Start -->
<div class="card led-view">
 
 
<ul class="list-group list-group-flush">
 
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.eforms.text'); ?> <span> <?php echo e($record->text ?? ''); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.eforms.link'); ?> <span><a href="<?php echo e($record->link); ?>" target="_blank"> <?php echo e($record->link ?? ''); ?></a></span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.settings.type'); ?><span><?php echo e($record->type ?? ''); ?> </span> </li>

</ul>
 
</div>
<!-- End -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>