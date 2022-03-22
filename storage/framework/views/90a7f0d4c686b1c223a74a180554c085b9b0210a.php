<?php
$direction = '';
if (\Cookie::get('direction')) {
    $direction = \Cookie::get('direction');
}
$lang = '';
if (\Cookie::get('language')) { 
    $lang = \Cookie::get('language');
}

if ( empty( $direction ) && empty( $lang ) ) {
  $default = \App\Language::where('is_default', 'Yes')->where('status', 'Active')->first();
  if ( ! $default ) {
    $default = \App\Language::where('status', 'Active')->first();
  }
  if ( ! $default ) {
    $default = \App\Language::first();
  }
  if ( $default ) {
    $direction = 'ltr';
    if ( 'Yes' === $default->is_rtl ) {
      $direction = 'rtl';
    }
    $lang = $default->code;
  }
}

if ( empty( $lang ) ) {
  $lang = 'en';
}
if ( empty( $direction ) ) {
  $direction = 'ltr';
}
?>
<!DOCTYPE html>
<html lang="<?php echo e($lang); ?>" dir="<?php echo e($direction); ?>">
   
   <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <?php echo $__env->make( 'partials.blog.head', compact('lang', 'direction') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </head>

   <body class="notransition no-hidden">
      <div class="blog-search">
            <input type="search" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.search-blog'); ?>" class="osLight top-blog-search">
        </div>

      <?php echo $__env->make( 'partials.blog.main-topbar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <div class="blog-content">
           <div class="home-wrapper">
              <div class="row">
               <?php echo $__env->yieldContent( 'blog_content' ); ?>
            </div>
           </div>
         </div>
         <?php echo $__env->make( 'partials.blog.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- javascripts -->
      <?php echo $__env->make( 'partials.blog.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- end javascripts -->

   </body>
</html>