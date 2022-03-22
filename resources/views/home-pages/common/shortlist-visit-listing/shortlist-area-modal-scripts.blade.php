   <script type="text/javascript">
    $(document).ready(function() {
      "use strict";

       $(document).on('click', '#shortlist_properties_share', function( e ) {
         e.preventDefault();

          var _token            = $("input[name='_token']").val();
          var toname            = $("#toname").val();
          var subject           = $("#subject").val();
          var no_of_seats       = $("#no_of_seats").val();
          var company_name      = $("#company_name").val();
          var toemail           = $("#toemail").val();
          var ccemail           = $("#ccemail").val();
          var mail_mobile       = $("#mail_mobile").val();
          var mail_description  = $("#mail_description").val();
          var action            = $("#action").val();
          var message           = $("#message").val();

            <?php
             $loader = LOADER;
            ?>

              var image = "{{ $loader }}"; 
              $('#shortlist_loading').html("<img src='"+image+"' />");
            
              $('.error').remove();

              var errors = 0;

              if( toname == '' ) {
              $('#toname').after('<p class="error">{{trans("custom.eforms.enter-name")}}</p>');
              errors++;
              }

          
          if ( toemail == '' ) {
            $('#toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
            $('#toemail').focus();
            errors++;
            }
           if(IsEmail(toemail)==false){
              $('#toemail').after('<p class="error">{{trans("custom.eforms.inv-email")}}</p>');
              $('#toemail').focus();
              errors++;
            }


            if( mail_mobile == '' ) {
            $('#mail_mobile').after('<p class="error">{{trans("custom.eforms.enter-mobile")}}</p>');
            errors++;
            }

            if( mail_mobile < 0 ) {
            $('#mail_mobile').after('<p class="error"> {{trans("custom.eforms.positive-nums")}}</p>');
            errors++;
            }

            if ( no_of_seats != '' ) {
              if(no_of_seats < 0){
                $('#no_of_seats').after('<p class="error">{{trans("custom.eforms.positive-nums")}}</p>');
                $('#no_of_seats').focus();
                errors++;
              }
            }

            if (errors > 0) {
             $('#shortlist_loading').html("").hide();
            }   

        if ( errors == 0 ) {

         $('#shortlist_loading').html("<img src='"+image+"' />").show();      
            $.ajax({
                url: '{{ route("properties.totalshortlists") }}',
                type:'POST',
                data: {_token:_token, toname:toname, toemail:toemail, ccemail:ccemail, mail_mobile:mail_mobile , mail_description:mail_description,action:action,message:message,subject:subject,no_of_seats:no_of_seats,company_name:company_name},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                      $('#shortlist_loading').html("").hide();
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

</script> 