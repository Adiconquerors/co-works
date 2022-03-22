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
<div class="cd-user-modal @if($action == 'login') is-visible @endif" id="login-modal" class="modal fade" role="dialog">
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

             @if($login_logo)
            <img src="{{ IMAGE_PATH_SETTINGS.$login_logo }}" alt="{{getSetting('site_title','site_settings')}}" class="logo-modal-gold">
            @endif

              <?php
            } else {
             ?>
              <p class="single-line">{{ getSetting('site_title','site_settings') }}</p>

           <?php }  ?>


      <ul class="cd-switcher">
         <li><a href="javascript:void(0);" class="@if($action == 'login') selected @endif">@lang('main.login-register.sign-in')</a>
         </li>
         <li>
          <a href="javascript:void(0);">@lang('main.login-register.new-account')</a>
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



        @if (session('error'))
          <div class="alert alert-danger" role="alert">
          {{ session('error') }}
          </div>
        @endif

         <!-- sign up form -->
         <form class="cd-form"
           role="form"
           method="POST"
           action="" id="frmRegister">
            @csrf

             <p class="fieldset" >

               <input type="radio" name="sign_up_as" id="sign_up_landlord" value="2">&nbsp;<label for="sign_up_landlord" class="font-display">@lang('global.landlord')</label>
               <input type="radio" name="sign_up_as" id="sign_up_customer" value="3" checked>&nbsp;<label for="sign_up_customer" class="font-display">@lang('global.customer')</label>

             </p>

            <p class="fieldset" id="register-user-name">
               <label class="image-replace cd-username" for="name">
                  <i class="fa fa-user">@lang('main.login-register.username')</i>
               </label>
               <input type="text" id="name" class="full-width has-padding has-border{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  minlength="2" value="{{ old('name') }}" placeholder="@lang('main.login-register.username')" autofocus>

               @if ($errors->has('name'))
                  <span class="cd-error-message" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
               @endif

            </p>

             <p class="fieldset" id="register-currency">
               <label class="image-replace cd-currency" for="currency_id">
               </label>

                  <?php
                      $currencies = \App\Currency::where('status','Active')->get();
                   ?>

                   <select class="full-width has-padding has-border sel-col" id="currency_id" name="currency_id"  value="" >
                       <option value="">@lang('global.select-currency')</option>
                        @foreach($currencies as $currency )
                          <option value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                      </select>

            </p>

            <p class="fieldset">
               <label class="image-replace cd-email" for="sign-up-email"><i class="fa fa-envelope">@lang('main.login-register.email')</i>
               </label>
               <input class="full-width has-padding has-border {{ $errors->has('sign-up-email') ? ' is-invalid' : '' }}" id="sign-up-email" name="sign-up-email" type="email" value="{{ old('sign-up-email') }}" placeholder="@lang('main.login-register.email')">

               @if ($errors->has('sign-up-email'))
               <span class="cd-error-message" role="alert">
                  <strong>{{ $errors->first('sign-up-email') }}</strong>
               </span>
               @endif
            </p>
            <div id="resend_verification_btn" class="sty-dn">
            <button class="btn btn-primary" id="resend_email_verification">@lang('main.login-register.resend')</button>
          </div>
           <div id="loader"></div>

            <p class="fieldset" id="register-mobile" title="Enter Country Code & Phone Number Ex: 919951864590">
               <label class="image-replace cd-mobile" for="number">@lang('main.login-register.mobile')</label>
               <input type="number" class="full-width has-padding has-border{{ $errors->has('mobile') ? ' is-invalid' : '' }}"  id="mobile" value="{{ old('mobile') }}" min="1" maxlength="10" name="mobile" placeholder="@lang('main.eforms.mobile-num')">

               @if ($errors->has('mobile'))
               <span class="cd-error-message" role="alert">
               <strong>{{ $errors->first('mobile') }}</strong>
               </span>
               @endif

            </p>
            <p class="fieldset" id="register-password">
               <label class="image-replace cd-password" for="signup-password">@lang('main.login-register.password')</label>
               <input class="full-width has-padding has-border {{ $errors->has('signup-password') ? ' is-invalid' : '' }}" id="signup-password" type="password" name="signup-password" placeholder="@lang('main.login-register.password')"> <a href="javascript:void(0);" class="hide-password">@lang('main.login-register.show')</a>

               @if ($errors->has('signup-password'))
               <span class="cd-error-message" role="alert">
                   <strong>{{ $errors->first('signup-password') }}</strong>
               </span>
               @endif

            </p>
          
            <p class="fieldset" id="register-submit">
               <input class="full-width" type="submit" value="{{trans('main.login-register.create-account')}}" id="btn-signup-submit">
            </p>
            <div id="loading"></div>
         </form>

      </div>
      <!-- cd-signup -->
      <div id="cd-login" class="@if($action == 'login') is-selected @endif">

         @if( isDemo() )
      <div class="fillauth">
        <button id="adminbtn1" class="btn--orange">@lang('global.admin')</button>
        <button id="landlordbtn2" class="btn--orange">@lang('global.landlord')</button>
        <button id="customerbtn3" class="btn--orange">@lang('global.customer')</button>
        <button id="agentbtn4" class="btn--orange">@lang('global.agent')</button>
        <button id="documentation5" class="btn--orange btn-doc">@lang('global.documentation')</button>
      </div>
       @endif


        <div class="alert alert-danger print-error-msg-login sty-dn" >
        <ul></ul>
        </div>

        @include('home-pages.common.message-display')

         <!-- log in form -->
         <form class="cd-form"
            role="form"
            method="POST"
            id="frmLogin"
            action="{{ url('login_test') }}">
          @csrf
            <p class="fieldset">
               <label class="image-replace cd-email" for="login-email">
                <i class="fa fa-envelope">
                @lang('main.login-register.email')</i></label>
               <input class="full-width has-padding has-border {{ $errors->has('login-email') ? ' is-invalid' : '' }}" id="login-email" type="email" name="login-email" value="{{ old('login-email') }}" placeholder="@lang('main.login-register.email')">

               @if ($errors->has('login-email'))
                  <span class="cd-error-message" role="alert">
                      {{ $errors->first('login-email') }}
                  </span>
               @endif

            </p>
            <p class="fieldset">
               <label class="image-replace cd-password" for="login-password">@lang('main.login-register.password')</label>
               <input class="full-width has-padding has-border {{ $errors->has('login-password') ? ' is-invalid' : '' }}" name="login-password"  id="login-password" type="password" name="login-password" placeholder="@lang('main.login-register.password')"> <a href="javascript:void(0);" class="hide-password">@lang('main.login-register.show')</a>

               @if ($errors->has('login-password'))
                  <span class="cd-error-message" role="alert">
                      <strong>{{ $errors->first('login-password') }}</strong>
                  </span>
               @endif

            </p>

            <p class="fieldset sty-df">

               <input type="checkbox" id="remember {{ old('remember') ? 'checked' : '' }}" name="remember" >
               <input type="hidden" id="redirect_url" name="redirect_url" value="">
               <label for="remember">
                <a href="javascript:void(0);" class="sty-cfs12 sty-hover">
                   @lang('main.login-register.remember-me')
               </a>
               </label>
            </p>
            <p class="fieldset">
               {!! Form::submit(trans('main.login-register.login'), ['class' => 'full-width', 'id' => 'btn-login-submit']) !!}
            </p>
         </form>

              @if (Route::has('password.request'))
              <p class="cd-form-bottom-message">
                <a href="{{ route('password.request') }}">
                    @lang('main.login-register.forgot-password')
                 </a>
              </p>
              @endif

      </div>
      <!-- cd-login -->

