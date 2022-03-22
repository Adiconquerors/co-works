<?php
$direction = 'ltr';
if (\Cookie::get('direction')) {
    $direction = \Cookie::get('direction');
}


$lang = 'en';
if (\Cookie::get('language')) { 
    $lang = \Cookie::get('language');
}
?>

<!DOCTYPE html>
<html lang="{{$lang}}" dir="{{ $direction }}">
   <head>
      <!-- Required meta tags -->
      @include( 'partials.newadmin.head', compact('lang', 'direction') )
      <style>
       .sty-dn{
          display:none;
       }
       .sty-tc{
        text-align:center;
       }
       .site-logoimg{
         max-width:70% !important; 
       }
       .site-favin{
        max-width: 100%;
       }
      </style>
   </head>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">

        <!-- new admin layout topbar  -->

            <!-- Top Bar Start -->
<div class="topbar">
   <!-- LOGO -->
   <div class="topbar-left">
    <?php
        $site_logo = getSetting('site_logo','site_settings');
        $site_favicon = getSetting('site_favicon','site_settings');
        $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
        $site_favicon_path = getFaviconSiteLogo($site_favicon,'settings');
    ?>
      <!-- Image logo -->
      <a href="{{ route('dashboard') }}" class="logo">
        
      <span>
         <img src="{{$default_site_logo_path}}" alt="" class="site-logoimg">
      </span>
        
          <i>
          <img src="{{$site_favicon_path}}" alt="" class="site-favin">
          </i>
         
      </a>
   </div>
   <!-- Button mobile view to collapse sidebar menu -->
   <div class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
         <div class="clearfix fix_width">
            <!-- Navbar-left -->
            <ul class="nav navbar-left">
               <li>
                  <button class="button-menu-mobile open-left waves-effect">
                  <i class="mdi mdi-menu"></i>
                  </button>
               </li>
            
                
         
            </ul>

            @if( isAdmin() ) 
            
            <select class="searchable-field form-control sty-dn" placeholder="@lang('custom.listings.fields.searching')"></select>
            @endif
            <!-- Right(Notification) -->
            <ul class="nav navbar-right navbar-right-social">
               <li class="notificationss-menu">
                  <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                   
                    @php($notificationCount = \Auth::user()->internalNotifications()->where('read_at', null)->count())

                    @if($notificationCount > 0)
                          <span class="badge up badge-success badge-pill">
                            {{ $notificationCount }}
                        </span>
                     @endif 

                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                     <li>
                        <h5>@lang('custom.eforms.notifications')</h5>
                     </li>
                     @if (count($notifications = \Auth::user()->internalNotifications()->get()) > 0)
                        @foreach($notifications as $notification)
                              <li class="notification-link {{ $notification->pivot->read_at === null ? "unread" : false }}">
                                  <a href="{{ $notification->link ? $notification->link : "#" }}"
                                     class="user-list-item {{ $notification->link ? 'is-link' : false }}">
                                     <div class="user-desc">
                                           <span class="name">{{ $notification->text }}</span>
                                        
                                     </div>
                                       
                                  </a>

                              </li>
                              @endforeach
                                 @else
                                  <li class="notification-link sty-tc">
                                       @lang('custom.eforms.no-notifications')
                                    </li>
                                    

                     @endif 
                 
                  </ul>
               </li>
              


                <?php 
                  $languages = getLanguages();
                  $languages_arr = array();
                  
                ?>
               <li>
                  <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-language"></i>
                  <span class="badge up badge-success badge-pill">{{ strtoupper(\App::getLocale()) }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                     <li>
                        <h5>@lang('custom.eforms.languages')</h5>
                     </li>
                        @foreach($languages as $language)
                         <?php                            
                            $languages_arr[ $language->code ] = $language->language;
                            ?>
                     <li>
                       
                        <a href="{{ route('admin.language', $language->code) }}" class="user-list-item">
                           <div class="user-desc">
                              <span class="name"> {{ $language->language }} ({{ strtoupper($language->code) }})</span>
                              
                           </div>
                        </a>
                        
                     </li>
                     @endforeach
                     <?php
                       config('app.languages', $languages_arr);
                      ?>

                  </ul>
               </li>

 

                <?php
                    $auth_user_image = Auth::user()->image;
                    $auth_user_name = Auth::user()->name;
                    $default_im_path = getDefaultimgagepath($auth_user_image,'users','');
                    
                ?>

               <li class="dropdown user-box">
                  <a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                   
                  <img src="{{ $default_im_path }}" alt="user-img" class="rounded-circle user-img">
                   
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                     <li>
                        <h5>@lang('custom.dashboard.hi'), {{ $auth_user_name }}</h5>
                     </li>
                    
                     <li><a href="{{ url('/') }}" class="dropdown-item"><i class="ti-home m-r-5"></i> @lang('custom.dashboard.home') </a></li>
                 
                     <li><a href="{{ route('get.profile') }}" class="dropdown-item"><i class="ti-user m-r-5"></i> @lang('custom.dashboard.profile')</a></li>
                       <li><a href="{{ route('auth.change_password') }}" class="dropdown-item"><i class="ti-home m-r-5"></i> @lang('custom.dashboard.change-password') </a></li>
                   
                     <li>
                      <a href="{{ route('logout_test') }}" class="dropdown-item"  onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-5"></i>  {{ __('Logout') }}</a>
                              <form id="logout-form" action="{{ route('logout_test') }}" method="POST" class="sty-dn">
                                @csrf
                            </form>
                     </li>
                  </ul>
               </li>
            </ul>
            <!-- end navbar-right -->
         </div>
      </div>
      <!-- end container -->
   </div>
   <!-- end navbar -->
</div>
<!-- Top Bar End -->

        <!-- end new admin layout topbar  -->

        <!-- New SideBar  -->


   <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
              <ul>
              @include('partials.newadmin.common.sidebar')
             </ul>
            </div>

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->


<!-- End New Admin SideBar  -->



         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">

                    @if ( isDemo() ) 
                    <div class="alert alert-info">
                    @lang('custom.messages.crud_disabled')
                    </div> 
                    @endif 

                  <?php
                    $parts = getController();

                    if( env('APP_DEV') ) {
                        echo $parts['controller'] . '@' . $parts['action'] . ' ' . date('d-m-Y H:i:s');
                    }
                    ?>
                  @yield( 'new_content' )
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            @include( 'partials.newadmin.footer' )

            <?php
               $is_admin = isAdmin();
            ?>

           @if( ($is_admin) && ! in_array($parts['controller'], ['SmsGatewaysController', 'PaymentGatewaysController']) )
             @include( 'partials.newadmin.common.visits-shortlist' )
           @endif
         </div>

         <!-- Right sliding forms -->
         <!--feedback-form-->

         <!--feedback-form-->
         <!-- /Right Sliding Forms -->
      </div>
      <!-- END wrapper -->
      @include( 'partials.newadmin.javascripts' )


@include( 'home-pages.common.shortlist-visit-listing.shortlist-area-modal-scripts' )
@include( 'home-pages.common.shortlist-visit-listing.visit-area-modal-loading-scripts' )

   </body>
</html>