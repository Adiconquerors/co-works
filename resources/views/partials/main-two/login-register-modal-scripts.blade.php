<style>
  .error{
    color:red;
  }
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      "use strict";

        $(document).on('submit', '#frmLogin', function(e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            var _token   = $("input[name='_token']").val();
            var email    = $("#login-email").val();
            var password = $("#login-password").val();

            var error = 0;
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            $('.error').remove();
            if ( email == '' ) {
              $('#login-email').after('<span class="error">{{trans("custom.eforms.valid-email")}}</span>');
              error++;
            }  else if( !re.test(email) ) {
              $( '#email' ).after( '<span class="error">{{trans("custom.eforms.valid-email-address")}}</span>' );
              error++;
            }

            if( password == '' ) {
               $('#login-password').after('<span class="error">{{trans("custom.eforms.enter-password")}}</span>');
                error++;
            }

            if (error > 0) {
              e.preventDefault();
            } else {

              $.ajax({
                  url: "{{url('login_test')}}",
                  type:'POST',
                  data: {_token:_token, email:email, password:password},
                  success: function(data) {
                      if($.isEmptyObject(data.error)){

                          //console.log(data.success);
                           if ( $('#redirect_url').val() != '') {
                            window.location = $('#redirect_url').val();
                          }else {
                            // window.location = data.redirect;
                            window.location = '{{url("login_test")}}';
                          }

                      }else{
                          printErrorMsg(data.error, 'print-error-msg-login');
                      }
                  }
              });

              return false;
            }
        });

        $(document).on('submit', '#frmRegister', function(e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            var _token   = $("input[name='_token']").val();
            var name    = $("#name").val();
            var email    = $("#sign-up-email").val();
            var mobile = $("#mobile").val();
            var password = $("#signup-password").val();


            var error = 0;

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var reg = /^\d+$/; // Only numbers.
            $('.error').remove();

            if( name == '' ) {
               $('#name').after('<span class="error">{{trans("custom.eforms.enter-name")}}</span>');
                error++;
            }

            if ( email == '' ) {
              $('#sign-up-email').after('<span class="error">{{trans("custom.eforms.valid-email")}}</span>');
              error++;
            }  else if( !re.test(email) ) {
              $( '#sign-up-email' ).after( '<span class="error">{{trans("custom.eforms.valid-email-address")}}</span>' );
              error++;
            }

            if( mobile == '' ) {
               $('#mobile').after('<span class="error">{{trans("custom.eforms.enter-mobile")}}</span>');
                error++;
            } else if( ! reg.test(mobile) || mobile.length < 10 ) {
              $('#mobile').after('<span class="error">{{trans("custom.eforms.enter-valid-mobile")}}</span>');
                error++;
            }

            if( password == '' ) {
               $('#signup-password').after('<span class="error">{{trans("custom.eforms.enter-password")}}</span>');
                error++;
            }


            if (error > 0) {
              e.preventDefault();
            } else {
              $.ajax({
                  url: "{{route('register_test')}}",
                  type:'POST',
                  data: {_token:_token, name:name, email:email, mobile:mobile, password:password},
                  success: function(data) {
                      console.log( data );
                      if($.isEmptyObject(data.error)){


                      }else{
                          printErrorMsg(data.error, 'print-error-msg-signup');
                      }
                  }
              });
            }
        });


    });

function printErrorMsg (msg, divclass) {

            $(".print-error-msg-login").css("display", 'none');
            $(".print-error-msg-signup").css("display", 'none');

            $("." + divclass).find("ul").html('');
            $("." + divclass).css('display','block');
            $.each( msg, function( key, value ) {
                $("." + divclass).find("ul").append('<li>'+value+'</li>');
            });
        }


</script>