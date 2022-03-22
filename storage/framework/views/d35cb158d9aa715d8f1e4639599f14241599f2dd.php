<?php $__env->startSection( 'content' ); ?>
 <style>
   .sty-h270 img{
    height: auto;
    width: auto !important;
    margin: 0 auto 3rem;
    display: block;
   }
   .sty-fs17em{
    font-size: 1.7rem;
   }
   .sty-mt20{
    margin-top: -20px;
   }
 </style>
<main class="main">

   <?php
        $background_image_heading = getSetting('background_image_heading','how-it-works-settings');
        $background_image = getSetting('background_image','how-it-works-settings');
        $our_expertise_heading = getSetting('our_expertise_heading','how-it-works-settings');

        $seeker_card_one_heading = getSetting('seeker_card_one_heading','how-it-works-settings');
        $seeker_card_two_heading = getSetting('seeker_card_two_heading','how-it-works-settings');
        $seeker_card_three_heading = getSetting('seeker_card_three_heading','how-it-works-settings');
        $seeker_card_four_heading = getSetting('seeker_card_four_heading','how-it-works-settings');
        
        $seeker_card_one_heading_caption = getSetting('seeker_card_one_heading_caption','how-it-works-settings');
        $seeker_card_two_heading_caption = getSetting('seeker_card_two_heading_caption','how-it-works-settings');
        $seeker_card_three_heading_caption = getSetting('seeker_card_three_heading_caption','how-it-works-settings');
        $seeker_card_four_heading_caption = getSetting('seeker_card_four_heading_caption','how-it-works-settings');
       
        $owner_card_one_heading = getSetting('owner_card_one_heading','how-it-works-settings');
        $owner_card_two_heading = getSetting('owner_card_two_heading','how-it-works-settings');
        $owner_card_three_heading = getSetting('owner_card_three_heading','how-it-works-settings');
        $owner_card_one_heading_caption = getSetting('owner_card_one_heading_caption','how-it-works-settings');
        $owner_card_two_heading_caption = getSetting('owner_card_two_heading_caption','how-it-works-settings');
        $owner_card_three_heading_caption = getSetting('owner_card_three_heading_caption','how-it-works-settings');
      ?>         
   
      <div class="home-hero__wrap home--height" style="background-image: url(<?php echo e(IMAGE_PATH_SETTINGS.$background_image); ?>); height:20em;">
         <div class="home-hero__overlay"></div>
         <div class="container">
            <div class="row">
            <div class="col-md-12 col-sm-12">
                  <h1 class="home-hero__title"><?php echo e($background_image_heading); ?></h2>
               </div>
            </div>
         </div>
      </div>
   
   <!-- Our Expertise2 -->
   <div class="home-section home-section__white" style="background-image: url(<?php echo e(PUBLIC_ASSETS); ?>images/howitworks-bg-fade.jpg);background-repeat: no-repeat;">
      <div class="container">
      
         <div class="row">
            <div class="tab--wrapper-container">
               <div class="content">
                  <div class="tab-nav">
                     <div class="tab-selection">
                        <div class="underline-item ">
                           <ul class="nav--tab" id="nav--tab">
                              <li id="tab-01" class="active">
                                 <span class="sty-fs17em"><strong><?php echo app('translator')->getFromJson('main.home.seeker'); ?></strong></span>
                              </li>
                              <li id="tab-02">
                                 <span class="sty-fs17em"><strong><?php echo app('translator')->getFromJson('main.home.owner'); ?></strong></span>
                              </li>
                              <div class="slide-cntrl right-gradient-float">
                                 <a href="#" class="slide-cntrl-btn btn-prev" id="prev"></a>
                                 <a href="#" class="slide-cntrl-btn btn-next" id="next"></a>
                              </div>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="tabbed-content tab-01 active-tab">
                     <div class="subcontent" class="sty-mt20">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/discover.png" alt="icon">
                                 <h3><?php echo e($seeker_card_one_heading); ?></h3>
                                 <p><?php echo e($seeker_card_one_heading_caption); ?></p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/compare.png" alt="icon">
                                 <h3><?php echo e($seeker_card_two_heading); ?></h3>
                                 <p><?php echo e($seeker_card_two_heading_caption); ?></p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/schedule.png" alt="icon">
                                 <h3><?php echo e($seeker_card_three_heading); ?></h3>
                                 <p><?php echo e($seeker_card_three_heading_caption); ?></p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/pick.png" alt="icon">
                                 <h3><?php echo e($seeker_card_four_heading); ?></h3>
                                 <p><?php echo e($seeker_card_four_heading_caption); ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tabbed-content tab-02">
                     <div class="subcontent">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/list.png" alt="icon">
                                 <h3><?php echo e($owner_card_one_heading); ?> </h3>
                                 <p><?php echo e($owner_card_one_heading_caption); ?>

                                 </p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/manage.png" alt="icon">
                                 <h3><?php echo e($owner_card_two_heading); ?></h3>
                                 <p><?php echo e($owner_card_two_heading_caption); ?>

                                 </p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="home-section__work-wrap sty-h270">
                                 <img src="<?php echo e(PUBLIC_ASSETS); ?>images/icons/deal.png" alt="icon">
                                 <h3><?php echo e($owner_card_three_heading); ?></h3>
                                 <p><?php echo e($owner_card_three_heading_caption); ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- partial -->
         </div>
      </div>
   </div>
   <!-- /Our Expertise2 -->
