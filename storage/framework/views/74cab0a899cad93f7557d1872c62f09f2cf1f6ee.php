<?php
$action = request()->action;
$from = request()->from;
?>

<style>
  .font-display{
  font-size: 14px !important;
  color:black;
  }
  .sty-dn{
  display: none;
  }.sty-tc{
  text-align: center;
  }
  .sty-df{
  display: inline-flex;
  }
  .sty-cfs12{
  color: #000; font-size: 12px;  padding: 9px;
  }
  .sty-p10{
  padding: 10px;
  }
  .sty-cfsmt{
  color: #000; font-size: 12px;margin-top:0px;
  }
  .sty-c2{

  }
  .btn-doc{
    padding: 6px 10px !important;
  }

  #black-clr{
  color:#000;
  }
    select {
    width: 100%;
    height: 40px;
    border: 1px solid #d2d8d8;
    border-radius: 4px;
}
button.close {
  padding: 7px !important;
  cursor: pointer;
  background: 0 0;
  border: 0
}
.fillauth{
  text-align: center;
}
.sel-col {
    color: #000;
    padding-left: 50px;
    background: #fff;
    height: 50px;
}
.sty-hover:hover {    
     text-decoration: none !important; 
}

</style>
<!-- login modal -->
<div class="cd-user-modal <?php if($action == 'login'): ?> is-visible <?php endif; ?>" id="login-modal" class="modal fade" role="dialog">
   <!-- this is the entire modal form, including the background -->
   <div class="cd-user-modal-container">

        <button type="button" class="close sty-p10" data-dismiss="modal" id="close-button-one" aria-hidden="true">×</button>
      <!-- this is the container wrapper -->
      <!-- Login Setttings -->
       <?php
              $login_logo_enable = getSetting('login_logo_enable','login-settings');

              $login_logo = getSetting('login_logo','login-settings');

              if($login_logo_enable === 'Yes'){
            ?>

             <?php if($login_logo): ?>
            <img src="<?php echo e(IMAGE_PATH_SETTINGS.$login_logo); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" class="logo-modal-gold">
            <?php endif; ?>

              <?php
            } else {
             ?>
              <p class="single-line"><?php echo e(getSetting('site_title','site_settings')); ?></p>

           <?php }  ?>


      <ul class="cd-switcher">
         <li><a href="javascript:void(0);" class="<?php if($action == 'login'): ?> selected <?php endif; ?>"><?php echo app('translator')->getFromJson('main.login-register.sign-in'); ?></a>
         </li>
         <li>
          <a href="javascript:void(0);"><?php echo app('translator')->getFromJson('main.login-register.new-account'); ?></a>
         </li>
      </ul>


      <div id="cd-signup">
         <div class="alert alert-danger print-error-msg-signup sty-dn" >
      <ul></ul>
      </div>

       <div class="alert alert-success print-success-msg-signup sty-dn" >
        <ul></ul>
        </div>

         <div class="alert alert-success print-resend-success-msg-signup sty-dn">
        <ul></ul>
        </div>



        <?php if(session('error')): ?>
          <div class="alert alert-danger" role="alert">
          <?php echo e(session('error')); ?>

          </div>
        <?php endif; ?>

         <!-- sign up form -->
         <form class="cd-form"
           role="form"
           method="POST"
           action="" id="frmRegister">
            <?php echo csrf_field(); ?>

             <p class="fieldset" >

               <input type="radio" name="sign_up_as" id="sign_up_landlord" value="2">&nbsp;<label for="sign_up_landlord" class="font-display"><?php echo app('translator')->getFromJson('global.landlord'); ?></label>
               <input type="radio" name="sign_up_as" id="sign_up_customer" value="3" checked>&nbsp;<label for="sign_up_customer" class="font-display"><?php echo app('translator')->getFromJson('global.customer'); ?></label>

             </p>

            <p class="fieldset" id="register-user-name">
               <label class="image-replace cd-username" for="name">
                  <i class="fa fa-user"><?php echo app('translator')->getFromJson('main.login-register.username'); ?></i>
               </label>
               <input type="text" id="name" class="full-width has-padding has-border<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name"  minlength="2" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->getFromJson('main.login-register.username'); ?>" autofocus>

               <?php if($errors->has('name')): ?>
                  <span class="cd-error-message" role="alert">
                      <strong><?php echo e($errors->first('name')); ?></strong>
                  </span>
               <?php endif; ?>

            </p>

             <p class="fieldset" id="register-currency">
               <label class="image-replace cd-currency" for="currency_id">
               </label>

                  <?php
                      $currencies = \App\Currency::where('status','Active')->get();
                   ?>

                   <select class="full-width has-padding has-border sel-col" id="currency_id" name="currency_id"  value="" >
                       <option value=""><?php echo app('translator')->getFromJson('global.select-currency'); ?></option>
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($currency->id); ?>"><?php echo e($currency->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>

            </p>

            <p class="fieldset">
               <label class="image-replace cd-email" for="sign-up-email"><i class="fa fa-envelope"><?php echo app('translator')->getFromJson('main.login-register.email'); ?></i>
               </label>
               <input class="full-width has-padding has-border <?php echo e($errors->has('sign-up-email') ? ' is-invalid' : ''); ?>" id="sign-up-email" name="sign-up-email" type="email" value="<?php echo e(old('sign-up-email')); ?>" placeholder="<?php echo app('translator')->getFromJson('main.login-register.email'); ?>">

               <?php if($errors->has('sign-up-email')): ?>
               <span class="cd-error-message" role="alert">
                  <strong><?php echo e($errors->first('sign-up-email')); ?></strong>
               </span>
               <?php endif; ?>
            </p>
            <div id="resend_verification_btn" class="sty-dn">
            <button class="btn btn-primary" id="resend_email_verification"><?php echo app('translator')->getFromJson('main.login-register.resend'); ?></button>
          </div>
           <div id="loader"></div>

            <p class="fieldset" id="register-mobile" title="Enter Country Code & Phone Number Ex: 919951864590">
               <label class="image-replace cd-mobile" for="number"><?php echo app('translator')->getFromJson('main.login-register.mobile'); ?></label>
               <input type="number" class="full-width has-padding has-border<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>"  id="mobile" value="<?php echo e(old('mobile')); ?>" min="1" maxlength="10" name="mobile" placeholder="<?php echo app('translator')->getFromJson('main.eforms.mobile-num'); ?>">

               <?php if($errors->has('mobile')): ?>
               <span class="cd-error-message" role="alert">
               <strong><?php echo e($errors->first('mobile')); ?></strong>
               </span>
               <?php endif; ?>

            </p>
            <p class="fieldset" id="register-password">
               <label class="image-replace cd-password" for="signup-password"><?php echo app('translator')->getFromJson('main.login-register.password'); ?></label>
               <input class="full-width has-padding has-border <?php echo e($errors->has('signup-password') ? ' is-invalid' : ''); ?>" id="signup-password" type="password" name="signup-password" placeholder="<?php echo app('translator')->getFromJson('main.login-register.password'); ?>"> <a href="javascript:void(0);" class="hide-password"><?php echo app('translator')->getFromJson('main.login-register.show'); ?></a>

               <?php if($errors->has('signup-password')): ?>
               <span class="cd-error-message" role="alert">
                   <strong><?php echo e($errors->first('signup-password')); ?></strong>
               </span>
               <?php endif; ?>

            </p>
          
            <p class="fieldset" id="register-submit">
               <input class="full-width" type="submit" value="<?php echo e(trans('main.login-register.create-account')); ?>" id="btn-signup-submit">
            </p>
            <div id="loading"></div>
         </form>

      </div>
      <!-- cd-signup -->
      <div id="cd-login" class="<?php if($action == 'login'): ?> is-selected <?php endif; ?>">

         <?php if( isDemo() ): ?>
      <div class="fillauth">
        <button id="adminbtn1" class="btn--orange"><?php echo app('translator')->getFromJson('global.admin'); ?></button>
        <button id="landlordbtn2" class="btn--orange"><?php echo app('translator')->getFromJson('global.landlord'); ?></button>
        <button id="customerbtn3" class="btn--orange"><?php echo app('translator')->getFromJson('global.customer'); ?></button>
        <button id="agentbtn4" class="btn--orange"><?php echo app('translator')->getFromJson('global.agent'); ?></button>
        <button id="documentation5" class="btn--orange btn-doc"><?php echo app('translator')->getFromJson('global.documentation'); ?></button>
      </div>
       <?php endif; ?>


        <div class="alert alert-danger print-error-msg-login sty-dn" >
        <ul></ul>
        </div>

        <?php echo $__env->make('home-pages.common.message-display', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

         <!-- log in form -->
         <form class="cd-form"
            role="form"
            method="POST"
            id="frmLogin"
            action="<?php echo e(url('login_test')); ?>">
          <?php echo csrf_field(); ?>
            <p class="fieldset">
               <label class="image-replace cd-email" for="login-email">
                <i class="fa fa-envelope">
                <?php echo app('translator')->getFromJson('main.login-register.email'); ?></i></label>
               <input class="full-width has-padding has-border <?php echo e($errors->has('login-email') ? ' is-invalid' : ''); ?>" id="login-email" type="email" name="login-email" value="<?php echo e(old('login-email')); ?>" placeholder="<?php echo app('translator')->getFromJson('main.login-register.email'); ?>">

               <?php if($errors->has('login-email')): ?>
                  <span class="cd-error-message" role="alert">
                      <?php echo e($errors->first('login-email')); ?>

                  </span>
               <?php endif; ?>

            </p>
            <p class="fieldset">
               <label class="image-replace cd-password" for="login-password"><?php echo app('translator')->getFromJson('main.login-register.password'); ?></label>
               <input class="full-width has-padding has-border <?php echo e($errors->has('login-password') ? ' is-invalid' : ''); ?>" name="login-password"  id="login-password" type="password" name="login-password" placeholder="<?php echo app('translator')->getFromJson('main.login-register.password'); ?>"> <a href="javascript:void(0);" class="hide-password"><?php echo app('translator')->getFromJson('main.login-register.show'); ?></a>

               <?php if($errors->has('login-password')): ?>
                  <span class="cd-error-message" role="alert">
                      <strong><?php echo e($errors->first('login-password')); ?></strong>
                  </span>
               <?php endif; ?>

            </p>

            <p class="fieldset sty-df">

               <input type="checkbox" id="remember <?php echo e(old('remember') ? 'checked' : ''); ?>" name="remember" >
               <input type="hidden" id="redirect_url" name="redirect_url" value="">
               <label for="remember">
                <a href="javascript:void(0);" class="sty-cfs12 sty-hover">
                   <?php echo app('translator')->getFromJson('main.login-register.remember-me'); ?>
               </a>
               </label>
            </p>
            <p class="fieldset">
               <?php echo Form::submit(trans('main.login-register.login'), ['class' => 'full-width', 'id' => 'btn-login-submit']); ?>

            </p>
         </form>

              <?php if(Route::has('password.request')): ?>
              <p class="cd-form-bottom-message">
                <a href="<?php echo e(route('password.request')); ?>">
                    <?php echo app('translator')->getFromJson('main.login-register.forgot-password'); ?>
                 </a>
              </p>
              <?php endif; ?>

      </div>
      <!-- cd-login -->

<!-- reset password form -->

      <div id="cd-reset-password">
        <?php if(session('status')): ?>
         <div class="alert alert-success" role="alert">
          <?php echo e(session('status')); ?>

         </div>
         <?php endif; ?>

          <form class="cd-form" id="reset_password" method="POST">
            <?php echo csrf_field(); ?>
              <p class="fieldset">
                  <label class="image-replace cd-email" for="reset-email"><?php echo app('translator')->getFromJson('main.login-register.email'); ?></label>
               <input class="full-width has-padding has-border <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" id="reset-password-email" type="email" placeholder="<?php echo app('translator')->getFromJson('main.login-register.email'); ?>" value="<?php echo e(old('reset-email')); ?>">

           <?php if($errors->has('reset-email')): ?>
            <span class="cd-error-message" role="alert">
                <strong><?php echo e($errors->first('reset-email')); ?></strong>
            </span>
            <?php endif; ?>

              </p>

               <p class="fieldset">
                  <input class="full-width" type="submit" value="Reset password">
              </p>
              <div id="loading_circle"></div>
          </form>

          <p class="cd-form-bottom-message"><a href="#123"><?php echo app('translator')->getFromJson('main.login-register.back-to-login'); ?></a></p>
      </div>
      <!-- cd-reset-password -->
      <a href="#0" class="cd-close-form"><?php echo app('translator')->getFromJson('global.app_close'); ?></a>
   </div>
   <!-- cd-user-modal-container -->
</div>
<!-- cd-user-modal -->


<!-- /Login model -->

<form class="navbar-form header__form hidden" action="#">
   <div class="header__input-wrap">
      <input class="header__input" type="text" name="q" placeholder="<?php echo app('translator')->getFromJson('main.eforms.search'); ?>" autocomplete="off">
      <button class="btn btn--orange search" type="submit"> <span class="fa fa-search"></span>
      </button>
   </div>
   <span class="btn btn--orange search">
   <span class="fa fa-search"></span>
   </span>
</form>



<script type="text/javascript">
  <?php
      $load = LOADER;
  ?>

    jQuery(document).ready(function($) {
      "use strict";

        $(document).on('submit', '#reset_password', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var _token   = $("input[name='_token']").val();
            var email    = $("#reset-password-email").val();
            var image = "<?php echo e($load); ?>";
            $('#loading_circle').html("<img src='"+image+"' />");


            var error = 0;

            $('.error').remove();
            if ( email == '' ) {
              $('#reset-password-email').after('<span class="error"><?php echo e(trans("custom.eforms.enter-email")); ?></span>');
              error++;
            }
            if (error > 0) {
              e.preventDefault();
               $('#loading_circle').html("<img src='"+image+"' />").hide();
            } else {
              $('#loading_circle').html("<img src='"+image+"' />").show();

              $.ajax({
                  url: '<?php echo e(url("password/email")); ?>',
                  type:'POST',
                  data: {_token:_token, email:email},
                  success: function(data) {
                      if($.isEmptyObject(data.error)){
                         $('#loading_circle').html("").hide();
                         alert( '<?php echo e(trans("custom.eforms.success")); ?>' );
                         $("#reset-password-email").val('');
                      }
                  }
              });

              return false;
            }
        });

    });


