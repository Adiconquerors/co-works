      <!-- Footer -->
<div class="home-footer">
<div class="home-wrapper">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header"><?php echo app('translator')->getFromJson('main.blog.company'); ?></div>
            <ul class="footer-nav pb20">
                <li><a href="<?php echo e(route('properties.list')); ?>"><?php echo app('translator')->getFromJson('main.home.search'); ?></a></li>
                <li><a href="<?php echo e(url('about_us')); ?>"><?php echo app('translator')->getFromJson('main.home.about-us'); ?></a></li>
                <li><a href="<?php echo e(url('blog')); ?>"><?php echo app('translator')->getFromJson('main.home.blog'); ?></a></li>
                <li><a href="<?php echo e(url('how_it_works')); ?>"><?php echo app('translator')->getFromJson('main.home.how-it-works'); ?></a></li>
            </ul>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header"><?php echo app('translator')->getFromJson('main.home.types-of-spaces'); ?></div>
          <?php
          $items = App\SpaceType::getSpaceTypes(0);
          ?>
            <ul class="footer-nav pb20">
                 <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $location = 'location=&wstype='.$service->id;
                    ?> 
                <li><a href="<?php echo e(route('properties.list',$location)); ?>"><?php echo e($service->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            <div class="osLight footer-header"><?php echo app('translator')->getFromJson('main.blog.get-in-touch'); ?></div>
            <ul class="footer-nav pb20">
                <li class="footer-phone"><span class="fa fa-phone"></span>  <?php echo e($country_code); ?> <?php echo e($site_phone); ?></li>
                <li class="footer-address osLight">
                    <p><?php echo e($site_address); ?></p>
                    <a href="javascript:void(0);" ><?php echo e($contact_email); ?></a>
                </li>
                <li><a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-facebook"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-twitter"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-google-plus"></span></a> <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-round btn-o btn-white"><span class="fa fa-linkedin"></span></a> </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="osLight footer-header"><?php echo app('translator')->getFromJson('main.blog.subscribe-to-our-newsletter'); ?></div>
            <form role="form" 
            id="suscribe_to_news_letter"
            method=POST
            >
                <div class="form-group">
                    <input type="email" id="blog_subscribe_email" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.listings.fields.email-address'); ?>" required>
                </div>
                <div class="form-group">
                    <button  class="btn btn-green btn-block isThemeBtn"><?php echo app('translator')->getFromJson('main.blog.subscribe'); ?> 
                    </button>
                </div>
                <div id="subscribe_loader"></div>
            </form>
        </div>
    </div>
    <div class="row">
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="copyright"><?php echo e($rights_reserved); ?></div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <a href="<?php echo e($site_link); ?>" target="_blank">
        <div class="copyright"><?php echo app('translator')->getFromJson('main.home.powered-by-cstpl'); ?></div>
    </a>
</div>
</div>
</div>
</div>