<!-- reset password form -->

      <div id="cd-reset-password">
        @if (session('status'))
         <div class="alert alert-success" role="alert">
          {{ session('status') }}
         </div>
         @endif

          <form class="cd-form" id="reset_password" method="POST">
            @csrf
              <p class="fieldset">
                  <label class="image-replace cd-email" for="reset-email">@lang('main.login-register.email')</label>
               <input class="full-width has-padding has-border {{ $errors->has('email') ? ' is-invalid' : '' }}" id="reset-password-email" type="email" placeholder="@lang('main.login-register.email')" value="{{ old('reset-email') }}">

           @if ($errors->has('reset-email'))
            <span class="cd-error-message" role="alert">
                <strong>{{ $errors->first('reset-email') }}</strong>
            </span>
            @endif

              </p>

               <p class="fieldset">
                  <input class="full-width" type="submit" value="Reset password">
              </p>
              <div id="loading_circle"></div>
          </form>

          <p class="cd-form-bottom-message"><a href="#123">@lang('main.login-register.back-to-login')</a></p>
      </div>
      <!-- cd-reset-password -->
      <a href="#0" class="cd-close-form">@lang('global.app_close')</a>
   </div>
   <!-- cd-user-modal-container -->
</div>
<!-- cd-user-modal -->


<!-- /Login model -->

<form class="navbar-form header__form hidden" action="#">
   <div class="header__input-wrap">
      <input class="header__input" type="text" name="q" placeholder="@lang('main.eforms.search')" autocomplete="off">
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
            var image = "{{ $load }}";
            $('#loading_circle').html("<img src='"+image+"' />");


            var error = 0;

            $('.error').remove();
            if ( email == '' ) {
              $('#reset-password-email').after('<span class="error">{{ trans("custom.eforms.enter-email") }}</span>');
              error++;
            }
            if (error > 0) {
              e.preventDefault();
               $('#loading_circle').html("<img src='"+image+"' />").hide();
            } else {
              $('#loading_circle').html("<img src='"+image+"' />").show();

              $.ajax({
                  url: '{{ url("password/email") }}',
                  type:'POST',
                  data: {_token:_token, email:email},
                  success: function(data) {
                      if($.isEmptyObject(data.error)){
                         $('#loading_circle').html("").hide();
                         alert( '{{ trans("custom.eforms.success") }}' );
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
            var image = "{{ $load }}";
            $('#loader').html("<img src='"+image+"' />");


            var error = 0;

            $('.error').remove();
            if ( email == '' ) {
            $('#sign-up-email').after('<span class="error">{{ trans("custom.eforms.enter-email") }}</span>');
            error++;
            }
            if (error > 0) {
              e.preventDefault();
               $('#loader').html("<img src='"+image+"' />").hide();
            } else {
              $('#loader').html("<img src='"+image+"' />").show();
              $.ajax({
                  url: '{{ route("resend.emailverification") }}',
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
