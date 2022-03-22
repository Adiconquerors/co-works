<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo app('translator')->getFromJson('custom.eforms.ndetails'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href=""></a>
            </li>
            <li class="breadcrumb-item">
               
            </li>
         </ol>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- end row -->
<div class="blog-list-wrapper">
   <div class="row">
        
      <div class="col-lg-10">
         <div class="p-20">
            <!-- Image Post -->
            <div class="blog-post m-b-30">

               <div class="post-title">
                  <h5> <?php echo app('translator')->getFromJson('custom.eforms.text'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($record->text ?? ''); ?></p>
               </div>

               
               <div class="post-title">
                  <h5> <?php echo app('translator')->getFromJson('custom.eforms.link'); ?></h5>
               </div>
               <div class="post-title">
                  <a href="<?php echo e($record->link); ?>" target="_blank"><?php echo e($record->link); ?></a>
               </div>

               <div class="post-title">
                  <h5> <?php echo app('translator')->getFromJson('custom.eforms.users'); ?></h5>
               </div>
               <div>
                  <p>
                     <?php $__currentLoopData = $record->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleUsers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php echo e($singleUsers->name); ?>

                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </p>
               </div> 
              
            </div>
         </div>


      </div>
      <!-- end col -->
   
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>