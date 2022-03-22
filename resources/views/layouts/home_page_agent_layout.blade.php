<!DOCTYPE html>
<html lang="en">
   <head>
   @include( 'partials.main-two.head' )
   </head>

    <body class="notransition">

	@include( 'partials.main-two.main-topbar' ) 

	@include( 'partials.main-two.sidebar' )  	
  
    <div id="wrapper">
	 
	 @yield( 'content_two' )
  
    </div>
    
    @include( 'partials.main-two.javascripts' )
    
    </body>

</html>