</script>

<!-- resend verification -->
<script type="text/javascript">

  <?php
      $load = LOADER;
    ?>

    jQuery(document).ready(function($) {
      "use strict";

        $('#resend_email_verification').on("click", function(e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            var _token   = $("input[name='_token']").val();
            var email    = $("#sign-up-email").val();
            var image = "<?php echo e($load); ?>";
            $('#loader').html("<img src='"+image+"' />");


            var error = 0;

            $('.error').remove();
            if ( email == '' ) {
            $('#sign-up-email').after('<span class="error"><?php echo e(trans("custom.eforms.enter-email")); ?></span>');
            error++;
            }
            if (error > 0) {
              e.preventDefault();
               $('#loader').html("<img src='"+image+"' />").hide();
            } else {
              $('#loader').html("<img src='"+image+"' />").show();
              $.ajax({
                  url: '<?php echo e(route("resend.emailverification")); ?>',
                  type:'POST',
                  data: {_token:_token, email:email},
                  success: function(data) {
                      if($.isEmptyObject(data.error)){
                        printResendSuccessMsg(data.resend, 'print-resend-success-msg-signup');
                        $('#loader').html("").hide();

                      }
                  }
              });

              return false;
            }
        });

    });

    function printResendSuccessMsg (msg, divclass) {

    $(".print-resend-success-msg-signup").css("display", 'none');

    $("." + divclass).find("ul").html('');
    $("." + divclass).css('display','block');
    $.each( msg, function( key, value ) {
        $("." + divclass).find("ul").append('<li>'+value+'</li>');
    });
}


</script>

<!-- login btns-->
<script type="text/javascript">
  var adminbtn1 = $("#adminbtn1");
  var landlordbtn2 = $("#landlordbtn2");
  var customerbtn3 = $("#customerbtn3");
  var agentbtn4 = $("#agentbtn4");
  var documentation5 = $("#documentation5");


   $(adminbtn1).on("click", function() {
       $("#login-email").val("admin@admin.com");
       $("#login-password").val("password");
   });

   $(landlordbtn2).on("click", function() {
       $("#login-email").val("archie@landlord.com");
       $("#login-password").val("password");
   });

   $(customerbtn3).on("click", function() {
       $("#login-email").val("alison@gmail.com");
       $("#login-password").val("password");
   });

   $(agentbtn4).on("click", function() {
       $("#login-email").val("RickyJBreed@rhyta.com");
       $("#login-password").val("password");
   });


   $(documentation5).on("click", function() {
     window.open("//phpstack-152693-1447482.cloudwaysapps.com/Documentation/",'_blank');
   });

</script>
<!--end login btns-->
<!--end resend verification -->
