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
<html lang="<?php echo e($lang); ?>" dir="<?php echo e($direction); ?>">
   <head>
      <!-- Required meta tags -->
      <?php echo $__env->make( 'partials.newadmin.head', compact('lang', 'direction') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
      <a href="<?php echo e(route('dashboard')); ?>" class="logo">
        
      <span>
         <img src="<?php echo e($default_site_logo_path); ?>" alt="" class="site-logoimg">
      </span>
        
          <i>
          <img src="<?php echo e($site_favicon_path); ?>" alt="" class="site-favin">
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

            <?php if( isAdmin() ): ?> 
            
            <select class="searchable-field form-control sty-dn" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.searching'); ?>"></select>
            <?php endif; ?>
            <!-- Right(Notification) -->
            <ul class="nav navbar-right navbar-right-social">
               <li class="notificationss-menu">
                  <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                   
                    <?php ($notificationCount = \Auth::user()->internalNotifications()->where('read_at', null)->count()); ?>

                    <?php if($notificationCount > 0): ?>
                          <span class="badge up badge-success badge-pill">
                            <?php echo e($notificationCount); ?>

                        </span>
                     <?php endif; ?> 

                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                     <li>
                        <h5><?php echo app('translator')->getFromJson('custom.eforms.notifications'); ?></h5>
                     </li>
                     <?php if(count($notifications = \Auth::user()->internalNotifications()->get()) > 0): ?>
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li class="notification-link <?php echo e($notification->pivot->read_at === null ? "unread" : false); ?>">
                                  <a href="<?php echo e($notification->link ? $notification->link : "#"); ?>"
                                     class="user-list-item <?php echo e($notification->link ? 'is-link' : false); ?>">
                                     <div class="user-desc">
                                           <span class="name"><?php echo e($notification->text); ?></span>
                                        
                                     </div>
                                       
                                  </a>

                              </li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php else: ?>
                                  <li class="notification-link sty-tc">
                                       <?php echo app('translator')->getFromJson('custom.eforms.no-notifications'); ?>
                                    </li>
                                    

                     <?php endif; ?> 
                 
                  </ul>
               </li>
              


                <?php 
                  $languages = getLanguages();
                  $languages_arr = array();
                  
                ?>
               <li>
                  <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-language"></i>
                  <span class="badge up badge-success badge-pill"><?php echo e(strtoupper(\App::getLocale())); ?></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                     <li>
                        <h5><?php echo app('translator')->getFromJson('custom.eforms.languages'); ?></h5>
                     </li>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php                            
                            $languages_arr[ $language->code ] = $language->language;
                            ?>
                     <li>
                       
                        <a href="<?php echo e(route('admin.language', $language->code)); ?>" class="user-list-item">
                           <div class="user-desc">
                              <span class="name"> <?php echo e($language->language); ?> (<?php echo e(strtoupper($language->code)); ?>)</span>
                              
                           </div>
                        </a>
                        
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                   
                  <img src="<?php echo e($default_im_path); ?>" alt="user-img" class="rounded-circle user-img">
                   
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                     <li>
                        <h5><?php echo app('translator')->getFromJson('custom.dashboard.hi'); ?>, <?php echo e($auth_user_name); ?></h5>
                     </li>
                    
                     <li><a href="<?php echo e(url('/')); ?>" class="dropdown-item"><i class="ti-home m-r-5"></i> <?php echo app('translator')->getFromJson('custom.dashboard.home'); ?> </a></li>
                 
                     <li><a href="<?php echo e(route('get.profile')); ?>" class="dropdown-item"><i class="ti-user m-r-5"></i> <?php echo app('translator')->getFromJson('custom.dashboard.profile'); ?></a></li>
                       <li><a href="<?php echo e(route('auth.change_password')); ?>" class="dropdown-item"><i class="ti-home m-r-5"></i> <?php echo app('translator')->getFromJson('custom.dashboard.change-password'); ?> </a></li>
                   
                     <li>
                      <a href="<?php echo e(route('logout_test')); ?>" class="dropdown-item"  onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-5"></i>  <?php echo e(__('Logout')); ?></a>
                              <form id="logout-form" action="<?php echo e(route('logout_test')); ?>" method="POST" class="sty-dn">
                                <?php echo csrf_field(); ?>
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
              <?php echo $__env->make('partials.newadmin.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

                    <?php if( isDemo() ): ?> 
                    <div class="alert alert-info">
                    <?php echo app('translator')->getFromJson('custom.messages.crud_disabled'); ?>
                    </div> 
                    <?php endif; ?> 

                  <?php
                    $parts = getController();

                    if( env('APP_DEV') ) {
                        echo $parts['controller'] . '@' . $parts['action'] . ' ' . date('d-m-Y H:i:s');
                    }
                    ?>
                  <?php echo $__env->yieldContent( 'new_content' ); ?>
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            <?php echo $__env->make( 'partials.newadmin.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php
               $is_admin = isAdmin();
            ?>

           <?php if( ($is_admin) && ! in_array($parts['controller'], ['SmsGatewaysController', 'PaymentGatewaysController']) ): ?>
             <?php echo $__env->make( 'partials.newadmin.common.visits-shortlist' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php endif; ?>
         </div>

         <!-- Right sliding forms -->
         <!--feedback-form-->

         <!--feedback-form-->
         <!-- /Right Sliding Forms -->
      </div>
      <!-- END wrapper -->
      <?php echo $__env->make( 'partials.newadmin.javascripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.shortlist-area-modal-scripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.visit-area-modal-loading-scripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   </body>
</html>