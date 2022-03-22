<?php
  $articles  = \App\Article::get();
?>

<style>
    .sty-ote{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .sty-h50{
        height: 50px;
    }
    .sty-mt10{
        margin-top:-10px;
    }
    .sty-cp{
        cursor: pointer;
    }
    .sty-dn{
        display: none;
    }
</style>

<div id="hero-container-blog">
    <?php
      $im_path = PUBLIC_ASSETS.'images/default-imgs/noimfound.png';    
      
    ?>
 @if (count($articles) > 0)
   <div id="carouselBlog" class="carousel slide featured" data-ride="carousel">    
     @else
   <div id="carouselBlog" class="carousel slide featured" data-ride="carousel" style="background: url({{ $im_path }}) no-repeat center center fixed;  background-size: cover;">
   @endif 
   @if (count($articles) > 0)  
   <ol class="carousel-indicators">
       @foreach( $articles as $art )
       <li data-target="#carouselBlog" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif"></li>
       @endforeach
   </ol>
 <div class="carousel-inner">
     @foreach( $articles as $art )
      <?php
       $image_path = IMAGE_PATH_UPLOAD_ARTICLES . $art->image;
       $authors  = \App\User::find($art->author_id);
      ?>

     <div class="item @if($loop->first) active @endif" style="background-image: url({{ $image_path }})">
         <div class="container">
             <div class="carousel-caption">
                 <div class="carousel-title">{{$art->name}}</div>

                <div class="caption-title">{{$art->article_heading }}</div>
                
                <div class="caption-subtitle">{{ $art->description }} </div>

                 <a href="{{route('each.article',$art->id)}}" class="btn btn-enquire-solid Res_Btn">@lang('main.blog.read-more')</a>
             </div>
             <div class="avatar-caption">
                <?php
                    $authors_img_path = getDefaultimgagepath($authors->image,'users');                    

                ?>
                @if( $authors )
                 <img src="{{ $authors_img_path }}" alt="avatar">
                @endif
                
                 <div class="ac-user">
                     <div class="ac-name">{{ $authors ? $authors->name : '-' }}  @lang('main.blog.on')
                      {{ $art->created_at->format('d M , Y') }}
                     </div>
                     <div class="ac-title">{{ $authors ? $authors->job_role : '-' }}</div>
                 </div>
                 <div class="clearfix"></div>
             </div>
         </div>
     </div>
     @endforeach
 </div>
 <a class="left carousel-control" href="#carouselBlog" role="button" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
 <a class="right carousel-control" href="#carouselBlog" role="button" data-slide="next"><span class="fa fa-chevron-right"></span></a>
 @endif
</div>



   <!-- Header -->
   <div class="home-header">
    <?php
         $site_logo = getSetting('site_logo','site_settings');
         $sitelogo_path = getFaviconSiteLogo('','settings',$site_logo); 
    ?>
      <div class="home-logo osLight">
         <a href="{{ url('/') }}">
           
         <img src="{{$sitelogo_path}}" alt="{{getSetting('site_title','site_settings')}}" class="sty-h50">
      
         </a>
      </div>
      <a href="#" class="home-navHandler visible-xs"><span class="fa fa-bars"></span></a>
      <a href="javascript:void(0);" class="toggle-search"><span class="fa fa-search"></span></a>
      <div class="blog-nav">
         <ul>

            @if( !Auth::user() )
                <li><a href="{{ url('/') }}">@lang('main.blog.home')</a></li>
            @else
                <li><a href="{{ route('dashboard') }}">@lang('custom.dashboard.dashboard')</a></li>
            @endif

            @if( Auth::check() )
            <li><a href="{{ route('properties.create') }}" class="btn btn-green isThemeBtn sty-mt10">@lang('main.blog.list-a-property')</a></li>
            @else
            <li><a href="javascript:void(0);" class="btn btn-green isThemeBtn sty-mt10" onclick="openLogin();">@lang('main.blog.list-a-property')</a></li>
            @endif

            @if( !Auth::user() )
            <li><a data-toggle="modal" data-target="#blog-signup" class="sty-cp">@lang('main.blog.sign-up')</a></li>
            <li><a data-toggle="modal" data-target="#blog-signin" class="sty-cp">@lang('main.blog.sign-in')</a></li>
            @else
            <li><a href="{{ route('logout_test') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="btn btn-green isThemeBtn sty-mt10" >{{ __('Logout') }}</a>

            <form id="logout-form" action="{{ route('logout_test') }}" method="POST" class="sty-dn">
             @csrf
            </form>
           </li>
            @endif



         </ul>
      </div>
   </div>

</div>  </ul>
      </div>
   </div>

</div>

<script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script> 
<script src="{{ PUBLIC_ASSETS }}js/select2/4.0.8/select2.min.js"></script>



 <script type="text/javascript">
   function openLogin() {
      $('#redirect_url').val('{{route("properties.create" )}}')
      $('#signin').modal('toggle');
   }
</script>

