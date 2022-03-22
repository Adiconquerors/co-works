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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   @include( 'partials.blog.head', compact('lang', 'direction') )
   </head>

   <body class="notransition no-hidden">
      <div class="blog-search">
            <input type="search" placeholder="@lang('custom.listings.fields.search-blog')" class="osLight top-blog-search">
        </div>

      @include( 'partials.blog.main-topbar' )
         <div class="blog-content">
           <div class="home-wrapper">
              <div class="row">
               @yield( 'blog_content' )
            </div>
           </div>
         </div>
         @include( 'partials.blog.footer' )

      <!-- javascripts -->
      @include( 'partials.blog.javascripts' )
      <!-- end javascripts -->

   </body>
</html>