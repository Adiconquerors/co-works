<!-- Content -->
<?php $__env->startSection( 'blog_content' ); ?>
 <style>
    .b-img-height{
      height:100% !important;
    }

    .img-responsive{
        width: 70% !important;
        max-width: 100%;
        height: 350px;
    }
 </style>  
<div class="home-content">
<div class="home-wrapper">
<div class="row">
   
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
<li class="list-group-item"><i class="fa fa-angle-right" aria-hidden="true"></i><a href="<?php echo e(route('blog', [ 'id' => $sub->id ])); ?>">
     <?php
         

           $blog_article_sub_count = \App\Article::where('sub_space_type_id',$sub->id)->count(); 

      ?>
      <?php echo e($sub->name); ?> (<?php echo e($blog_article_sub_count); ?>)</a></li>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       </ul>




 <!-- End Popular Tags -->
 </div>
</div>
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 blolit">
    <div class="panel panel-default blogli">
    <div class="panel-body">

         <?php
              $authors  = \App\User::find($records->author_id);
              $sub_space_types =  $records->sub_space_type;   
          ?>
           

        <div class="post-top">
            <div class="post-author">

              
                <img src="<?php echo e(getDefaultimgagepath($authors->image,'users','')); ?>" alt="avatar">

                <div class="pa-user">
                    <div class="pa-name"><?php echo e($authors ?  $authors->name : '-'); ?> <?php echo app('translator')->getFromJson('custom.eforms.on'); ?> <?php echo e($records->created_at->format('M d , Y')); ?></div>
                    <div class="pa-title"><?php echo e($authors ?  $authors->job_role : '-'); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
           
            <div class="clearfix"></div>
        </div>

        <div class="post-content">
          <p><a href="javascript:void(0);" class="text-green isThemeText"><?php echo e($sub_space_types ? $sub_space_types->name : '-'); ?></a></p>
            <h2 class="osLight"><?php echo e($records->name); ?></h2>
            <p><?php echo $records->description; ?> </p>
             <blockquote><?php echo e($records->article_quote); ?></blockquote>
            <div class="col-lg-12 col-xs-12">
               <img src="<?php echo e(getDefaultimgagepath($records->image,'articles','')); ?>" alt="image" class="img-responsive">
               <div class="ib-title"><span class="osLight"><?php echo e($records->name); ?></span></div>  
            </div>
            <h2 class="osLight post-content"><?php echo e($records->article_heading); ?></h2>
            <p><?php echo $records->description_one; ?></p>
            
        </div>
        </div>


<div class="clearfix"></div>
<div class='col-md-12'>
<div class="row">
  <br/>
        <h2 class="osLight align-left"><b><?php echo app('translator')->getFromJson('custom.articles.related-articles'); ?></b></h2>

		<?php
		  $author_related_articles = \App\Article::where('author_id',$records->author_id)->paginate(4);
		?>
		<?php if( count($author_related_articles) > 0 ): ?>
        <div class="row pb20">
        	  <?php $__currentLoopData = $author_related_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author_related_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	  <?php
		         $authors = \App\User::find($author_related_article->author_id);
             $sub_space_types =  $author_related_article->sub_space_type;   
		       ?>  
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="article bg-w">
                   <a href="<?php echo e(route('each.article',[$author_related_article->id ])); ?>" class="image">
					
          <img src="<?php echo e(getDefaultimgagepath($author_related_article->image,'articles','')); ?>" alt="image" class="b-img-height">
          
                  </a>
                    <div class="article-category"><a href="<?php echo e(route('each.article',[$author_related_article->id ])); ?>" class="text-green isThemeText"><?php echo e($sub_space_types ? $sub_space_types->name : '-'); ?></a></div>
                    <h3 class="osLight">
                    	<a href="<?php echo e(route('each.article',[$author_related_article->id ])); ?>"><?php echo e($author_related_article->name); ?>

                    	</a>
                    </h3>
                    <div class="footer"><a href="<?php echo e(route('each.article',[$author_related_article->id ])); ?>"><?php echo e($authors ? $authors->name : '-'); ?></a>, <a href="<?php echo e(route('each.article',[$author_related_article->id ])); ?>"><?php echo e($author_related_article->created_at->format('M d , Y')); ?></a></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
         
			<?php else: ?>
			<h4 ><?php echo app('translator')->getFromJson('global.app_no_records_are_avaliable'); ?></h4>
			<?php endif; ?>        

        </div>

    <div class="pagination">
            <?php echo e($author_related_articles->links()); ?>

        </div> 
  

    <?php
				$tags = \App\ArticleTag::where('is_popular','Yes')->get();
				?>
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
				<a href="<?php echo e(route('blog', [ 'records' => $records->id, 'type_slug' =>$tag->slug ])); ?>" class="label label-default"><?php echo e($tag->name); ?></a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end content -->

<?php echo $__env->make( 'partials.blog.signin-signup-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.blog_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>