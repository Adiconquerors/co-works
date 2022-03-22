<?php echo $__env->make( 'home-pages.common.head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection( 'content_two' ); ?>

<style>
  .sty-w85{
   float:right !important; width: 50% !important;overflow-y:hidden;height:700px !important;
  }
  .sty-ww{
    float:left !important; width: 50% !important; overflow-y:scroll !important; overflow: visible; height: 600px !important;
  }
  .sty-color{
   display:none;
  }
  .sty-color1{
    color: #c1ab77;
  }
  .sty-color2{
    color:#011935;
  }
  .sty-h500{
    height: 500px !important;
  }
  .sty-red{
    color:red;
  }
  .no-touch .figure img{
    height: 33%;
  }

  .btn-bookspace {
    background: #fff;
    border: .2rem solid #40c8f4;
    color: #40c8f4;
    font-size: 17px;
    font-weight: bold;
    padding: 0.6rem 1.6rem;
    border-radius: 5px;
    margin-top: 37px;
  }
 @media (max-width: 640px){
    .price-size {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.3;
}
.btn-bookspace {
    background: #fff;
    border: .2rem solid #40c8f4;
    color: #40c8f4;
    font-size: 17px;
    font-weight: bold;
    padding: 0.6rem 1.6rem;
    border-radius: 5px;
    margin-top: 57px;
}
.figType {
    background-color: #011935;
    font-size: 10px;
    line-height: 11px;
    color: #fff;
    padding: 5px 16px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 0px;
    /* text-transform: uppercase; */
    z-index: 3;
    opacity: .8;
}
  }
</style>

<div id="content" class="mob-max sty-w85">
   <div class="singleTop whiteBg">
      <div class="row mb20">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
            <div class="row">
               <div class="col-xs-3">
                  <div class="pc-email sty-color"><a href="#" class="btn btn-icon btn-round btn-o btn-magenta btn-sm"><span class="fa fa-envelope-o"></span></a></div>
               </div>
               <div class="col-xs-6">

                     <?php
                     $agents = \App\User::find($record->agent_id);

                     $agent_image = IMAGE_PATH_UPLOAD_USERS.$agents->image;

                     ?>

                  <div class="profile-card">
                     <div class="pc-avatar">
                      <?php if( $agents->image ): ?>
                      <img src="<?php echo e($agent_image); ?>" alt="avatar" class="agent-im-height">
                      <?php else: ?>
                      <img src="<?php echo e(url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg')); ?>" class="agent-im-height">
                      <?php endif; ?>

                    </div>
                     <div class="pc-name"><?php echo e($agents ? $agents->name : '-'); ?></div>
                  </div>
               </div>
               <div class="col-xs-3">
                  <div class="pc-fav sty-color" ><a href="#" class="btn btn-icon btn-round btn-o btn-red btn-sm"><span class="fa fa-heart-o"></span></a></div>
               </div>
            </div>

            <div class="clearfix"></div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
            <div class="pc-title osLight"><?php echo app('translator')->getFromJson('custom.profile.contact-info'); ?></div>

            <div class="row pb10">
               <div class="col-xs-4"><strong><?php echo app('translator')->getFromJson('custom.profile.mobile'); ?></strong></div>
               <div class="col-xs-8 align-center"><?php echo e($agents ? $agents->mobile : '-'); ?></div>
            </div>
            <div class="row pb10">
               <div class="col-xs-4"><strong><?php echo app('translator')->getFromJson('custom.profile.email'); ?></strong></div>
               <div class="col-xs-8 align-center"><a href="mailto:#" class="text-green isThemeText"><?php echo e($agents ? $agents->email : '-'); ?></a></div>
            </div>


         </div>
      </div>
      <div class="row sty-h500">
         <div class="col-md-6 pb20">
            <div class="pc-about osLight"><?php echo app('translator')->getFromJson('custom.profile.about-me'); ?></div>
            <div class="pb20"><?php echo e($agents ? $agents->description : '-'); ?></div>

         </div>
         <div class="col-md-6">
            <div class="pc-title osLight"><?php echo app('translator')->getFromJson('custom.profile.send-me-a-message'); ?></div>
            <form class="contactForm"
            role="form"
            method="POST"
            id="contactForm"
            action = "<?php echo e(route( 'properties.send' , [$record->slug] )); ?>"
            >
               <div class="alert alert-danger print-error-msg-contact sty-color" >
               <ul></ul>
               </div>

               <div class="form-group">
                  <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" id="contact-name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.name'); ?>" required>
               </div>
               <div class="form-group">
                  <input type="email" class="form-control" value="<?php echo e(old('email')); ?>" id="contact-email"  placeholder="<?php echo app('translator')->getFromJson('custom.eforms.email'); ?>" required>
               </div>
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo e(old('subject')); ?>" id="contact-subject"  placeholder="<?php echo app('translator')->getFromJson('custom.templates.subject'); ?>">
               </div>
               <div class="form-group">
                  <textarea class="form-control" name="message" value="<?php echo e(old('message')); ?>" id="contact-message"  rows="3" placeholder="<?php echo app('translator')->getFromJson('custom.templates.type-message'); ?>"></textarea>
               </div>
               <button class="btn btn-green isThemeBtn" type="submit"> <?php echo app('translator')->getFromJson('custom.profile.send-message'); ?></button>
               <div id="loading"></div>

       </form>
         </div>
      </div>
   </div>
  </div>


  <div id="content" class="mob-max sty-ww">
     <div class="singleTop whiteBg">
      <div class="row mb20">
      <h3> <?php echo app('translator')->getFromJson('custom.profile.properties-under'); ?> <span class="sty-red" ><?php echo e($agents ? $agents->name : '-'); ?></span></h3>

         <?php
         $agent_properties = \App\Property::where('agent_id',$record->agent_id)->paginate(AGENT_PROPERTIES_PER_PAGE);
         ?>


         <?php if( count($agent_properties) > 0 ): ?>



        <?php $__currentLoopData = $agent_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent_property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
         $property_sub_space_types = $agent_property->property_sub_space_types;
         $cover_image = $agent_property->cover_image;

            $price_per_day = 'NA';
            $price_per_month = 'NA';
            if ( ! empty( $property_sub_space_types ) ) {
            foreach( $property_sub_space_types as $details ) {
            if ( 'NA' === $price_per_day && ! empty( $details->price_per_day ) ) {
            $price_per_day = $details->price_per_day;
            break; // Let us take first value as default.
            }
            }
            }

            //price per month

             if ( ! empty( $property_sub_space_types ) ) {
            foreach( $property_sub_space_types as $details ) {
            if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
            $price_per_month = $details->price_per_month;
            break; // Let us take first value as default.
            }
            }
            }

        ?>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <a href="<?php echo e(route('properties.edit',[$agent_property->slug,$agent_property->id])); ?>" class="card">
               <div class="figure">

                  <?php if( $cover_image ): ?>
                  <img src="<?php echo e(url( $cover_image )); ?>" alt="image">
                  <?php else: ?>
                  <img src="<?php echo e(url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg')); ?>" alt="image">
                  <?php endif; ?>

                  <div class="figType">
                     <i class="fa fa-inr"></i>
                     <span class="price-size"><?php echo e($price_per_month); ?> /month</span>
                  </div>
               </div>
               <h2 class="sty-color2"><?php echo e($agent_property->company); ?></h2>
               <div class="cardAddress"><span class="icon-pointer"></span> <?php echo e($agent_property->property_address); ?></div>

          
               <ul class="cardFeat">
                  <li><span class="fa fa-check-circle sty-color1"></span> <?php echo app('translator')->getFromJson('custom.profile.verified'); ?></li>
               </ul>
               <ul class="cardFeat-right">
                  <li><button class="btn btn-bookspace" id="">
                     <span class="booking"><?php echo app('translator')->getFromJson('custom.profile.book'); ?></span><br><b><?php echo app('translator')->getFromJson('custom.profile.space'); ?></b>
                     </button>
                  </li>
               </ul>
               <div class="clearfix"></div>
            </a>
         </div>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <ul class="pagination">
         <?php echo e($agent_properties->links()); ?>


      </ul>
   </div>

               <?php else: ?>
               <h4 ><?php echo app('translator')->getFromJson('custom.profile.no-properties-are-avaliable'); ?></h4>
               <?php endif; ?>

