@inject('request', 'Illuminate\Http\Request')
    <style>
    .sty-dn{
      display:none;
    }
    .slimScrollBar {
         position: fixed;
    width: 15px!important;
    height: auto;
    max-height: auto;
    overflow-x: hidden;
}
    .slimScrollBar::-webkit-scrollbar {
    width: 2em;
}
 
.slimScrollBar::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
.slimScrollBar::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
</style>
      <!--- Sidemenu -->
        
             <li class="menu-title">
                    @lang('custom.adminsidebar.navigation')
                </li>
                <li class="has_sub">
                    <a href="{{ route( 'dashboard' ) }}" class="waves-effect">
                        <i class="fas fa-fw fa-tachometer-alt">
                        </i>
                        <span>
                            @lang('custom.dashboard.dashboard')
                        </span>
                    </a>
                </li>

                 <li class="has_sub sty-dn">
                    <a href="{{ route( 'get.profile' ) }}" class="waves-effect">
                        <i class="fas fa-list-ul">
                        </i>
                        <span>
                            @lang('custom.dashboard.profile')
                        </span>
                    </a>
                </li>



            <!-- Landlord Permissions-->

             @if( isLandLord() )
                    <?php

                        $auth_id = \Auth::id();


                        $listings = \App\Property::where('customer_id', $auth_id)->get();
                        $listings_count = $listings->count();

                    ?>
                   <li class="has_sub">
                        <a href="{{ route( 'properties.index' ) }}" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                @lang('custom.adminsidebar.listing')
                            </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="{{ route( 'getconnect' ) }}" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>@lang('others.connect')</span>
                        </a>
                    </li>

            @endif

            <!--End Landlord Permissions -->


            <!-- Customer Permissions-->

            @if( isCustomer() )
                    <?php

                        $auth_id = \Auth::id();
                        $enquires = \App\Enquire::where('customer_id', $auth_id)->get();
                        $enquires_count = $enquires->count();

                        $listings = \App\Property::where('customer_id', $auth_id)->get();
                        $listings_count = $listings->count();

                    ?>

                <li class="has_sub">
                    <a href="{{ route( 'properties.list' ) }}" class="waves-effect">
                        <i class="fa fa-search icon-om">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.search-for-space')
                        </span>
                    </a>
                  </li>

                   <li class="has_sub">
                    <a href="{{ route( 'leads.index' ) }}" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.inquiries')
                        </span>
                    </a>
                  </li>

                   <li>
                        <a href="{{ route( 'unpaid.invoices' ) }}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              <span>
                               @lang('custom.adminsidebar.unpaid-invoices')
                              </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route( 'paid.invoices' ) }}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              <span>
                               @lang('custom.adminsidebar.paid-invoices')
                              </span>
                        </a>
                    </li>

                <li class="has_sub">
                        <a href="{{ route( 'getconnect' ) }}" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>@lang('others.connect')</span>
                        </a>
                    </li>

                @if( $listings_count > 0 )
                   <li class="has_sub">
                        <a href="{{ route( 'properties.index' ) }}" class="waves-effect ">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                @lang('custom.adminsidebar.listing')
                            </span>
                        </a>
                    </li>
                @endif

            @endif

           <!-- End Customer Permissions-->


      <!-- Admin Permissions -->
         @if( isAdmin() )
            <!-- Space types and membership fees -->

                <li class="has_sub">
                        <a href="{{ route( 'properties.index' ) }}" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                @lang('custom.adminsidebar.listing')
                            </span>
                        </a>
                    </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.spacetypes')
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <!-- <li>
                            <a href="{{ route( 'membership_fees.index' ) }}">
                               @lang('custom.adminsidebar.membershipfees')
                            </a>
                        </li> -->

                         <li>
                            <a href="{{ route( 'space_types.index' ) }}">
                               @lang('custom.adminsidebar.spacetypes')
                            </a>
                        </li>

                    </ul>
                </li>

                <!--End Space types and membership fees -->

                <li class="has_sub">
                    <a href="{{ route( 'enquire.index' ) }}" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.lead-crm')
                        </span>
                    </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.deal-tracker')
                        </span>

                          <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route( 'dealtracker.bookinginitiated' ) }}">
                               @lang('custom.adminsidebar.booking-initiated')
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dealtracker.dealscompleted') }}">
                                @lang('custom.dashboard.deals-completed')
                            </a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fas fa-columns">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.client-dashboard')
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route( 'clients.dashboard' ) }}">
                                @lang('custom.adminsidebar.members')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route( 'paid.invoices' ) }}">
                                @lang('custom.adminsidebar.paymenthistory')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route( 'unpaid.invoices' ) }}">
                               @lang('custom.adminsidebar.unpaid-invoices')
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-view-dashboard">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.provider-dashboard')
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route( 'providers.dashboard' ) }}">
                                @lang('custom.adminsidebar.providers')
                            </a>
                        </li>
                    </ul>
                </li>
                {{--
                <li class="has_sub">
                    <a href="{{ route( 'bookings' ) }}" class="waves-effect">
                        <i class="fas fa-chalkboard-teacher">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.booking-visits')
                        </span>
                    </a>
                </li>
                --}}

                   <li class="has_sub">
                    <a href="{{ route( 'leads.index' ) }}" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.leads')
                        </span>
                    </a>
                  </li>

                <li class="has_sub">
                    <a href="{{ route( 'venues.index' ) }}" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.venues')
                        </span>
                    </a>
                </li>

            <li class="has_sub">
                <a href="{{ route( 'leads.create' ) }}" class="waves-effect">
                    <i class="fas fa-user-tie">
                    </i>
                    <span>
                        @lang('custom.adminsidebar.add-lead')
                    </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="{{ route( 'templates.index' ) }}" class="waves-effect">
                    <i class="fas fa-envelope">
                    </i>
                    <span>
                        @lang('custom.adminsidebar.email-templates')
                    </span>
                </a>
            </li>

               <li class="has_sub">
                <a href="{{ route( 'internal_notifications.index' ) }}" class="waves-effect">
                    <i class="fas fa-bell">
                    </i>
                    <span>
                        @lang('custom.adminsidebar.notifications')
                    </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="{{ route('users.index') }}" class="waves-effect">
                    <i class="fas fa-users-cog">
                    </i>
                    <span>
                        @lang('custom.adminsidebar.users')
                    </span>
                </a>
            </li>

           

            <li>
                <a href="{{ url('/admin/master_settings') }}">
                    <i class="fas fa-cogs"></i>
                    <span>  @lang('custom.adminsidebar.master-settings')</span>
                </a>
            </li>

             <li>
                <a href="{{ route('menus.index') }}">
                    <i class="fa fa-bars"></i>
                    <span> @lang('custom.adminsidebar.menus')</span>
                </a>
            </li>

            <li>
                <a href="{{ route('currencies.index') }}">
                    <i class="fas fa-money-check-alt"></i>
                    <span>@lang('global.currencies.title')</span>
                </a>
            </li>


            <li>
                <a href="{{ URL_TRANSLATIONS }}">
                    <i class="fas fa-language"></i>
                    <span>@lang('custom.translations.title')</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fas fa-sign-language"></i>
                    <span>@lang('global.languages.title')</span>
                </a>
            </li>



            <!-- Extra Menu -->
            <li class="menu-title">
                @lang('custom.adminsidebar.extras')
            </li>
            <li class="has_sub">
                <a href="{{ route( 'articles.index' ) }}" class="waves-effect">
                    <i class="fas fa-newspaper">
                    </i>
                </i>
                <span>
                    @lang('custom.adminsidebar.articles')
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="{{ route( 'testimonials.index' ) }}" class="waves-effect">
                <i class="fas fa-comments">
                </i>
                <span>
                    @lang('custom.adminsidebar.testimonials')
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="{{ route( 'icon.index' ) }}" class="waves-effect">
                <i class="fas fa-users-cog">
                </i>
                <span>
                    @lang('custom.adminsidebar.icons')
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="{{ route( 'amenities.index' ) }}" class="waves-effect">
                <i class="fas fa-shopping-bag">
                </i>
                <span>
                    @lang('custom.adminsidebar.amenities')
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="{{ route('our_clients.index') }}" class="waves-effect">
                <i class="fas fa-users">
                </i>
                <span>
                    @lang('custom.adminsidebar.our-clients')
                </span>
            </a>
        </li>
    @endif

  <!-- End Admin Permissions -->

  <!-- Agent Permissions -->
         @if( isAgent() )

             <li class="has_sub">
                        <a href="{{ route( 'properties.index' ) }}" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                @lang('custom.adminsidebar.listing')
                            </span>
                        </a>
                    </li>



                <li class="has_sub">
                    <a href="{{ route( 'enquire.index' ) }}" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                           @lang('custom.adminsidebar.lead-crm')
                        </span>
                    </a>
                </li>
                <!-- Deal tracker premission for agent or employee -->
                  <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                             @lang('custom.adminsidebar.deal-tracker')
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route( 'dealtracker.bookinginitiated' ) }}">
                               @lang('custom.adminsidebar.booking-initiated')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dealtracker.dealscompleted') }}">
                                @lang('custom.dashboard.deals-completed')
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- end -->


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-view-dashboard">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.provider-dashboard')
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route( 'providers.dashboard' ) }}">
                                @lang('custom.adminsidebar.providers')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="{{ route( 'leads.index' ) }}" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            @lang('custom.adminsidebar.leads')
                        </span>
                    </a>
                  </li>

                <li class="has_sub">
                    <a href="{{ route( 'venues.index' ) }}" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                             @lang('custom.adminsidebar.venues')
                        </span>
                    </a>
                </li>
            <li class="has_sub">
                <a href="{{ route( 'leads.create' ) }}" class="waves-effect">
                    <i class="fas fa-user-tie">
                    </i>
                    <span>
                         @lang('custom.adminsidebar.add-lead')
                    </span>
                </a>
            </li>
            <li class="has_sub">
                <a href="{{ route( 'templates.index' ) }}" class="waves-effect">
                    <i class="fas fa-envelope">
                    </i>
                    <span>
                        @lang('custom.adminsidebar.email-templates')
                    </span>
                </a>
            </li>
         @endif
    <!-- Sidebar -->