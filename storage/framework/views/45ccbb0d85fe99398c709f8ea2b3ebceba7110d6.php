<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> <?php echo app('translator')->getFromJson('custom.templates.email-template-details'); ?> </h4>
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
<!-- end row -->
<div class="blog-list-wrapper">
   <div class="row">
       
      <div class="col-lg-10">
         <div class="p-20">
            <!-- Image Post -->
            <div class="blog-post m-b-30">

               <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.title'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->title); ?></p>
               </div>

             
               
               <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.key'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->key); ?></p>
               </div>  

               <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.type'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->type); ?></p>
               </div> 

                <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.subject'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->subject); ?></p>
               </div> 

               <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.from-name'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->from_name); ?></p>
               </div> 


              <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.from-email'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->from_email); ?></p>
               </div> 

               <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.status'); ?></h5>
               </div>
               <div>
                  <p><?php echo e($template->status); ?></p>
               </div> 


              <div class="post-title">
                  <h5><?php echo app('translator')->getFromJson('custom.templates.content'); ?></h5>
               </div>
               <div>
                  <p><?php echo $template->content; ?></p>
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