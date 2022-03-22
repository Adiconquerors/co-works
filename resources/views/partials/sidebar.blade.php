<style>
    .sty-cbt{
        color: #c1ab77; background-color: transparent;
    }
    .sty-mlmtmb{
        width: 65%;
        }.sty-dn{
            display: none;
        }
</style>
<!-- sidebar -->
<ul id="gn-menu" class="gn-menu-main">
    <li class="gn-trigger">
        <a class="gn-icon gn-icon-menu sty-cbt"><span>@lang('main.sidebar.menu')</span></a>
        <nav class="gn-menu-wrapper">
            <div class="gn-scroller">
                    <ul class="gn-menu">
                        <li>
                    <?php
                        $site_logo = getSetting('site_logo','site_settings');
                        $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
                    ?>                    
                     <img src="{{$default_site_logo_path}}"   class="sty-mlmtmb"></li> 
   
                     <li><a href="{{route('properties.list')}} "><i class="fa fa-search icon-om"></i> @lang('main.sidebar.search-for-space')</a></li>
                    
                    @if( Auth::user() )
                    <li class="togglelogin sty-dn"><a href="javascript:void(0);"><i class="fa fa-sign-in icon-om"></i> @lang('main.sidebar.login-signup')</a></li>
                    @else
                    <li class="togglelogin"><a href="javascript:void(0);" onclick="openModal();"><i class="fa fa-sign-in icon-om"></i> @lang('main.sidebar.login-signup')</a></li>
                    @endif

                    
                @if( Auth::check() )
                <li class="">
                <a href="{{route('properties.create')}}"><i class="fa fa-globe icon-om"></i> @lang('main.sidebar.list-your-space')</a>
                </li>
                @else
                <li class="togglelogin">
                <a href="javascript:void(0)" onclick="openLogin();"><i class="fa fa-globe icon-om"></i> @lang('main.sidebar.list-your-space')</a>
                </li>
                @endif
                    
                <!-- Menues -->
                <?php
                    $menus = \App\Menu::where('type','sidebar')->get();
                ?> 
                @foreach( $menus as $menu )
                    <li><a href="{{ $menu->link ?? 'javascript:void(0);' }}"><i class="{{ $menu->icon->name }} icon-om"></i> {{ $menu->text ?? '' }}</a></li>
                @endforeach    

                </ul>
            </div><!-- /gn-scroller -->
        </nav>
    </li>
</ul>
<!-- /sidebar -->
