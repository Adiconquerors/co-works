<?php
  $articles  = \App\Article::get();
?>

<style>
    .sty-ote{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .sty-h50{
        height: 50px;
    }
    .sty-mt10{
        margin-top:-10px;
    }
    .sty-cp{
        cursor: pointer;
    }
    .sty-dn{
        display: none;
    }
</style>

<div id="hero-container-blog">
    <?php
      $im_path = PUBLIC_ASSETS.'images/default-imgs/noimfound.png';    
      
    ?>
 <?php if(count($articles) > 0): ?>
   <div id="carouselBlog" class="carousel slide featured" data-ride="carousel">    
     <?php else: ?>
   <div id="carouselBlog" class="carousel slide featured" data-ride="carousel" style="background: url(<?php echo e($im_path); ?>) no-repeat center center fixed;  background-size: cover;">
   <?php endif; ?> 
   <?php if(count($articles) > 0): ?>  
   <ol class="carousel-indicators">
       <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <li data-target="#carouselBlog" data-slide-to="<?php echo e($loop->index); ?>" class="<?php if($loop->first): ?> active <?php endif; ?>"></li>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </ol>
 <div class="carousel-inner">
     <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
       $image_path = IMAGE_PATH_UPLOAD_ARTICLES . $art->image;
       $authors  = \App\User::find($art->author_id);
      ?>

     <div class="item <?php if($loop->first): ?> active <?php endif; ?>" style="background-image: url(<?php echo e($image_path); ?>)">
         <div class="container">
             <div class="carousel-caption">
                 <div class="carousel-title"><?php echo e($art->name); ?></div>

                <div class="caption-title"><?php echo e($art->article_heading); ?></div>
                
                <div class="caption-subtitle"><?php echo e($art->description); ?> </div>

                 <a href="<?php echo e(route('each.article',$art->id)); ?>" class="btn btn-enquire-solid Res_Btn"><?php echo app('translator')->getFromJson('main.blog.read-more'); ?></a>
             </div>
             <div class="avatar-caption">
                <?php
                    $authors_img_path = getDefaultimgagepath($authors->image,'users');                    

                ?>
                <?php if( $authors ): ?>
                 <img src="<?php echo e($authors_img_path); ?>" alt="avatar">
                <?php endif; ?>
                
                 <div class="ac-user">
                     <div class="ac-name"><?php echo e($authors ? $authors->name : '-'); ?>  <?php echo app('translator')->getFromJson('main.blog.on'); ?>
                      <?php echo e($art->created_at->format('d M , Y')); ?>

                     </div>
                     <div class="ac-title"><?php echo e($authors ? $authors->job_role : '-'); ?></div>
                 </div>
                 <div class="clearfix"></div>
             </div>
         </div>
     </div>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </div>
 <a class="left carousel-control" href="#carouselBlog" role="button" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
 <a class="right carousel-control" href="#carouselBlog" role="button" data-slide="next"><span class="fa fa-chevron-right"></span></a>
 <?php endif; ?>
</div>



   <!-- Header -->
   <div class="home-header">
    <?php
         $site_logo = getSetting('site_logo','site_settings');
         $sitelogo_path = getFaviconSiteLogo('','settings',$site_logo); 
    ?>
      <div class="home-logo osLight">
         <a href="<?php echo e(url('/')); ?>">
           
         <img src="<?php echo e($sitelogo_path); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" class="sty-h50">
      
         </a>
      </div>
      <a href="#" class="home-navHandler visible-xs"><span class="fa fa-bars"></span></a>
      <a href="javascript:void(0);" class="toggle-search"><span class="fa fa-search"></span></a>
      <div class="blog-nav">
         <ul>

            <?php if( !Auth::user() ): ?>
                <li><a href="<?php echo e(url('/')); ?>"><?php echo app('translator')->getFromJson('main.blog.home'); ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('custom.dashboard.dashboard'); ?></a></li>
            <?php endif; ?>

            <?php if( Auth::check() ): ?>
            <li><a href="<?php echo e(route('properties.create')); ?>" class="btn btn-green isThemeBtn sty-mt10"><?php echo app('translator')->getFromJson('main.blog.list-a-property'); ?></a></li>
            <?php else: ?>
            <li><a href="javascript:void(0);" class="btn btn-green isThemeBtn sty-mt10" onclick="openLogin();"><?php echo app('translator')->getFromJson('main.blog.list-a-property'); ?></a></li>
            <?php endif; ?>

            <?php if( !Auth::user() ): ?>
            <li><a data-toggle="modal" data-target="#blog-signup" class="sty-cp"><?php echo app('translator')->getFromJson('main.blog.sign-up'); ?></a></li>
            <li><a data-toggle="modal" data-target="#blog-signin" class="sty-cp"><?php echo app('translator')->getFromJson('main.blog.sign-in'); ?></a></li>
            <?php else: ?>
            <li><a href="<?php echo e(route('logout_test')); ?>" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="btn btn-green isThemeBtn sty-mt10" ><?php echo e(__('Logout')); ?></a>

            <form id="logout-form" action="<?php echo e(route('logout_test')); ?>" method="POST" class="sty-dn">
             <?php echo csrf_field(); ?>
            </form>
           </li>
            <?php endif; ?>



         </ul>
      </div>
   </div>

</div>  </ul>
      </div>
   </div>

</div>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script> 
<script src="<?php echo e(PUBLIC_ASSETS); ?>js/select2/4.0.8/select2.min.js"></script>



 <script type="text/javascript">
   function openLogin() {
      $('#redirect_url').val('<?php echo e(route("properties.create" )); ?>')
      $('#signin').modal('toggle');
   }
</script>

