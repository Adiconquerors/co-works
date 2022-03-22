<!DOCTYPE html>
<html lang="en">
   <head>
   @include( 'partials.main-two.head' )
   </head>

    <body class="notransition">
      @include( 'partials.main-two.main-topbar' )
    <div id="wrapper">
	<div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> @lang('others.loading-map')</div></div>


	 @yield( 'content_two' )

    </div>

    @include( 'partials.main-two.javascripts' )

    </body>

</html>