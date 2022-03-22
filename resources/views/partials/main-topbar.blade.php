<style>
  .sty-mt2{
    margin-top: 2px;
  }
  .sty-m{
    margin:0px 0px 0px 7px;
  }
  .sty-dn{
    display: none;
  }
  .imnb-width{
    max-width: 162px !important;
    margin-top: 10px;
  }
</style>


<div class="navbar-header">
   <!-- Collapsed Hamburger -->
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
      <span class="sr-only">@lang('main.home.toggle-navigation')</span>
      <div class="menu__trigger"><span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </div>
   </button>

   <?php
         $site_logo = getSetting('site_logo','site_settings');
         $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
    ?>

   <!-- Branding Image -->
     <a class="navbar-brand" href="{{url('/')}}">
     
            <img src="{{$default_site_logo_path}}" class="imnb-width" alt="{{getSetting('site_title','site_settings')}}">
     </a>
</div>
    
<div class="collapse navbar-collapse" id="app-navbar-collapse">
   <ul class="nav navbar-nav navbar-right main-nav">
     
       @if( Auth::check() )
          <li class="">
          <a href="{{route('properties.create')}}">@lang('main.home.list-your-space')</a>
          </li>
        @else
          <li class="togglelogin">
          <a href="javascript:void(0)" onclick="openLogin();">@lang('main.home.list-your-space')</a>
          </li>
        @endif
      
      <!-- Menues -->
      <?php
        $menus = \App\Menu::where('type','topbar')->get();
      ?>
      @foreach($menus as $menu)  
        <li>
          <a href="{{ $menu->link ?? 'javascript:void(0);' }}" >{{ $menu->text ?? '' }}</a>
        </li>
      @endforeach
     
      <!-- End Menues -->

      @if( Auth::check() )
    
       <li><a href=""  class="headerUserWraper">
        <a href="javascript:void(0);" class="headerUser dropdown-toggle" data-toggle="dropdown">
          <?php
            $auth_user_image = Auth::user()->image;
            $users_image_path = getDefaultimgagepath($auth_user_image,'users');
          ?>

          
            
          <img class="avatar headerAvatar pull-left" src="{{ $users_image_path }}" width="40" height="40" alt="avatar">
        
            <div class="userTop pull-left">
                <span class="headerUserName"> @lang('main.home.hi'), <?php $user_name = Auth::user()->name ?> {{ ucwords($user_name)  }}</span> <span class="fa fa-angle-down"></span>
            </div>
            <div class="clearfix"></div>
        </a>
        <div class="dropdown-menu pull-right userMenu" role="menu">
           <?php $user_id = Auth::user()->id ?>
            <div class="mobAvatar">
            
            <img class="avatar headerAvatar pull-left" src="{{$users_image_path}}" width="40" height="40" alt="avatar">
          
                <div class="mobAvatarName"><b>{{ $user_name  }}</b></div>
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
      </a></li>
      
       
      @else
     
       <li class="togglelogin"><a href="javascript:void(0);" onclick="openModal();" class="cd-signin get-listed">@lang('main.home.join-signin')</a>
      </li>

      @endif

      </ul>
    
     
      @include('home-pages.common.login-modal')

</div>

 <script type="text/javascript">
   function openLogin() {
      $('#redirect_url').val('{{route("properties.create" )}}')
      $('#login-modal').modal('toggle');
   }

    function openModal() {
      $('#login-modal').modal('toggle');
   }
</script>