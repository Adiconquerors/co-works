@inject('request', 'Illuminate\Http\Request')
<?php
    $cu_pasth = \Request::route()->getName();
?>

  <style>
    .sty-hp{
        height: 65px; padding: 8px;
    }
    .sty-pbmt{
        padding:8px;background-color:#c1ab773d;margin-top: 13px;
    }
    .sty-dn{
        display: none;
    }
    .sty-ml100{
        margin-left:-100px;
    }
    .sty-mr200{
        margin-right:-200px;
    }
  </style>
   <div id="header">
   <?php
         $site_logo = getSetting('site_logo','site_settings');
         $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
    ?>
     <div class="logo">
        <a href="{{ url( '/' ) }}">

        <img src="{{$default_site_logo_path}}" class="sty-hp">

        </a>
     </div>
     <a href="javascript:void(0);" class="navHandler"><span class="fa fa-bars"></span></a>

     <div class="search">
        <span class="searchIcon icon-magnifier" ></span>
        <input type="text"  placeholder="@lang('others.enter-location')" name="search_property" id="search_property" onclick="initialize_top('search_property')" value="{{$request->input('location')}}" class="sty-pbmt">
     </div>
@if( Auth::check() )
     <div class="headerUserWraper">
        <?php
            $auth_user_image = Auth::user()->image;
           $users_image_path = getDefaultimgagepath($auth_user_image,'users');
          ?>
                <a href="#" class="userHandler dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span><span class="counter">5</span></a>
                <a href="#" class="headerUser dropdown-toggle" data-toggle="dropdown">

                    <img class="avatar headerAvatar pull-left" src="{{ $users_image_path }}" width="40" height="40" alt="avatar">


                    <div class="userTop pull-left">
                        <span class="headerUserName"><b><?php $user_name = Auth::user()->name ?> {{ ucwords($user_name)  }}</b></span> <span class="fa fa-angle-down"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <div class="dropdown-menu pull-right userMenu" role="menu">
                    <div class="mobAvatar">
                        <img class="avatar mobAvatarImg" src="images/avatar5.jpg" alt="avatar">
                        <div class="mobAvatarName"><b><?php $user_name = Auth::user()->name ?> {{ ucwords($user_name)  }}</b></div>
                    </div>
                    <ul>
                    <li><a href="{{ route('dashboard') }}"><span class="icon-user"></span>@lang('custom.dashboard.dashboard')</a></li>

                    <li class="divider"></li>
                    <li><a href="{{ route('logout_test') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><span class="icon-power"></span>{{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout_test') }}" method="POST" class="sty-dn">
                    @csrf
                    </form>
                    </li>
                    </ul>


                </div>
            </div>

     <div class="headerpromoWraper">
          <!-- backbtn -->
     <div class="backBtn">
        <span class="line tLine"></span>
        <span class="line mLine"></span>
        <a href="javascript:void(0);" onclick="history.back(-1)"><span class="label-back" ><b>@lang('others.back')</b></span></a>
        <span class="line bLine"></span>
     </div>
     <!-- /backbtn -->
      
     </div>

 <a href="#" class="mapHandler"><span class="icon-map"></span></a>
     <div class="clearfix"></div>

      <!-- backbtn -->



  @else


  <div class="headerpromoWraper">
        <div class="backBtn">
        <span class="line tLine"></span>
        <span class="line mLine"></span>
        <a href="javascript:void(0);" onclick="history.back(-1)"><span class="label-back" ><b>@lang('others.back')</b></span></a>
        <span class="line bLine"></span>
     </div>
       
     </div>

<a href="#" class="mapHandler"><span class="icon-map"></span></a>
     <div class="clearfix"></div>
      <!-- backbtn -->


@endif

  </div>



<script>
  function openExplore() {
      $('#redirect_url').val('{{route("properties.list" )}}')
      $('#login-modal').modal('toggle');
   }

</script>
