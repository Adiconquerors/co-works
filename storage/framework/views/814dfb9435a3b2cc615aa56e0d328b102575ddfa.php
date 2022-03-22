<script type="text/javascript">
  var _token = $("input[name='_token']").val();

  $(document).ready(function() {
    "use strict";
    var $modal = $('#ajax-modal');
    var sysrender = $('#application_ajaxrender');
    var property_id = $('#property_id').val();

    $(document).on('click', '.sendBill', function(e) {
      e.preventDefault();
      var action = $(this).data('action');
      var property_id = $(this).data('property_id');

      var loadtemplate = true;

      if (loadtemplate) {
        $('#loading_icon').show();
        $('#loadingModal #content').html('');
        loadEmailTemplate(property_id, action);
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

    $(document).on('click', '#propertySend', function(e) {
      e.preventDefault();
      var property_id = $('#property_id').val();
      var action = $('#action').val();


      if ('raise-proforma-invoice' == action) {
        var get_form_data = getFormData('proforma_form');

        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var mail_mobile = $('#mail_mobile').val();
        var invoice_amount = $('#invoice_amount').val();
       
        var image = "<?php echo e($loader); ?>";
        $('#loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;

        if (toname == '') {
          $('#toname').after('<p class="error"><?php echo e(trans("custom.eforms.enter-name")); ?></p>');
          errors++;
        }

        if (toemail == '') {
          $('#toemail').after('<p class="error"><?php echo e(trans("global.enquires.messages.toemail")); ?></p>');
          $('#toemail').focus();
          errors++;
        }

        if (mail_mobile == '') {
          $('#mail_mobile').after('<p class="error"><?php echo e(trans("custom.eforms.enter-mobile")); ?></p>');
          errors++;
        }

        if (invoice_amount == '') {
          $('#invoice_amount').after('<p class="error"><?php echo e(trans("custom.eforms.enter-amount")); ?></p>');
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }

      } else if ('raise-tax-invoice' == action) {
        var get_form_data = getFormData('tax_form');

        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var mail_mobile = $('#mail_mobile').val();
        var invoice_amount = $('#invoice_amount').val();
        
        var image = "<?php echo e($loader); ?>";

        $('#loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (toemail == '') {
          $('#toemail').after('<p class="error"><?php echo e(trans("global.invoices.messages.toemail")); ?></p>');
          $('#toemail').focus();
          errors++;
        }
        if (toname == '') {
          $('#toname').after('<p class="error"><?php echo e(trans("global.invoices.messages.toname")); ?></p>');
          $('#toname').focus();
          errors++;
        }
        if (mail_mobile == '') {
          $('#mail_mobile').after('<p class="error"><?php echo e(trans("global.invoices.messages.mail_mobile")); ?></p>');
          $('#mail_mobile').focus();
          errors++;
        }
        if (invoice_amount == '') {
          $('#invoice_amount').after('<p class="error"><?php echo e(trans("global.invoices.messages.invoice_amount")); ?></p>');
          $('#invoice_amount').focus();
          errors++;
        }

        if (errors > 0) {
          $('#loading').html("").hide();
        }


      }

      if (errors == 0) {

        $('#loading').html("<img src='" + image + "' />").show();

        $.ajax({
          url: '<?php echo e(route("properties.sendInvoice")); ?>',
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
               alert(data.status);
              $('#loading').html("").hide();
               location.reload();
            } else {
              alert("Something went wrong!!");
            }
          }
        });
      }


    });


    function loadEmailTemplate(property_id, action) {
      $('#loading_icon').show();

      $.ajax({
        url: "<?php echo e(route('properties.mailInvoice')); ?>",
        type: 'POST',
        data: {
          '_token': _token,
          property_id: property_id,
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

  });
</script>