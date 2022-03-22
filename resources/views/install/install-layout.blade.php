<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Business Tips" content="BUSINESS STARTUP">

    <link rel="apple-touch-icon" sizes="180x180" href="{{PREFIX1}}assets/images/coworking-logs/Asset-2.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{PREFIX1}}assets/images/coworking-logs/Asset-2.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{PREFIX1}}assets/images/coworking-logs/Asset-2.png">

    <link href="{{ PREFIX1 }}adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ PREFIX1 }}adminlte/css/select2.min.css" rel="stylesheet">
    <link href="{{ PREFIX1 }}adminlte/bootstrap/css/bootstrap.min.css">
    <link href="{{ PREFIX1 }}adminlte/css/AdminLTE.min.css" rel="stylesheet">
    <!-- Font Awesome -->

  <link href="{{ PUBLIC_ASSETS }}css-maps/font-awesome.css" rel="stylesheet">
  <link href="{{ PREFIX1 }}css/install.css" rel="stylesheet">


    @yield('header_scripts')
</head>

<body class="login-screen" ng-app="vehicle_booking" >
    <!-- PRELOADER -->

    <!-- /PRELOADER -->

@yield('content')

       <!-- /#wrapper -->
		<!-- jQuery -->
    <script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{PUBLIC_ASSETS}}js-maps/bootstrap/bootstrap337/bootstrap.min.js"></script>

    <script src="{{ PUBLIC_ASSETS }}js/select2.full.min.js"></script>
    <script src="{{ PREFIX1 }}js/cdn-js-files/jquery.validate.js"></script>
    <script src="{{ PREFIX1 }}js/cdn-js-files/sweetalert-dev.js"></script>
		@include('errors.formMessages')
		@yield('footer_scripts')
</body>

</html>