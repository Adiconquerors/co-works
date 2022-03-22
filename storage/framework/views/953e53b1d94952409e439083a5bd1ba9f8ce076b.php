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
             <a class="mastfoot__logo" href="<?php echo e(url('/')); ?>"><img src="<?php echo e($default_site_logo_path); ?>" alt="Coworking"></a>
             <p>
            </div>
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">

             <p class="footer-list-title"> <?php echo app('translator')->getFromJson('main.home.explore'); ?></p>
                    <ul class="list-page-footer text-light">
                         <li><a class="text-link" href="//phpstack-152693-1447482.cloudwaysapps.com/Documentation/" target="_blank"><?php echo app('translator')->getFromJson('main.home.documentation'); ?></a></li>
                        <li><a class="text-link" href="<?php echo e(route('properties.list')); ?>"><?php echo app('translator')->getFromJson('main.home.search'); ?></a></li>
                        <li><a class="text-link" href="<?php echo e(url('about_us')); ?>"><?php echo app('translator')->getFromJson('main.home.about-us'); ?></a></li>
                        <li><a class="text-link" href="<?php echo e(url('blog')); ?>" target="_blank" class="text-link"><?php echo app('translator')->getFromJson('main.home.blog'); ?></a></li>
                        <li><a class="text-link" href="<?php echo e(url('how_it_works')); ?>"><?php echo app('translator')->getFromJson('main.home.how-it-works'); ?></a></li>


                    </ul>

            </div>
            <div class="col-sm-3 col-md-3 footer-list col-xs-12">
                    <p class="footer-list-title"><?php echo app('translator')->getFromJson('main.home.services'); ?></p>

                    <ul class="list-page-footer text-light">
                      <?php
                       $items = App\SpaceType::getSpaceTypes(0);
                      ?>
                       <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $location = 'location=&wstype='.$service->id;
                        ?>
                        <li><a class="text-link"  href="<?php echo e(route('properties.list',$location)); ?>"><?php echo e($service->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

               <p class="footer-list-title"><?php echo app('translator')->getFromJson('main.home.connect'); ?></p>
                    <ul class="list-page-footer text-light">
                        <li>
                            <div class="textwidget">
                                    <dl>
                                        <dt>
                                            <i class="fa fa-phone">
                                            </i>
                                           <?php echo e($country_code); ?> <?php echo e($site_phone); ?>

                                        </dt>
                                        <dd>
                                            <i class="fa fa-envelope">
                                            </i>
                                            <?php echo e($contact_email); ?>

                                        </dd>
                                        <dt>
                                            <i class="fa fa-calendar-o">
                                            </i>
                                            <?php echo e($footer_work_days); ?>

                                        </dt>
                                        <dd>
                                            <i class="fa fa-clock-o">
                                            </i>
                                           <?php echo e($footer_work_timings); ?>

                                        </dd>
                                        <dt>
                                            <i class="fa fa-whatsapp">
                                            </i>
                                           <?php echo e($country_code); ?> <?php echo e($whatsapp); ?>

                                        </dt>
                                        <dd>
                                            <i class="fa fa-skype">
                                            </i>
                                           <?php echo e($skype_email); ?>

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
         <p class="mastfoot__copy text-left"><?php echo e($rights_reserved); ?></p>
                    </div>
                    <div class="col-lg-6 col-xs-12">
            <ul class="mastfoot__links list-unstyled list-inline">
                        <li><a href="<?php echo e($site_link); ?>" target="_blank"><?php echo app('translator')->getFromJson('main.home.powered-by-cstpl'); ?></a></li>
                        <li><a></a></li>
                        <li><a href="javascript:void(0);"><?php echo app('translator')->getFromJson('main.home.payments-policy'); ?></a></li>
                        <li><a href="javascript:void(0);"><?php echo app('translator')->getFromJson('main.home.private-policy'); ?></a></li>
                        <li><a href="javascript:void(0);"><?php echo app('translator')->getFromJson('main.home.advertising'); ?></a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>

    </footer>

