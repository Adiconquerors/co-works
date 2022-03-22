<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include( 'partials.admin.head' )
   
</head>

<body class="bg-light">
    
    <div class="db-wrapper">

        <div class="db-header">
            <!-- header start -->
            <!-- navigation start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav class="navbar navbar-expand-lg db-navbar">
                           @include( 'partials.admin.profile-dropdown' ) 
                        </nav>
                    </div>
                </div>
            </div>
            <!-- navigation close -->
            <!-- header close -->
        </div>
         <!-- content start -->
        <div class="db-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 col-12">
                        <nav class="navbar navbar-expand-lg db-sidenav">
                            <div class="offcanvas-collapse" id="db-sidenav">
                                <ul class="nav flex-column">
                                 @include( 'partials.admin.sidebar' )    
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
                        @yield( 'dashboard_content' )
                    </div>

                </div>
            </div>
        </div>
         <!-- content close -->
          @include( 'partials.admin.footer' )

    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    @include( 'partials.admin.javascripts' )
   
</body>

</html>