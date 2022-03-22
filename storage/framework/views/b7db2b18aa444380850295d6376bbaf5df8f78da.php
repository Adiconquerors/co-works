<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php echo $__env->make( 'partials.admin.head' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
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
                           <?php echo $__env->make( 'partials.admin.profile-dropdown' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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
                                 <?php echo $__env->make( 'partials.admin.sidebar' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
                        <?php echo $__env->yieldContent( 'dashboard_content' ); ?>
                    </div>

                </div>
            </div>
        </div>
         <!-- content close -->
          <?php echo $__env->make( 'partials.admin.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <?php echo $__env->make( 'partials.admin.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
</body>

</html>