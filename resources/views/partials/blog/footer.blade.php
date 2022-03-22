      <!-- Footer -->
<div class="home-footer">
<div class="home-wrapper">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header">@lang('main.blog.company')</div>
            <ul class="footer-nav pb20">
                <li><a href="{{ route('properties.list') }}">@lang('main.home.search')</a></li>
                <li><a href="{{ url('about_us') }}">@lang('main.home.about-us')</a></li>
                <li><a href="{{ url('blog') }}">@lang('main.home.blog')</a></li>
                <li><a href="{{ url('how_it_works') }}">@lang('main.home.how-it-works')</a></li>
            </ul>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header">@lang('main.home.types-of-spaces')</div>
          @php
          $items = App\SpaceType::getSpaceTypes(0);
          @endphp
            <ul class="footer-nav pb20">
                 @foreach( $items as $service )
                    <?php
                    $location = 'location=&wstype='.$service->id;
                    ?> 
                <li><a href="{{ route('properties.list',$location) }}">{{ $service->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

              <?php
                    $contact_email = getSetting('contact_email','site_settings');
                    $country_code = getSetting('country_code','site_settings');
                    $site_phone = getSetting('site_phone','site_settings');
                    $site_address = getSetting('site_address','site_settings');
                    $rights_reserved = getSetting('rights_reserved','site_settings');
                    $site_link = getSetting('site_link','site_settings');
                ?>

            <div class="osLight footer-header">@lang('main.blog.get-in-touch')</div>
            <ul class="footer-nav pb20">
                <li class="footer-phone"><span class="fa fa-phone"></span>  {{ $country_code }} {{ $site_phone }}</li>
                <li class="footer-address osLight">
                    <p>{{ $site_address }}</p>
                    <a href="javascript:void(0);" >{{ $contact_email }}</a>
                </li>
                <li><a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-facebook"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-twitter"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-google-plus"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-linkedin"></span></a> </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header">@lang('main.blog.subscribe-to-our-newsletter')</div>
            <form role="form" 
            id="suscribe_to_news_letter"
            method=POST
            >
                <div class="form-group">
                    <input type="email" id="blog_subscribe_email" class="form-control" placeholder="@lang('custom.listings.fields.email-address')" required>
                </div>
                <div class="form-group">
                    <button  class="btn btn-green btn-block isThemeBtn">@lang('main.blog.subscribe') 
                    </button>
                </div>
                <div id="subscribe_loader"></div>
            </form>
        </div>
    </div>
    <div class="row">
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="copyright">{{ $rights_reserved }}</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <a href="{{ $site_link }}" target="_blank">
        <div class="copyright">@lang('main.home.powered-by-cstpl')</div>
    </a>
</div>
</div>
</div>
</div>