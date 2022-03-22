<?php $__env->startSection( 'blog_content' ); ?>
 
 <style>
    .b-img-height{
      height:100% !important;
    }

 </style>  

<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
<div class="panel panel-default blogli">
<h4 class="panel-heading"><?php echo app('translator')->getFromJson('custom.articles.categories'); ?></h4>
        
         <ul class="list-group">
         <li class="list-group-item"><i class="fa fa-angle-right" aria-hidden="true"></i>
            <?php
               $records_count = \App\Article::with(['sub_space_type'])->orderBy('created_at', 'desc')->get();
            ?>
            <a href="<?php echo e(route( 'blog' )); ?>">
              All (<?php echo e($records_count->count()); ?>)
            </a>
         </li> 
         <?php
             $space_types = \App\SpaceType::getSpaceTypes(0);
             
         ?>

         <?php $__currentLoopData = $space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php
           $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);

         ?>
        

         <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
         
            <li class="list-group-item"> <i class="fa fa-angle-right" aria-hidden="true"></i>
<a href="<?php echo e(route('blog', [ 'id' =>$sub->id ])); ?>">

                   
               <?php
                    $blog_article_sub_count = \App\Article::where('sub_space_type_id', $sub->id)->count(); 
               ?>
                   
               <?php echo e($sub->name); ?> (<?php echo e($blog_article_sub_count); ?>)
            </a>
         </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </ul>
      </div></div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 blolit">
   <h2 class="osLight"><?php echo app('translator')->getFromJson('custom.articles.latest-posts'); ?></h2>
   <div class="row">
    <?php if(count($records) > 0): ?>  

      <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <?php
         $authors  = \App\User::find($article->author_id);
         $sub_space_types =  $article->sub_space_type;   
      ?>
  

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
         <div class="article">
            <a href="<?php echo e(route('each.article',[$article->id ])); ?>" class="image">
               <img src="<?php echo e(getDefaultimgagepath($article->image,'articles','')); ?>" class="b-img-height">                
            </a>
            <div class="article-category">
               <a href="<?php echo e(route('each.article',[$article->id ])); ?>" class="text-green isThemeText">
                  <?php echo e($sub_space_types->name); ?>

               </a>
               
            </div>
            <h3 class="osLight">
               <a href="<?php echo e(route('each.article',[$article->id ])); ?>">
                  <?php echo e($article->name); ?>

               </a>
            </h3>
            <a href="<?php echo e(route('each.article',[$article->id ])); ?>">
            <p><?php echo e($article->description); ?></p>
            </a>

            <div class="footer"><a href="<?php echo e(route('each.article',[$article->id ])); ?>"><?php echo e($authors ? $authors->name : '-'); ?></a>, <a href="<?php echo e(route('each.article',[$article->id ])); ?>"><?php echo e($article->created_at->format('M d , Y')); ?></a></div>
         </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
<h4><?php echo app('translator')->getFromJson('custom.articles.no_article'); ?></h4>
<?php endif; ?>
      
   </div>

   
   
   <div class="blog-pagination">
        <?php echo e($records->links()); ?>

      <div class="clearfix"></div>
   </div>

  

</div>

<?php echo $__env->make( 'partials.blog.signin-signup-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make( 'layouts.blog_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>