	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	   <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
          
      ?>

<!-- App favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="{{$site_favicon_im}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{$site_favicon_im}}">
<!-- App title -->
<title>{{getSetting('site_title', 'site_settings')}}</title>

 <!-- Plugin Css-->
<link rel="stylesheet" href="{{ PUBLIC_PLUGINS_NEW_ADMIN }}magnific-popup/css/magnific-popup.css" />

<!-- Bootstrap select -->
<link href="{{ PUBLIC_PLUGINS_NEW_ADMIN }}bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

<!-- App css -->
<link rel="stylesheet" type="text/css" href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/bootstrap.min.css" />


<link rel="stylesheet" href="{{PUBLIC_ASSETS_NEW_ADMIN}}fonts/font-awesome.min.css" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/icons.css" />
<link rel="stylesheet" type="text/css" href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/style.css" />

<link href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/bootstrap-notify/0.2.0/bootstrap-notify.min.css" rel="stylesheet"/>	

<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/sweetalert.css" />



<link rel="stylesheet" href="{{ PUBLIC_ASSETS_NEW_ADMIN }}css/1.4.1/bootstrap-datepicker/bootstrap-datepicker3.css"/>

<link rel="stylesheet" href="{{ PUBLIC_PLUGINS_NEW_ADMIN }}switchery/switchery.min.css">

<script src="{{ PUBLIC_ASSETS_NEW_ADMIN }}js/modernizr.min.js"></script>

<link href="{{ PREFIX1 }}css/cdn-styles-css/datatables/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ PREFIX1 }}css/cdn-styles-css/datatables/dataTables.min.css" rel="stylesheet">

<link href="{{ PREFIX1 }}css/cdn-styles-css/datatables/select.dataTables.min.css" rel="stylesheet">

<link href="{{ PREFIX1 }}css/cdn-styles-css/datatables/buttons.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
        var baseurl = '{{ url('/') }}';
        var crsf_hash = '{{ csrf_token() }}';
        var prefix1 = '{{PREFIX1}}';
    </script>

@if ( isset($direction) && 'rtl' === $direction )
<link href="{{ PREFIX1 }}css/rtl.css" rel="stylesheet">
@endif

@yield( 'new_admin_head_links' )

@yield( 'new_admin_internal_styles' )

@yield( 'new_admin_internal_head_scripts' )




