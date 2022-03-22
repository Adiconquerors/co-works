   <script type="text/javascript">
    $(document).ready(function() {
      "use strict";
       $(document).on('click', '#visit_properties_share', function( e ) {
         e.preventDefault();

          var _token            = $("input[name='_token']").val();
          var toname            = $("#visit_toname").val();
          var toemail           = $("#visit_toemail").val();
          var ccemail           = $("#visit_ccemail").val();
          var company_name      = $("#visit_company_name").val();
          var no_of_seats       = $("#visit_no_of_seats").val();
          var mail_mobile       = $("#visit_mail_mobile").val();
          var mail_description  = $("#visit_mail_description").val();
          var visit_date        = $("#visit_date").val();
          var visit_time        = $("#visit_time").val();
          var action            = $("#visit_action").val();

            <?php
             $loader = LOADER;
            ?>

              var image = "{{ $loader }}"; 
              $('#visit_loading').html("<img src='"+image+"' />");
            
              $('.error').remove();

              var errors = 0;

              if( toname == '' ) {
              $('#visit_toname').after('<p class="error">{{trans("custom.eforms.enter-name")}}</p>');
              errors++;
              }

          if ( toemail == '' ) {
            $('#visit_toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
            $('#visit_toemail').focus();
            errors++;
            }
           if(IsEmail(toemail)==false){
              $('#visit_toemail').after('<p class="error">{{trans("custom.eforms.inv-email")}}</p>');
              $('#visit_toemail').focus();
              errors++;
            }


            if( mail_mobile == '' ) {
            $('#visit_mail_mobile').after('<p class="error">{{trans("custom.eforms.enter-mobile")}}</p>');
            errors++;
            }

            if( mail_mobile < 0 ) {
            $('#visit_mail_mobile').after('<p class="error">{{trans("custom.eforms.positive-nums")}}</p>');
            errors++;
            }


             if ( no_of_seats != '' ) {
              if(no_of_seats < 0){
                $('#visit_no_of_seats').after('<p class="error">{{trans("custom.eforms.positive-nums")}}</p>');
                $('#visit_no_of_seats').focus();
                errors++;
              }
            }

            if (errors > 0) {
             $('#visit_loading').html("").hide();
            }   

        if ( errors == 0 ) {

         $('#visit_loading').html("<img src='"+image+"' />").show();      
            $.ajax({
                url: '{{ route("properties.sendvisits") }}',
                type:'POST',
                data: {_token:_token, toname:toname, toemail:toemail, ccemail:ccemail, mail_mobile:mail_mobile , mail_description:mail_description,action:action,no_of_seats:no_of_seats,company_name:company_name,visit_date:visit_date,visit_time:visit_time},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                      $('#visit_loading').html("").hide();
                       alert(data.success);  
                       location.reload();
                    }else{
                        printErrorMsg(data.error, 'print-error-msg-contact');

                    }
                }
            });

          }
        });

    });

      function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          return false;
        }else{
          return true;
        }
      } 

</script>   