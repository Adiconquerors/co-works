     <style>
        .sty-tc{
            text-align: center;
        }


     </style>
        <footer class="mastfoot">
        <div class="container sty-tc">

        <div class="row">
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">
                <?php
                 $site_logo = getSetting('site_logo','site_settings');
                 $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
                ?>
             <a class="mastfoot__logo" href="{{url('/')}}"><img src="{{ $default_site_logo_path }}" alt="Coworking"></a>
             <p>
            </div>
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">

             <p class="footer-list-title"> @lang('main.home.explore')</p>
                    <ul class="list-page-footer text-light">

                        <li><a class="text-link" href="{{ route('properties.list') }}">@lang('main.home.search')</a></li>
                        <li><a class="text-link" href="{{ url('about_us') }}">@lang('main.home.about-us')</a></li>
                        <li><a class="text-link" href="{{ url('blog') }}" target="_blank" class="text-link">@lang('main.home.blog')</a></li>
                        <li><a class="text-link" href="{{ url('how_it_works') }}">@lang('main.home.how-it-works')</a></li>


                    </ul>

            </div>
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">
                    <p class="footer-list-title">@lang('main.home.services')</p>

                    <ul class="list-page-footer text-light">
                      @php
                       $items = App\SpaceType::getSpaceTypes(0);
                      @endphp
                       @foreach( $items as $service )
                        <?php
                        $location = 'location=&wstype='.$service->id;
                        ?>
                        <li><a class="text-link"  href="{{ route('properties.list',$location) }}">{{ $service->name }}</a></li>
                        @endforeach

                    </ul>
            </div>
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">

                <?php
                    $footer_work_days = getSetting('footer_work_days','home-page-settings');
                    $footer_work_timings = getSetting('footer_work_timings','home-page-settings');
                    $contact_email = getSetting('contact_email','site_settings');
                    $country_code = getSetting('country_code','site_settings');
                    $site_phone = getSetting('site_phone','site_settings');
                    $rights_reserved = getSetting('rights_reserved','site_settings');
                    $skype_email = getSetting('skype_email','site_settings');
                    $whatsapp = getSetting('whatsapp','site_settings');
                    $site_link = getSetting('site_link','site_settings');
                ?>

               <p class="footer-list-title">@lang('main.home.connect')</p>
                    <ul class="list-page-footer text-light">
                        <li>
                            <div class="textwidget">
                                    <dl>
                                        <dt>
                                            <i class="fa fa-phone">
                                            </i>
                                           {{ $country_code }} {{ $site_phone }}
                                        </dt>
                                        <dd>
                                            <i class="fa fa-envelope">
                                            </i>
                                            {{ $contact_email }}
                                        </dd>
                                        <dt>
                                            <i class="fa fa-calendar-o">
                                            </i>
                                            {{ $footer_work_days }}
                                        </dt>
                                        <dd>
                                            <i class="fa fa-clock-o">
                                            </i>
                                           {{ $footer_work_timings }}
                                        </dd>
                                        <dt>
                                            <i class="fa fa-whatsapp">
                                            </i>
                                           {{ $country_code }} {{ $whatsapp }}
                                        </dt>
                                        <dd>
                                            <i class="fa fa-skype">
                                            </i>
                                           {{ $skype_email }}
                                        </dd>

                                        <dt>
                                    </dl>
                                </div>
                        </li>
                    </ul>



            </div>
        </div>

        </div>
        <!-- chatbox -->

        <!-- /chatbox -->
        <div class="bg--navy">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
         <p class="mastfoot__copy text-left">{{ $rights_reserved }}</p>
                    </div>
                    <div class="col-lg-6 col-xs-12">
            <ul class="mastfoot__links list-unstyled list-inline">
                        <li><a href="{{ $site_link }}" target="_blank">@lang('main.home.powered-by-cstpl')</a></li>
                        <li><a></a></li>
                        <li><a href="javascript:void(0);">@lang('main.home.payments-policy')</a></li>
                        <li><a href="javascript:void(0);">@lang('main.home.private-policy')</a></li>
                        <li><a href="javascript:void(0);">@lang('main.home.advertising')</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>

    </footer>

