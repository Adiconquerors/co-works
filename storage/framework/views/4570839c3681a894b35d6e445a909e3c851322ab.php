<?php $request = app('Illuminate\Http\Request'); ?>
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
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.navigation'); ?>
                </li>
                <li class="has_sub">
                    <a href="<?php echo e(route( 'dashboard' )); ?>" class="waves-effect">
                        <i class="fas fa-fw fa-tachometer-alt">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.dashboard.dashboard'); ?>
                        </span>
                    </a>
                </li>

                 <li class="has_sub sty-dn">
                    <a href="<?php echo e(route( 'get.profile' )); ?>" class="waves-effect">
                        <i class="fas fa-list-ul">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.dashboard.profile'); ?>
                        </span>
                    </a>
                </li>



            <!-- Landlord Permissions-->

             <?php if( isLandLord() ): ?>
                    <?php

                        $auth_id = \Auth::id();


                        $listings = \App\Property::where('customer_id', $auth_id)->get();
                        $listings_count = $listings->count();

                    ?>
                   <li class="has_sub">
                        <a href="<?php echo e(route( 'properties.index' )); ?>" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.listing'); ?>
                            </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="<?php echo e(route( 'getconnect' )); ?>" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span><?php echo app('translator')->getFromJson('others.connect'); ?></span>
                        </a>
                    </li>

            <?php endif; ?>

            <!--End Landlord Permissions -->


            <!-- Customer Permissions-->

            <?php if( isCustomer() ): ?>
                    <?php

                        $auth_id = \Auth::id();
                        $enquires = \App\Enquire::where('customer_id', $auth_id)->get();
                        $enquires_count = $enquires->count();

                        $listings = \App\Property::where('customer_id', $auth_id)->get();
                        $listings_count = $listings->count();

                    ?>

                <li class="has_sub">
                    <a href="<?php echo e(route( 'properties.list' )); ?>" class="waves-effect">
                        <i class="fa fa-search icon-om">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.search-for-space'); ?>
                        </span>
                    </a>
                  </li>

                   <li class="has_sub">
                    <a href="<?php echo e(route( 'leads.index' )); ?>" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.inquiries'); ?>
                        </span>
                    </a>
                  </li>

                   <li>
                        <a href="<?php echo e(route( 'unpaid.invoices' )); ?>">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              <span>
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.unpaid-invoices'); ?>
                              </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo e(route( 'paid.invoices' )); ?>">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              <span>
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.paid-invoices'); ?>
                              </span>
                        </a>
                    </li>

                <li class="has_sub">
                        <a href="<?php echo e(route( 'getconnect' )); ?>" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span><?php echo app('translator')->getFromJson('others.connect'); ?></span>
                        </a>
                    </li>

                <?php if( $listings_count > 0 ): ?>
                   <li class="has_sub">
                        <a href="<?php echo e(route( 'properties.index' )); ?>" class="waves-effect ">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.listing'); ?>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

           <!-- End Customer Permissions-->


      <!-- Admin Permissions -->
         <?php if( isAdmin() ): ?>
            <!-- Space types and membership fees -->

                <li class="has_sub">
                        <a href="<?php echo e(route( 'properties.index' )); ?>" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.listing'); ?>
                            </span>
                        </a>
                    </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.spacetypes'); ?>
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'membership_fees.index' )); ?>">
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.membershipfees'); ?>
                            </a>
                        </li>

                         <li>
                            <a href="<?php echo e(route( 'space_types.index' )); ?>">
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.spacetypes'); ?>
                            </a>
                        </li>

                    </ul>
                </li>

                <!--End Space types and membership fees -->

                <li class="has_sub">
                    <a href="<?php echo e(route( 'enquire.index' )); ?>" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.lead-crm'); ?>
                        </span>
                    </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.deal-tracker'); ?>
                        </span>

                          <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'dealtracker.bookinginitiated' )); ?>">
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.booking-initiated'); ?>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('dealtracker.dealscompleted')); ?>">
                                <?php echo app('translator')->getFromJson('custom.dashboard.deals-completed'); ?>
                            </a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fas fa-columns">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.client-dashboard'); ?>
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'clients.dashboard' )); ?>">
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.members'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route( 'paid.invoices' )); ?>">
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.paymenthistory'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route( 'unpaid.invoices' )); ?>">
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.unpaid-invoices'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-view-dashboard">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.provider-dashboard'); ?>
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'providers.dashboard' )); ?>">
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.providers'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                

                   <li class="has_sub">
                    <a href="<?php echo e(route( 'leads.index' )); ?>" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.leads'); ?>
                        </span>
                    </a>
                  </li>

                <li class="has_sub">
                    <a href="<?php echo e(route( 'venues.index' )); ?>" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.venues'); ?>
                        </span>
                    </a>
                </li>

            <li class="has_sub">
                <a href="<?php echo e(route( 'leads.create' )); ?>" class="waves-effect">
                    <i class="fas fa-user-tie">
                    </i>
                    <span>
                        <?php echo app('translator')->getFromJson('custom.adminsidebar.add-lead'); ?>
                    </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="<?php echo e(route( 'templates.index' )); ?>" class="waves-effect">
                    <i class="fas fa-envelope">
                    </i>
                    <span>
                        <?php echo app('translator')->getFromJson('custom.adminsidebar.email-templates'); ?>
                    </span>
                </a>
            </li>

               <li class="has_sub">
                <a href="<?php echo e(route( 'internal_notifications.index' )); ?>" class="waves-effect">
                    <i class="fas fa-bell">
                    </i>
                    <span>
                        <?php echo app('translator')->getFromJson('custom.adminsidebar.notifications'); ?>
                    </span>
                </a>
            </li>


            <li class="has_sub">
                <a href="<?php echo e(route('users.index')); ?>" class="waves-effect">
                    <i class="fas fa-users-cog">
                    </i>
                    <span>
                        <?php echo app('translator')->getFromJson('custom.adminsidebar.users'); ?>
                    </span>
                </a>
            </li>

           

            <li>
                <a href="<?php echo e(url('/admin/master_settings')); ?>">
                    <i class="fas fa-cogs"></i>
                    <span>  <?php echo app('translator')->getFromJson('custom.adminsidebar.master-settings'); ?></span>
                </a>
            </li>

             <li>
                <a href="<?php echo e(route('menus.index')); ?>">
                    <i class="fa fa-bars"></i>
                    <span> <?php echo app('translator')->getFromJson('custom.adminsidebar.menus'); ?></span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('currencies.index')); ?>">
                    <i class="fas fa-money-check-alt"></i>
                    <span><?php echo app('translator')->getFromJson('global.currencies.title'); ?></span>
                </a>
            </li>


            <li>
                <a href="<?php echo e(URL_TRANSLATIONS); ?>">
                    <i class="fas fa-language"></i>
                    <span><?php echo app('translator')->getFromJson('custom.translations.title'); ?></span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.languages.index')); ?>">
                    <i class="fas fa-sign-language"></i>
                    <span><?php echo app('translator')->getFromJson('global.languages.title'); ?></span>
                </a>
            </li>



            <!-- Extra Menu -->
            <li class="menu-title">
                <?php echo app('translator')->getFromJson('custom.adminsidebar.extras'); ?>
            </li>
            <li class="has_sub">
                <a href="<?php echo e(route( 'articles.index' )); ?>" class="waves-effect">
                    <i class="fas fa-newspaper">
                    </i>
                </i>
                <span>
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.articles'); ?>
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="<?php echo e(route( 'testimonials.index' )); ?>" class="waves-effect">
                <i class="fas fa-comments">
                </i>
                <span>
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.testimonials'); ?>
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="<?php echo e(route( 'icon.index' )); ?>" class="waves-effect">
                <i class="fas fa-users-cog">
                </i>
                <span>
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.icons'); ?>
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="<?php echo e(route( 'amenities.index' )); ?>" class="waves-effect">
                <i class="fas fa-shopping-bag">
                </i>
                <span>
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.amenities'); ?>
                </span>
            </a>
        </li>
        <li class="has_sub">
            <a href="<?php echo e(route('our_clients.index')); ?>" class="waves-effect">
                <i class="fas fa-users">
                </i>
                <span>
                    <?php echo app('translator')->getFromJson('custom.adminsidebar.our-clients'); ?>
                </span>
            </a>
        </li>
    <?php endif; ?>

  <!-- End Admin Permissions -->

  <!-- Agent Permissions -->
         <?php if( isAgent() ): ?>

             <li class="has_sub">
                        <a href="<?php echo e(route( 'properties.index' )); ?>" class="waves-effect">
                            <i class="fas fa-list-ul">
                            </i>
                            <span>
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.listing'); ?>
                            </span>
                        </a>
                    </li>



                <li class="has_sub">
                    <a href="<?php echo e(route( 'enquire.index' )); ?>" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                           <?php echo app('translator')->getFromJson('custom.adminsidebar.lead-crm'); ?>
                        </span>
                    </a>
                </li>
                <!-- Deal tracker premission for agent or employee -->
                  <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="far fa-handshake">
                        </i>
                        <span>
                             <?php echo app('translator')->getFromJson('custom.adminsidebar.deal-tracker'); ?>
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'dealtracker.bookinginitiated' )); ?>">
                               <?php echo app('translator')->getFromJson('custom.adminsidebar.booking-initiated'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('dealtracker.dealscompleted')); ?>">
                                <?php echo app('translator')->getFromJson('custom.dashboard.deals-completed'); ?>
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
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.provider-dashboard'); ?>
                        </span>
                        <span class="menu-arrow">
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route( 'providers.dashboard' )); ?>">
                                <?php echo app('translator')->getFromJson('custom.adminsidebar.providers'); ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="<?php echo e(route( 'leads.index' )); ?>" class="waves-effect">
                        <i class="far fa-address-card">
                        </i>
                        <span>
                            <?php echo app('translator')->getFromJson('custom.adminsidebar.leads'); ?>
                        </span>
                    </a>
                  </li>

                <li class="has_sub">
                    <a href="<?php echo e(route( 'venues.index' )); ?>" class="waves-effect">
                        <i class="fas fa-network-wired">
                        </i>
                        <span>
                             <?php echo app('translator')->getFromJson('custom.adminsidebar.venues'); ?>
                        </span>
                    </a>
                </li>
            <li class="has_sub">
                <a href="<?php echo e(route( 'leads.create' )); ?>" class="waves-effect">
                    <i class="fas fa-user-tie">
                    </i>
                    <span>
                         <?php echo app('translator')->getFromJson('custom.adminsidebar.add-lead'); ?>
                    </span>
                </a>
            </li>
            <li class="has_sub">
                <a href="<?php echo e(route( 'templates.index' )); ?>" class="waves-effect">
                    <i class="fas fa-envelope">
                    </i>
                    <span>
                        <?php echo app('translator')->getFromJson('custom.adminsidebar.email-templates'); ?>
                    </span>
                </a>
            </li>
         <?php endif; ?>
    <!-- Sidebar -->