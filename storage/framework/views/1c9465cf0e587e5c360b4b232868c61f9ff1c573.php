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
                  <input type="text" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.enter-location'); ?>">
                  <div class="clearfix"></div>
               </div>
               <ul>
                 

                  <?php if( Auth::user() ): ?>
                  <li class="togglelogin sty-dn"><a href="javacsript:void(0);"><span class="navIcon icon-login"></span><span class="navLabel"><?php echo app('translator')->getFromJson('main.sidebar.login-signup'); ?></span></a></li>
                  <?php else: ?>
                  <li class="togglelogin"><a href="javacsript:void(0);" onclick="openExplore();"><span class="navIcon icon-login"></span><span class="navLabel"><?php echo app('translator')->getFromJson('main.sidebar.login-signup'); ?></span></a></li>
                  <?php endif; ?>

                <?php if( Auth::check() ): ?>
                  <li class="">
                 <a href="<?php echo e(route( 'properties.create' )); ?>"><span class="navIcon icon-globe"></span><span class="navLabel"><?php echo app('translator')->getFromJson('custom.eforms.list-space'); ?></span></a>
                  </li>
                  <?php else: ?>
                  <li class="togglelogin">
                 <a href="javascript:void(0);" onclick="openLogin();"><span class="navIcon icon-globe"></span><span class="navLabel"><?php echo app('translator')->getFromJson('main.sidebar.list-your-space'); ?></span></a>
                  </li>
                  <?php endif; ?>  

              <?php
                $menus = \App\Menu::where('type','sidebar')->get();
              ?> 
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e($menu->link ?? 'javascript:void(0);'); ?>" target="_blank" <?php if($menu->link): ?> target="_blank" <?php else: ?> "" <?php endif; ?>><span class="navIcon <?php echo e($menu->icon->name); ?>"></span> <span class="navLabel"><?php echo e($menu->text ?? ''); ?></span></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
  
               </ul>
            </div>
         </nav>
      </div>


  
<script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script> <!-- previously used jquery 1.11.1 -->




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