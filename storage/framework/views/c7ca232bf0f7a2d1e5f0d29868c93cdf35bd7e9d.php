<?php $__env->startSection( 'new_content' ); ?>
<style>
  .img-fluid{
    max-width:50%;
  }
</style>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><?php echo app('translator')->getFromJson('custom.articles.article'); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('articles.index')); ?>"><?php echo e(ucwords( $active_class )); ?></a>
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
        <?php
            $authors  = \App\User::find($article->author_id);
            $sub_space_types =  $article->sub_space_type;
            $impath = getDefaultimgagepath($article->image,'articles','')   
        ?>
      <div class="col-lg-10">
         <div class="p-20">
            <!-- Image Post -->
            <div class="blog-post m-b-30">
               <div class="post-image">
                  <img src="<?php echo e($impath); ?>" alt="" class="img-fluid mx-auto d-block">
               </div>
               <div class="text-muted"><span><?php echo app('translator')->getFromJson('custom.articles.by'); ?> <a class="text-dark font-secondary"><?php echo e($authors ? $authors->name : '-'); ?></a>,</span> <span><?php echo e($article->created_at->format('M d , Y')); ?></span></div>

                <h4><a href="javascript:void(0);"><?php echo e($sub_space_types ? $sub_space_types->name : '-'); ?></a></h4>

               <div class="post-title">
                  <h4><a href="javascript:void(0);"><?php echo e($article->name); ?></a></h4>
               </div>
               <div>
                  <p><?php echo e($article->description); ?></p>
               </div>

                <div class="bg-brown text-white p-20">
                     <i class="fa fa-quote-left fa-3x fa-pull-left"></i>
                     <p class="blog-quotes-desc">
                       <?php echo e($article->article_quote); ?>

                     </p>
                  </div>

                 <div class="post-title">
                  <h4><a href="javascript:void(0);"><?php echo e($article->article_heading); ?></a></h4>
               </div>
                 
                <div>
                  <p><?php echo $article->description_one; ?></p>
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