</main>

<!-- footer -->
<?php echo $__env->make( 'partials.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'main_javascripts' ); ?>
<!-- Scripts -->
    <script>
        // owner/seeker toggle 

        jQuery(document).ready(function() {
          "use strict";
  function scrollbtnshow() {
    if (
      $("#nav--tab li.active").prev("li").length > 0 &&
      $("#nav--tab li.active").next("li").length > 0
    ) {
      $(".slide-cntrl").addClass("overall-gradient-float");
      $(".slide-cntrl").removeClass("left-gradient-float");
      $(".slide-cntrl").removeClass("right-gradient-float");
      $(".slide-cntrl-btn.btn-next").css("display", "block");
      $(".slide-cntrl-btn.btn-prev").css("display", "block");
    } else if (
      $("#nav--tab li.active").prev("li").length == 0 &&
      $("#nav--tab li.active").next("li").length > 0
    ) {
      $(".slide-cntrl").removeClass("overall-gradient-float");
      $(".slide-cntrl").removeClass("left-gradient-float");
      $(".slide-cntrl").addClass("right-gradient-float");
      $(".slide-cntrl-btn.btn-prev").css("display", "none");
    } else {
      $(".slide-cntrl").removeClass("overall-gradient-float");
      $(".slide-cntrl").addClass("left-gradient-float");
      $(".slide-cntrl").removeClass("right-gradient-float");
      $(".slide-cntrl-btn.btn-next").css("display", "none");
    }
  }

  function tabcontentselect() {
    var panelId = jQuery(".tab-selection ul li.active").attr("id");

    jQuery(".tabbed-content").hide();
    jQuery(".tabbed-content").removeClass("active-tab");
    jQuery("." + panelId).show(), 500;
    jQuery("." + panelId).addClass("active-tab");
  }

  jQuery(".tab-selection ul li").on("click", function() {
    jQuery(this)
      .siblings()
      .removeClass("active");
    jQuery(this).addClass("active");

    tabcontentselect();
  });

  jQuery("#notification-tab").on("click", function() {
    jQuery(this)
      .parent()
      .parent()
      .removeClass("left");
  });

  jQuery("#nav--tab li").on("click", function() {
    jQuery("#nav--tab li").removeClass("active");
    jQuery(this).addClass("active");
    jQuery("#nav--tab").scrollCenter(".active", 300);

    scrollbtnshow();
  });

  /* Tab buttons */

  jQuery("#prev").on("click", function() {
    jQuery(".slide-cntrl-btn.btn-next").css("display", "block");
    jQuery("#nav--tab li.active:first")
      .prev()
      .addClass("active");
    jQuery("#nav--tab li.active")
      .next()
      .removeClass("active");
    jQuery("#nav--tab").scrollCenter(".active", 300);
  });

  jQuery("#next").on("click", function() {
    jQuery(".slide-cntrl-btn.btn-prev").css("display", "block");
    jQuery("#nav--tab li.active:last")
      .next()
      .addClass("active");
    jQuery("#nav--tab li.active")
      .prev()
      .removeClass("active");
    jQuery("#nav--tab").scrollCenter(".active", 300);
  });

  jQuery(".slide-cntrl-btn").on("click", function(e) {
    e.preventDefault();
    scrollbtnshow();
    tabcontentselect();
  });

  /* END Tab buttons */

  if ($(".nav--tab").prop("scrollWidth") > $(".nav--tab").width()) {
    $(".slide-cntrl").css("display", "block");
  } else {
    $(".slide-cntrl").css("display", "none");
  }

  jQuery.fn.scrollCenter = function(elem, speed) {
    var active = jQuery(this).find(elem);
    var activeWidth = active.width() / 2;

    var pos = active.position().left + activeWidth;
    var currentscroll = jQuery(this).scrollLeft();
    var divwidth = jQuery(this).width();
    pos = pos + currentscroll - divwidth / 2;

    jQuery(this).animate(
      {
        scrollLeft: pos
      },
      speed == undefined ? 1000 : speed
    );
    return this;
  };

  jQuery.fn.scrollCenterORI = function(elem, speed) {
    jQuery(this).animate(
      {
        scrollLeft:
          jQuery(this).scrollLeft() -
          jQuery(this).offset().left +
          jQuery(elem).offset().left
      },
      speed == undefined ? 1000 : speed
    );
    return this;
  };
});
    </script>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>