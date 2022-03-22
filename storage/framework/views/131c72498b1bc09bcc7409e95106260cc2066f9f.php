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
  }
</style>


<div class="navbar-header">
   <!-- Collapsed Hamburger -->
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
      <span class="sr-only"><?php echo app('translator')->getFromJson('main.home.toggle-navigation'); ?></span>
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
     <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
     
            <img src="<?php echo e($default_site_logo_path); ?>" class="imnb-width" alt="<?php echo e(getSetting('site_title','site_settings')); ?>">
     </a>
</div>
    
<div class="collapse navbar-collapse" id="app-navbar-collapse">
   <ul class="nav navbar-nav navbar-right main-nav">
     
       <?php if( Auth::check() ): ?>
          <li class="">
          <a href="<?php echo e(route('properties.create')); ?>"><?php echo app('translator')->getFromJson('main.home.list-your-space'); ?></a>
          </li>
        <?php else: ?>
          <li class="togglelogin">
          <a href="javascript:void(0)" onclick="openLogin();"><?php echo app('translator')->getFromJson('main.home.list-your-space'); ?></a>
          </li>
        <?php endif; ?>
      
      <!-- Menues -->
      <?php
        $menus = \App\Menu::where('type','topbar')->get();
      ?>
      <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
        <li>
          <a href="<?php echo e($menu->link ?? 'javascript:void(0);'); ?>" ><?php echo e($menu->text ?? ''); ?></a>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
      <!-- End Menues -->

      <?php if( Auth::check() ): ?>
    
       <li><a href=""  class="headerUserWraper">
        <a href="javascript:void(0);" class="headerUser dropdown-toggle" data-toggle="dropdown">
          <?php
            $auth_user_image = Auth::user()->image;
            $users_image_path = getDefaultimgagepath($auth_user_image,'users');
          ?>

          
            
          <img class="avatar headerAvatar pull-left" src="<?php echo e($users_image_path); ?>" width="40" height="40" alt="avatar">
        
            <div class="userTop pull-left">
                <span class="headerUserName"> <?php echo app('translator')->getFromJson('main.home.hi'); ?>, <?php $user_name = Auth::user()->name ?> <?php echo e(ucwords($user_name)); ?></span> <span class="fa fa-angle-down"></span>
            </div>
            <div class="clearfix"></div>
        </a>
        <div class="dropdown-menu pull-right userMenu" role="menu">
           <?php $user_id = Auth::user()->id ?>
            <div class="mobAvatar">
            
            <img class="avatar headerAvatar pull-left" src="<?php echo e($users_image_path); ?>" width="40" height="40" alt="avatar">
          
                <div class="mobAvatarName"><b><?php echo e($user_name); ?></b></div>
            </div>
            <ul>
              <li><a href="<?php echo e(route('dashboard')); ?>"><span class="icon-user"></span><?php echo app('translator')->getFromJson('custom.dashboard.dashboard'); ?></a></li> 

                <li class="divider"></li>
                <li><a href="<?php echo e(route('logout_test')); ?>" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"><span class="icon-power"></span><?php echo e(__('Logout')); ?></a>

      <form id="logout-form" action="<?php echo e(route('logout_test')); ?>" method="POST" class="sty-dn">
      <?php echo csrf_field(); ?>
      </form>
             </li>
            </ul>
        </div>
      </a></li>
      
       
      <?php else: ?>
     
       <li class="togglelogin"><a href="javascript:void(0);" onclick="openModal();" class="cd-signin get-listed"><?php echo app('translator')->getFromJson('main.home.join-signin'); ?></a>
      </li>

      <?php endif; ?>

      </ul>
    
     
      <?php echo $__env->make('home-pages.common.login-modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>

 <script type="text/javascript">
   function openLogin() {
      $('#redirect_url').val('<?php echo e(route("properties.create" )); ?>')
      $('#login-modal').modal('toggle');
   }

    function openModal() {
      $('#login-modal').modal('toggle');
   }
</script>