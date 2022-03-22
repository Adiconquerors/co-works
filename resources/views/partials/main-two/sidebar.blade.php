<style>
    .sty-dn{
      display:none;
    }
</style>
<!-- Left Side Navigation -->
      <div id="leftSide" >
         <nav class="leftNav scrollable"> 
            <div class="row">
               <div class="search">
                  <span class="searchIcon icon-magnifier"></span>
                  <input type="text" placeholder="@lang('custom.listings.fields.enter-location')">
                  <div class="clearfix"></div>
               </div>
               <ul>
                 

                  @if( Auth::user() )
                  <li class="togglelogin sty-dn"><a href="javacsript:void(0);"><span class="navIcon icon-login"></span><span class="navLabel">@lang('main.sidebar.login-signup')</span></a></li>
                  @else
                  <li class="togglelogin"><a href="javacsript:void(0);" onclick="openExplore();"><span class="navIcon icon-login"></span><span class="navLabel">@lang('main.sidebar.login-signup')</span></a></li>
                  @endif

                @if( Auth::check() )
                  <li class="">
                 <a href="{{ route( 'properties.create' ) }}"><span class="navIcon icon-globe"></span><span class="navLabel">@lang('custom.eforms.list-space')</span></a>
                  </li>
                  @else
                  <li class="togglelogin">
                 <a href="javascript:void(0);" onclick="openLogin();"><span class="navIcon icon-globe"></span><span class="navLabel">@lang('main.sidebar.list-your-space')</span></a>
                  </li>
                  @endif  

              <?php
                $menus = \App\Menu::where('type','sidebar')->get();
              ?> 
                @foreach( $menus as $menu )
                    <li><a href="{{ $menu->link ?? 'javascript:void(0);' }}" target="_blank" @if($menu->link) target="_blank" @else "" @endif><span class="navIcon {{ $menu->icon->name }}"></span> <span class="navLabel">{{ $menu->text ?? '' }}</span></a></li>
                @endforeach   
  
               </ul>
            </div>
         </nav>
      </div>


  
<script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script> <!-- previously used jquery 1.11.1 -->




<script>
     $(".leftNav").hover(
           function () {
                  $(this).parent().addClass("expanded");
               }, 
                
               function () {
                  $(this).parent().removeClass("expanded");
               }
            
        );
                        
    // Exapnd left side navigation
    var navExpanded = false;
    $('.navHandler, .closeLeftSide').click(function() {
        if(!navExpanded) {
            $('.logo').addClass('expanded');
            $('#leftSide').addClass('expanded');
            if(windowWidth < 768) {
                $('.closeLeftSide').show();
            }
            $('.hasSub').addClass('hasSubActive');
            $('.leftNav').addClass('bigNav');
            if(windowWidth > 767) {
                $('.full').addClass('m-full');
            }
            windowResizeHandler();
            navExpanded = true;
        } else {
            $('.logo').removeClass('expanded');
            $('#leftSide').removeClass('expanded');
            $('.closeLeftSide').hide();
            $('.hasSub').removeClass('hasSubActive');
            $('.bigNav').slimScroll({ destroy: true });
            $('.leftNav').removeClass('bigNav');
            $('.leftNav').css('overflow', 'visible');
            $('.full').removeClass('m-full');
            navExpanded = false;
        }
    });
</script>