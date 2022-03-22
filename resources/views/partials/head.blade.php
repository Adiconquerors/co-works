    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <?php
          $site_favicon = getSetting('site_favicon', 'site_settings');
          $site_favicon_im = getFaviconSiteLogo($site_favicon, 'settings');
          
      ?>

    <link rel="apple-touch-icon" sizes="180x180" href="{{$site_favicon_im}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{$site_favicon_im}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{$site_favicon_im}}">
    
    <meta name="theme-color" content="#1e3144">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>{{getSetting('site_title', 'site_settings')}}</title>
    <meta name="description" content="">
      
      @yield( 'main_heads' ) 

    <link href="{{ PUBLIC_ASSETS }}css/Login-register-modal.css" rel="stylesheet">
    <link href="{{ PUBLIC_ASSETS }}css/component.css" rel="stylesheet">
    <link href="{{ PUBLIC_ASSETS }}css-maps/font-awesome.css" rel="stylesheet">
    <link href="{{ PUBLIC_ASSETS }}css/project2-style.css" rel="stylesheet">
    <link href="{{ PUBLIC_ASSETS }}css/simple-line-icons.css" rel="stylesheet">
    
     <!-- infographics -->   
     <link rel="stylesheet" href="{{ PUBLIC_ASSETS }}css/info-style.css" />
     <link rel="stylesheet" href="{{ PUBLIC_ASSETS }}css/aos.css"/>

     <script type="text/javascript">
        var baseurl = '{{ url('/') }}';
        var crsf_hash = '{{ csrf_token() }}';
        var prefix1 = '{{PREFIX1}}';
    </script>


    @yield( 'main_head_links' )

  
 
    <script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-65415661-1');
    jQuery(document).ready(function($){
        $(window).scroll(function(){
          var sticky = $('.navbar-fixed-top'),
              scroll = $(window).scrollTop();

          if (scroll >= 100 ) sticky.addClass('fixed');
          else sticky.removeClass('fixed');


        });
      });
    </script>
     @yield( 'main_header_scripts' )
     
   <style>
   .home:before{
    background: transparent;
   }
   </style>

   @yield( 'main_header_styles' )