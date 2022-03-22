   function printErrorMsg (msg, divclass) {
      
      $(".print-error-msg-error").css("display", 'none');

      $("." + divclass).find("ul").html('');
      $("." + divclass).css('display','block');
      $.each( msg, function( key, value ) {
          $("." + divclass).find("ul").append('<li>'+value+'</li>');
      });
  }

  $(document).ready(function() {
   
    $('#contact_form').bootstrapValidator({

        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

          submitHandler: function(validator, form, submitButton) {

             $('#submitValidateOtp').removeAttr('disabled');

            var enquire_date = $('#enquire-date').val();
            var enquire_time_from = $('#enquire-time-from').val();
            var enquire_time_to = $('#enquire-time-to').val();
            var enquire_month = $('#enquire-month').val();

            var name = $('#enquire-name').val();
            var email = $('#enquire-email').val();
            var phone_number = $('#enquire-phone_number').val();
            var address = $('#enquire_address').val();
     
            var enquiry_id = $('#enquiry_id').val();


            $.ajax({
                type: "POST",
                dataType: 'json',
                url: $('#contact_form').attr('action'), //action links to the route to contact form id
                data: $('#contact_form').serialize() + "&enquire_date=" + enquire_date + "&enquire_time_from=" + enquire_time_from + "&enquire_time_to=" + enquire_time_to + "&enquire_month=" + enquire_month + "&name=" + name + "&email="+ email + "&phone_number=" + phone_number + "&address=" + address,
                success: function(response){  
                if($.isEmptyObject(response.error)){
                    
                    if ( response.action == 'resend' ) {
                         $('#submitValidateOtp').removeAttr('disabled'); 
                        $('#enquire-otp').removeAttr('disabled');
                        $('.submitValidateOtp').css("display","block");
                        $('#submitValidateOtp').removeAttr('disabled');
                        $('#enquire-resend-otp').css("display","block");
                        $('#sendEnquireOtp').css("display","none");
                        $('#enquiry_id').val(response.enquire_id);

                        alert( response.message+' '+ response.enquire_otp);       
                                           
                    } else if ( response.action == 'confirm' ) {
                        $('#submitValidateOtp').removeAttr('disabled'); 
                        $('#enquire-otp').removeAttr('disabled');
                        $('.submitValidateOtp').css("display","block");
                        $('#submitValidateOtp').removeAttr('disabled');
                        $('#enquire-resend-otp').css("display","block");
                        $('#sendEnquireOtp').css("display","none");
                        $('#enquiry_id').val(response.enquire_id);
                        alert( response.message+' '+ response.enquire_otp); 
                      
                    } else {
                        
                        $("#myModal").removeClass("in");
                        $(".modal-backdrop").remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');

                        $('.form-group').removeClass('has-success');
                        $('.form-control-feedback').removeClass('glyphicon');
                        $('.form-control-feedback').removeClass('glyphicon-ok');

                         $('#modal').modal('toggle');
                        $('#contact_form').trigger('reset');

                        $('#enquire-date').val('');
                        $('#enquire-time-from').val('');
                        $('#enquire-time-to').val('');
                        $('#enquire-month').val('');
                        alert(response.confirmation);
                         location.reload();
                        return;

                    }
                }
                 else { 
                    printErrorMsg(response.error, 'print-error-msg-error');
                }


                 },
                // error: function(response){
                //   printErrorMsg(response.error, 'print-error-msg-error');
                // }
              });
            
            return false;
          
        },

            excluded: ':disabled',

        fields: {
            name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your name'
                    }
                }
            },
           
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
           
           
    
            }

    })
       
});