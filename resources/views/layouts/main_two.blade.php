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
<html lang="{{$lang}}" dir="{{$direction}}">
   <head>
   @include( 'partials.main-two.head', compact('lang', 'direction') )
   </head>

    <body class="notransition">

	@include( 'partials.main-two.main-topbar' ) 

	@include( 'partials.main-two.sidebar' )  	
  
    <div id="wrapper">
	<div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Loading map...</div></div>
    	
	 @yield( 'content_two' )
  
    </div>
    
    @include( 'partials.main-two.javascripts' )
    
    </body>

</html>