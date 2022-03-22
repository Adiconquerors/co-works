<?php
$code = $request->code;
$email = $request->email;
$confirm_record = \App\User::where('email', $email)->where('confirmation_code', $code)->first();

$mobile = ( $confirm_record ) ? $confirm_record->mobile : '';
if ( $confirm_record && $confirm_record->is_mobile_verified == 'yes') {
	flashMessage('danger', 'create', 'You have already verified your mobile number. Click <a href="'.url('/').'?action=login">here</a> to login.');
}
?>

<style>
  .sty-dn{
    display: none;
  }
</style>

@if( $confirm_record )
<!-- validate - mobile - modal -->
<div class="cd-user-modal validatemodal @if($confirm_record) is-visible @endif" id="validate-mobile-modal" class="modal fade" role="dialog">


   <!-- this is the entire modal form, including the background -->
   <div class="cd-user-modal-container">
      <!-- this is the container wrapper -->
      <!-- SiteSettings -->
      <?php
        
        $login_logo = getSetting('login_logo','login-settings');
        ?>

         <?php
              $login_logo_enable = getSetting('login_logo_enable','login-settings');
              if($login_logo_enable === 'Yes'){
            ?>

             @if($login_logo && file_exists(getSettingsPath() . $login_logo))
             
              <img src="{{ IMAGE_PATH_SETTINGS.$login_logo }}" alt="logo gold" class="logo-modal-gold"> 
            @endif

              <?php
            } else {
             ?>

              <p class="single-line">{{ getSetting('site_title','site_settings') }}</p>   

           <?php }  ?>
    
      
      <!-- validate - mobile -->
      <div id="cd-validate-mobile" class="is-selected">
      

         @if ( $confirm_record && $confirm_record->is_mobile_verified == 'yes')
         	@include('home-pages.common.message-display')
         	<p class="fieldset">
               <button type="button" class="btn btn-default closemodal" data-dismiss="modal">@lang('custom.eforms.close')</button>
            </p>
         @else
         <!-- validate - mobile - form -->
         <form class="cd-form" 
            role="form" 
            method="POST"
            id="frmValidateuser"
            action="{{ url('validate_user') }}">
          @csrf  

          <div class="alert alert-danger print-error-msg-validate sty-dn"  id="print-error-msg-validate">
          <ul></ul>
          </div>


            <p class="fieldset">
               <label class="image-replace cd-email" for="email">
                <i class="fa fa-envelope">  
                @lang('custom.eforms.email')</i></label>
               <input class="full-width has-padding has-border" id="email" type="text" name="name" value="{{$email}}" placeholder="@lang('custom.eforms.email')" disabled="">
            </p>

            <p class="fieldset">
               <label class="image-replace cd-mobile" for="email">
                <i class="fa fa-envelope">  
                @lang('custom.eforms.mobile')</i></label>
               <input class="full-width has-padding has-border" id="email" type="text" name="email" value="{{$mobile}}" placeholder="@lang('custom.eforms.mobile')" disabled="">
            </p>

            <div class="sty-dn">
            <p class="fieldset">
               <label class="image-replace cd-password" for="confirmation_code">
                <i class="fa fa-envelope">  
                @lang('custom.eforms.confirm-code')</i></label>
               <input class="full-width has-padding has-border" id="confirmation_code" type="text" name="confirmation_code" value="{{$code}}" placeholder="@lang('custom.eforms.confirm-code')" disabled="">
            </p>
          </div>
           
           <?php
              $demo_otp = '1234';
              if(isDemo())
              {
                $validate_demo_otp = $demo_otp;
              }else{
                 $validate_demo_otp = ''; 
              }
           ?> 

            <p class="fieldset">
               <label class="image-replace cd-password" for="otp">@lang('custom.eforms.otp')</label>
               <input class="full-width has-padding has-border" name="otp"  id="otp" type="number" name="otp" placeholder="OTP" value="{{$validate_demo_otp}}"> <a href="javascript:void(0);" class="hide-password">@lang('custom.eforms.show')</a>
               <a href="javascript:void(0);" onclick="resendOtp();">@lang('custom.eforms.resend')</a>             
            </p>

            <p class="fieldset">
               {!! Form::submit('Validate', ['class' => 'full-width', 'id' => 'btn-login-submit']) !!}
               <button type="button" class="btn btn-default closemodal" data-dismiss="modal">@lang('custom.eforms.close')</button>
            </p>
         </form>
         @endif
      </div>
      <!-- validate - mobile -->
   </div>
   <!-- cd-validate - mobile -modal-container -->
</div>
<!-- cd-validate - mobile - modal -->
<!-- /validate - mobile - model -->


<script type="text/javascript">
    $(document).ready(function() {
      "use strict";
        $(document).on('submit', '#frmValidateuser', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            var _token   = $("input[name='_token']").val();
            
            var otp = $("#otp").val();

            var error = 0;
           
            $('.error').remove();
                        
            if( otp == '' ) {
               $('#otp').after('<span class="error">{{ trans("custom.eforms.enter-otp") }}</span>');
                error++;
            }

            if (error > 0) {
              e.preventDefault();
            } else {
              $.ajax({
                  url: "{{route('validate_user')}}",
                  type:'POST',
                  data: {_token:_token, email:"{{$email}}", confirmation_code:"{{$code}}", otp:otp, mobile: "{{$mobile}}" },
                  success: function(data) {
                      if($.isEmptyObject(data.error)){                          
                        window.location = '{{url("/")}}?action=login';
                      } else {

                        printErrorMsg(data.error, 'print-error-msg-validate');
                      }
                  }
              });
            }
        });
    });

    function printErrorMsg (msg, divclass) {
        $("#" + divclass).removeClass('alert-success').addClass('alert-danger');
        $("#" + divclass).find("ul").html('');
        $("#" + divclass).css('display','block');
        $.each( msg, function( key, value ) {
            $("#" + divclass).find("ul").append('<li>'+value+'</li>');
        });
    }

    function printSuccessMsg (msg, divclass) {
        $("#" + divclass).removeClass('alert-danger').addClass('alert-success');
        $("#" + divclass).find("ul").html('');
        $("#" + divclass).css('display','block');
        $.each( msg, function( key, value ) {
            $("#" + divclass).find("ul").append('<li>'+value+'</li>');
        });
    }

    function resendOtp() {
      var _token   = $("input[name='_token']").val();
      
      $.ajax({
          url: "{{route('resend_otp')}}",
          type:'POST',
          data: {_token:_token, email:"{{$email}}", confirmation_code:"{{$code}}", mobile: "{{$mobile}}" },
          success: function(data) {
              if($.isEmptyObject(data.error)){                          
                printSuccessMsg(data.success, 'print-error-msg-validate');
              } else {
                printErrorMsg(data.error, 'print-error-msg-validate');
              }
          }
      });
    }
</script>
@endif