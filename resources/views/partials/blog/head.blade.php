<link href="{{ PUBLIC_ASSETS }}css-maps/font-awesome.css" rel="stylesheet">
 	 <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
          
      ?>

<link rel="apple-touch-icon" sizes="180x180" href="{{$site_favicon_im}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{$site_favicon_im}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{$site_favicon_im}}">

 <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
	
<title>{{getSetting('site_title', 'site_settings')}}</title>	

<link href="{{ PUBLIC_ASSETS }}css-maps/bootstrap.css" rel="stylesheet">
<link href="{{ PUBLIC_ASSETS }}css-maps/app.css" rel="stylesheet" id="app">
<link href="{{ PUBLIC_ASSETS }}css-maps/jquery-ui.css" rel="stylesheet" id="jquery-ui">
    <script type="text/javascript">
        var baseurl = '{{ url('/') }}';
        var crsf_hash = '{{ csrf_token() }}';
        var prefix1 = '{{PREFIX1}}';
    </script>
@if( ! empty( $direction ) && 'rtl' === $direction)
<link href="{{ PREFIX1 }}css/rtl.css" rel="stylesheet">
@endif