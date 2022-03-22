<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
   @include( 'partials.head' )
   </head>
   
   <body class="home">
      <div id="app">
       
         <header class="masthead">
            <nav class="navbar navbar-default navbar-fixed-top"> 
               <div class="container-fluid">
                  <!-- sidebar -->
                  @include( 'partials.sidebar' )
                  <!-- end sidebar -->

                  <!-- main-homepage-topbar --> 
                  @include( 'partials.main-topbar' )
                  <!-- end main-homepage-topbar -->
                  
               </div>
            </nav>
         </header>
         @yield( 'content' )
      </div>

      <!-- javascripts -->
      @include( 'partials.javascripts' )
      <!-- end javascripts -->
      
   </body>
</html>