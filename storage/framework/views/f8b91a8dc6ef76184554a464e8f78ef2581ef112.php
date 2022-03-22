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
        <a class="gn-icon gn-icon-menu sty-cbt"><span><?php echo app('translator')->getFromJson('main.sidebar.menu'); ?></span></a>
        <nav class="gn-menu-wrapper">
            <div class="gn-scroller">
                    <ul class="gn-menu">
                        <li>
                    <?php
                        $site_logo = getSetting('site_logo','site_settings');
                        $default_site_logo_path = getFaviconSiteLogo('','settings',$site_logo);
                    ?>                    
                     <img src="<?php echo e($default_site_logo_path); ?>"   class="sty-mlmtmb"></li> 
   
                     <li><a href="<?php echo e(route('properties.list')); ?> "><i class="fa fa-search icon-om"></i> <?php echo app('translator')->getFromJson('main.sidebar.search-for-space'); ?></a></li>
                    
                    <?php if( Auth::user() ): ?>
                    <li class="togglelogin sty-dn"><a href="javascript:void(0);"><i class="fa fa-sign-in icon-om"></i> <?php echo app('translator')->getFromJson('main.sidebar.login-signup'); ?></a></li>
                    <?php else: ?>
                    <li class="togglelogin"><a href="javascript:void(0);" onclick="openModal();"><i class="fa fa-sign-in icon-om"></i> <?php echo app('translator')->getFromJson('main.sidebar.login-signup'); ?></a></li>
                    <?php endif; ?>

                    
                <?php if( Auth::check() ): ?>
                <li class="">
                <a href="<?php echo e(route('properties.create')); ?>"><i class="fa fa-globe icon-om"></i> <?php echo app('translator')->getFromJson('main.sidebar.list-your-space'); ?></a>
                </li>
                <?php else: ?>
                <li class="togglelogin">
                <a href="javascript:void(0)" onclick="openLogin();"><i class="fa fa-globe icon-om"></i> <?php echo app('translator')->getFromJson('main.sidebar.list-your-space'); ?></a>
                </li>
                <?php endif; ?>
                    
                <!-- Menues -->
                <?php
                    $menus = \App\Menu::where('type','sidebar')->get();
                ?> 
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e($menu->link ?? 'javascript:void(0);'); ?>"><i class="<?php echo e($menu->icon->name); ?> icon-om"></i> <?php echo e($menu->text ?? ''); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    

                </ul>
            </div><!-- /gn-scroller -->
        </nav>
    </li>
</ul>
<!-- /sidebar -->
