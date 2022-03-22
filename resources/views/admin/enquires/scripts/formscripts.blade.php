<script type="text/javascript">
  var _token = $("input[name='_token']").val();

  $(document).ready(function() {
    "use strict";
    var $modal = $('#ajax-modal');
    var sysrender = $('#application_ajaxrender');
    var enquiry_id = $('#enquiry_id').val();

    $(document).on('click', '.sendBill', function(e) {
      e.preventDefault();
      var action = $(this).data('action');
      var enquiry_id = $(this).data('enquiry_id');

      var loadtemplate = true;

      if (loadtemplate) {
        $('#loading_icon').show();
        $('#loadingModal #content').html('');
        loadEmailTemplate(enquiry_id, action);
      } else {
        $('#loadingModal').modal('toggle');
      }
    });

    $("#loadingModal").draggable({
      handle: ".modal-header"
    });

    function getFormData(formid) {
      if (typeof(formid) == 'undefined') {
        formid = 'email_form';
      }
      var unindexed_array = $('#' + formid).serializeArray();
      var indexed_array = {};
      console.log(unindexed_array);
      $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
      });

      return indexed_array;
    }

    <?php $loader = LOADER; ?>

    $(document).on('click', '#enquirySend', function(e) {
      e.preventDefault();
      var enquiry_id = $('#enquiry_id').val();
      var action = $('#action').val();

      if ('seeker-details' == action) {
        var get_form_data = getFormData('seeker_form');
        var seeker_name = $('#seeker_name').val();
        var seeker_email = $('#seeker_email').val();
        var seeker_phone_number = $('#seeker_phone_number').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (seeker_name == '') {
          $('#seeker_name').after('<p class="error">{{trans("global.enquires.messages.seeker_name")}}</p>');
          $('#seeker_name').focus();
          errors++;
        }
        if (seeker_email == '') {
          $('#seeker_email').after('<p class="error">{{trans("global.enquires.messages.seeker_email")}}</p>');
          $('#seeker_email').focus();
          errors++;
        }
        if (seeker_phone_number == '') {
          $('#seeker_phone_number').after('<p class="error">{{trans("global.enquires.messages.seeker_phone_number")}}</p>');
          $('#seeker_phone_number').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } else if ('requirement-details' == action) {
        var get_form_data = getFormData('req_form');
       
        var capacity_id = $('#capacity_id').val();
        var req_booking_date = $('#req_booking_date').val();
        var req_booking_months = $('#req_booking_months').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");



        $('.error').remove();

        var errors = 0;
        if (capacity_id == '') {
          $('#capacity_id').after('<p class="error">{{trans("global.enquires.messages.capacity")}}</p>');
          $('#capacity_id').focus();
          errors++;
        }
        if (req_booking_months !='' && req_booking_months <= 0 ) {
          $('#req_booking_months').after('<p class="error">{{trans("custom.eforms.val-greater")}}</p>');
          $('#req_booking_months').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      }else if ('bookingstart-date' == action) {
        var get_form_data = getFormData('bookingstart-date-form');
        
        var booking_start_date = $('#booking_start_date').val();
        

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");



        $('.error').remove();

        var errors = 0;
        if (booking_start_date == '') {
          $('#booking_start_date').after('<p class="error">{{trans("global.enquires.messages.booking-start-date")}}</p>');
          $('#booking_start_date').focus();
          errors++;
        }

      

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } 
      else if ('paymentstatus-totalamount' == action) {
        var get_form_data = getFormData('paymentstatus-totalamount-form');
       
        var amount_paid = $('#amount_paid').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");



        $('.error').remove();

        var errors = 0;
        if (amount_paid == '') {
          $('#amount_paid').after('<p class="error">{{trans("global.enquires.messages.amount_paid")}}</p>');
          $('#amount_paid').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } 
      else if ('raise-proforma-invoice' == action) {
        var get_form_data = getFormData('proforma_form');

        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var mail_mobile = $('#mail_mobile').val();
        var invoice_amount = $('#invoice_amount').val();
        var company_name = $('#company_name').val();
        var company_address = $('#company_address').val();
        
        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;

        if (toname == '') {
          $('#toname').after('<p class="error">{{trans("custom.eforms.enter-name")}}</p>');
          errors++;
        }

        if (toemail == '') {
          $('#toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
          $('#toemail').focus();
          errors++;
        }

        if (mail_mobile == '') {
          $('#mail_mobile').after('<p class="error">{{trans("custom.eforms.enter-mobile")}}</p>');
          errors++;
        }

        if (invoice_amount == '') {
          $('#invoice_amount').after('<p class="error">{{trans("custom.eforms.enter-amount")}}</p>');
          errors++;
        }

        

        if (company_name == '') {
          $('#company_name').after('<p class="error"> {{trans("custom.eforms.cmp-name")}}</p>');
          errors++;
        }

        if (company_address == '') {
          $('#company_address').after('<p class="error"> {{trans("custom.eforms.cmp-address")}}</p>');
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      }else if ('raise-tax-invoice' == action) {
        var get_form_data = getFormData('tax_form');

        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var mail_mobile = $('#mail_mobile').val();
        var invoice_amount = $('#invoice_amount').val();
        var company_name = $('#company_name').val();
        var company_address = $('#company_address').val();
       
        var image = "{{ $loader }}";

        $('#loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (toemail == '') {
          $('#toemail').after('<p class="error">{{trans("global.invoices.messages.toemail")}}</p>');
          $('#toemail').focus();
          errors++;
        }
        if (toname == '') {
          $('#toname').after('<p class="error">{{trans("global.invoices.messages.toname")}}</p>');
          $('#toname').focus();
          errors++;
        }
        if (mail_mobile == '') {
          $('#mail_mobile').after('<p class="error">{{trans("global.invoices.messages.mail_mobile")}}</p>');
          $('#mail_mobile').focus();
          errors++;
        }
        if (invoice_amount == '') {
          $('#invoice_amount').after('<p class="error">{{trans("global.invoices.messages.invoice_amount")}}</p>');
          $('#invoice_amount').focus();
          errors++;
        }

         if (company_name == '') {
          $('#company_name').after('<p class="error">{{trans("custom.eforms.cmp-name")}}</p>');
          errors++;
        }

        if (company_address == '') {
          $('#company_address').after('<p class="error">{{trans("custom.eforms.cmp-name")}}</p>');
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } 
      else if ('comments-details' == action) {
        var get_form_data = getFormData('comments_form');
       
        var comments = $('#comments').val();
        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (comments == '') {
          $('#comments').after('<p class="error">{{trans("global.enquires.messages.comments")}}</p>');
          $('#comments').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }


      }else if ('visit-details' == action) {
        var get_form_data = getFormData('visit_details_form');
        
        var visit_details = $('#visit_details').val();
        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (visit_details == '') {
          $('#visit_details').after('<p class="error">{{trans("global.enquires.messages.visit_details")}}</p>');
          $('#visit_details').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }


      } else if ('assigned-details' == action) {
        var get_form_data = getFormData('assigned_to_form');
        
        var assigned_to = $('#assigned_to').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (assigned_to == '') {
          $('#assigned_to').after('<p class="error">{{trans("global.enquires.messages.assigned_to")}}</p>');
          $('#assigned_to').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } else if ('mail-message' == action) {
        var get_form_data = getFormData('mail_message_form');
        
        
        var toemail = $('#toemail').val();
        var mail_description = $('#mail_description').val();
        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (toemail == '') {
          $('#toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
          $('#toemail').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } else if ('update-status' == action) {
        var get_form_data = getFormData('update_status_form');
       
        var toemail = $('#update_status').val();
        var update_status_user = $('#update_status_user').val();
        var update_status_created = $('#update_status_created').val();
        var update_status_updated = $('#update_status_updated').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (toemail == '') {
          $('#toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
          $('#toemail').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } 
      else if ('booking-initiated' == action) {
        var get_form_data = getFormData('booking_initiated_form');
        
        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var ccemail = $('#ccemail').val();
        var phone_number = $('#phone_number').val();
        var mail_description = $('#mail_description').val();
        var no_of_seats = $('#no_of_seats').val();
        var booking_months = $('#booking_months').val();
        var booking_amount = $('#booking_amount').val();
        var booking_date = $('#booking_date').val();
        var booking_initiated_property_id = $('#booking_initiated_property_id').val();

        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if ( toemail == '' ) {
            $('#toemail').after('<p class="error">{{trans("global.enquires.messages.toemail")}}</p>');
            $('#toemail').focus();
            errors++;
            }
           if(IsEmail(toemail)==false){
              $('#toemail').after('<p class="invalid-email">{{trans("global.enquires.messages.invalid-email")}}</p>');
              $('#toemail').focus();
              errors++;
            }
        if (toname == '') {
          $('#toname').after('<p class="error">{{trans("global.enquires.messages.toname")}}</p>');
          $('#toname').focus();
          errors++;
        }
        if (booking_amount == '') {
          $('#booking_amount').after('<p class="error">{{trans("global.enquires.messages.booking-amount")}}</p>');
          $('#booking_amount').focus();
          errors++;
        }
        if (mail_description == '') {
          $('#mail_description').after('<p class="error">{{trans("global.enquires.messages.mail_description")}}</p>');
          $('#mail_description').focus();
          errors++;
        }
         if (phone_number == '') {
          $('#phone_number').after('<p class="error">{{trans("global.enquires.messages.phone_number")}}</p>');
          $('#phone_number').focus();
          errors++;
        }

        if ( no_of_seats == '' ) {
            $('#no_of_seats').after('<p class="error">{{trans("global.enquires.messages.no-of-seats")}}</p>');
            $('#no_of_seats').focus();
            errors++;
         }

         if( no_of_seats < 0 ){
            $('#no_of_seats').after('<p class="error">{{trans("global.enquires.messages.enter-positive-values")}}</p>');
            $('#no_of_seats').focus();
             errors++;
         }

         if ( booking_months == '' ) {
            $('#booking_months').after('<p class="error"> {{trans("custom.eforms.req-bmonths")}}</p>');
            $('#booking_months').focus();
            errors++;
         }

        if( booking_months < 0 ){
            $('#booking_months').after('<p class="error">{{trans("global.enquires.messages.enter-positive-values")}}</p>');
            $('#booking_months').focus();
             errors++;
         }  

        if (errors > 0) {
          $('#loading').html("").hide();
        }


      } else if ('deal-lost' == action) {
        var get_form_data = getFormData('deal_lost_form');
       
        var deal_lost = $('#deal_lost').val();
        var deal_comments = $('#deal_comments').val();
        var image = "{{ $loader }}";
        $('#loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (deal_lost == '') {
          $('#deal_lost').after('<p class="error">{{trans("global.enquires.messages.deal_lost")}}</p>');
          $('#deal_lost').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      }

      if (errors == 0) {

        $('#loading').html("<img src='" + image + "' />").show();

        $.ajax({
          url: '{{route("seekerdetails.save")}}',
          dataType: "json",
          method: 'post',
          data: {
            action: action,
            '_token': _token,
            'data': get_form_data
          },
          success: function(data) {
            $('#loadingModal').modal('toggle');
            if (data.status == 'success') {
              $('#loading').html("").hide();
               window.location = data.url;
            } else {
               location.reload();
            }
          }
        });
      }


    });



    function loadEmailTemplate(enquiry_id, action) {
      
      $('#loading_icon').show();

      if(action=='properties-shared-sha'){
        $('.modal-footer').css('display','none');
      }else{
        $('.modal-footer').css('display','inline-flex');
      }

      $.ajax({
        url: "{{ route('enquires.seekerdetails') }}",
        type: 'POST',
        data: {
          '_token': _token,
          enquiry_id: enquiry_id,
          action: action
        },
        
        beforeSend: function() {
        },
        success: function(data) {
          $('#loading_icon').hide();
          $('#loadingModal #content').html(data);
        },
        error: function(data) {
          $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
          $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
          $("html, body").scrollTop($("body").offset().top);
        }
      });
    }

     function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          return false;
        }else{
          return true;
        }
      }

  });


</script>