</div>
</div>
</div>

<script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>
<?php
  $loader = LOADER;
?>
 <script type="text/javascript">
    $(document).ready(function() {
      "use strict";

        $('#contactForm').submit(function( e ) {
            e.preventDefault();
            e.stopImmediatePropagation();

               var _token   = $("input[name='_token']").val();
               var name     = $("#contact-name").val();
               var email    = $("#contact-email").val();
               var subject  = $("#contact-subject").val();
               var message  = $("#contact-message").val();
               var image = "<?php echo e($loader); ?>";

               $('#loading').html("<img src='"+image+"' />");

            $.ajax({
                url: $(this).attr('action'),
                type:'POST',
                data: {_token:_token, name:name, email:email, subject:subject, message:message},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                    $('#loading').html("").hide();
                    alert(data.success);
                    location.reload();
                    }else{
                      $('#loading').html("").hide();
                      printErrorMsg(data.error, 'print-error-msg-contact');
                    }
                }
            });
        });



        function printErrorMsg (msg, divclass) {

            $(".print-error-msg-contact").css("display", 'none');

            $("." + divclass).find("ul").html('');
            $("." + divclass).css('display','block');
            $.each( msg, function( key, value ) {
                $("." + divclass).find("ul").append('<li>'+value+'</li>');
            });
        }
    });


</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.home_page_agent_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>