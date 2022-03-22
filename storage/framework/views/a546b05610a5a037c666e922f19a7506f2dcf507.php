<style>
  .error{
    color: red;
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
              $('#login-email').after('<span class="error"><?php echo e(trans("custom.eforms.enter-email")); ?></span>');
              error++;
            }  else if( !re.test(email) ) {
              $( '#email' ).after( '<span class="error"><?php echo e(trans("custom.eforms.enter-valid-email")); ?></span>' );
              error++;
            }
            
            if( password == '' ) {
               $('#login-password').after('<span class="error"><?php echo e(trans("custom.eforms.enter-password")); ?> </span>');
                error++;
            }

            if (error > 0) {
              e.preventDefault();
            } else {
              
              $.ajax({
                  url: "<?php echo e(url('login_test')); ?>",
                  type:'POST',
                  data: {_token:_token, email:email, password:password},
                  success: function(data) {
                      if($.isEmptyObject(data.error)){
                            console.log($('#redirect_url').val());
                          
                           if ( $('#redirect_url').val() != '') {
                            window.location = $('#redirect_url').val();
                          }else {
                            
                             window.location = '<?php echo e(url("login_test")); ?>';
                          } 
                          
                      }else{
                          printErrorMsg(data.error, 'print-error-msg-login');
                      }
                  }
              });

              return false;
            }
        }); 
        
        <?php
          $loader = LOADER;
        ?>
        $(document).on('submit', '#frmRegister', function(e) {
              
            e.preventDefault();
            e.stopImmediatePropagation();
            var _token        = $("input[name='_token']").val();
            var name          = $("#name").val();
            var sign_in_as = $("input[name='sign_up_as']:checked"). val();
            var email         = $("#sign-up-email").val();
            var mobile        = $("#mobile").val();
            var password      = $("#signup-password").val();
            var currency_id      = $("#currency_id").val();
            var image = "<?php echo e($loader); ?>"; 
            $('#loading').html("<img src='"+image+"' />");

            
            var error = 0;
            
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var reg = /^\d+$/; // Only numbers.
            $('.error').remove();
            
            if( name == '' ) {
               $('#name').after('<span class="error"><?php echo e(trans("custom.eforms.enter-name")); ?></span>');
                error++;
            }

            if( currency_id == '' ) {
               $('#currency_id').after('<span class="error"><?php echo e(trans("custom.eforms.enter-currency")); ?></span>');
                error++;
            }

            if ( email == '' ) {
              $('#sign-up-email').after('<span class="error"><?php echo e(trans("custom.eforms.enter-email")); ?></span>');
              error++;
            }  else if( !re.test(email) ) {
              $( '#sign-up-email' ).after( '<span class="error"><?php echo e(trans("custom.eforms.enter-valid-email")); ?></span>' );
              error++;
            }

            if( mobile == '' ) {
               $('#mobile').after('<span class="error"><?php echo e(trans("custom.eforms.enter-mobile")); ?></span>');
                error++;
            } else if( ! reg.test(mobile) || mobile.length < 10 ) {
              $('#mobile').after('<span class="error"><?php echo e(trans("custom.eforms.enter-valid-mobile")); ?></span>');
                error++;
            }

            if( password == '' ) {
               $('#signup-password').after('<span class="error"><?php echo e(trans("custom.eforms.enter-password")); ?></span>');
                error++;
            }
            

            if (error > 0) {
              e.preventDefault();
               $('#loading').html("").hide();
            } else {

               $('#loading').html("<img src='"+image+"' />").show();

              $.ajax({
                  url: "<?php echo e(route('register_test')); ?>",
                  type:'POST',
                  data: {_token:_token, name:name, email:email, mobile:mobile, password:password,sign_in_as:sign_in_as, currency_id:currency_id},
                  success: function(data) {
                      console.log( data );
                      if($.isEmptyObject(data.error)){

                         printSuccessMsg(data.success_register, 'print-success-msg-signup');

                        $( '#resend_verification_btn' ).css('display','block');
                        $( '#mobile' ).css('display','none');
                        $( '#register-password' ).css('display','none');
                        $( '#register-currency' ).css('display','none');
                        $( '#register-mobile' ).css('display','none');
                        $( '#register-submit' ).css('display','none');
                        $( '#register-user-name' ).css('display','none');
                        $( '#register_terms' ).css('display','none');
                        $( '#sign-up-email' ).attr('disabled','true');
                        $('#loading').html("").hide();
                          

                      }else{
                          $('#loading').html("").hide();
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

function printSuccessMsg (msg, divclass) {
    
    $(".print-success-msg-signup").css("display", 'none');

    $("." + divclass).find("ul").html('');
    $("." + divclass).css('display','block');
    $.each( msg, function( key, value ) {
        $("." + divclass).find("ul").append('<li>'+value+'</li>');
    });
}


</script>