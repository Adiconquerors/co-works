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
   <?php echo $__env->make( 'partials.main-two.head', compact('lang', 'direction') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </head>

    <body class="notransition">

	<?php echo $__env->make( 'partials.main-two.main-topbar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

	<?php echo $__env->make( 'partials.main-two.sidebar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>  	
  
    <div id="wrapper">
	<div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Loading map...</div></div>
    	
	 <?php echo $__env->yieldContent( 'content_two' ); ?>
  
    </div>
    
    <?php echo $__env->make( 'partials.main-two.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    </body>

</html>