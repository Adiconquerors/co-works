<script type="text/javascript">
  var _token = $("input[name='_token']").val();

  $(document).ready(function() {
    "use strict";
    var $modal = $('#ajax-modal');
    var sysrender = $('#application_ajaxrender');
    var invoice_id = $('#invoice_id').val();

    $(document).on('click', '.sendBill', function(e) {
      e.preventDefault();
      var action = $(this).data('action');
      var invoice_id = $(this).data('invoice_id');

      var loadtemplate = true;

      if (loadtemplate) {
        $('#loading_icon').show();
        $('#loadingModal #content').html('');
        loadEmailTemplate(invoice_id, action);
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

      $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
      });

      return indexed_array;
    }

    <?php
      $loader = LOADER;
    ?>

    $(document).on('click', '#paymentSend', function(e) {
      e.preventDefault();
      var invoice_id = $('#invoice_id').val();
      var action = $('#action').val();

      if ('invoice-payment' == action) {
        var get_form_data = getFormData('payment_form');

        var transaction_id =  $('#transaction_id').val();

        var image = "<?php echo e($loader); ?>";
        $('#invoice_loading').html("<img src='" + image + "' />");


        $('.error').remove();

        var errors = 0;
        if (transaction_id == '') {
          $('#transaction_id').after('<p class="error"><?php echo e(trans("global.invoices.messages.transaction_id")); ?></p>');
          $('#transaction_id').focus();
          errors++;
        }
        
        if (total_amount == '') {
          $('#total_amount').after('<p class="error"><?php echo e(trans("global.invoices.messages.total_amount")); ?></p>');
          $('#total_amount').focus();
          errors++;
        }

        if (errors > 0) {
          $('#invoice_loading').html("").hide();
        }

      } else if ('comments-details' == action) {
        var get_form_data = getFormData('comments_form');
        //$('#paymentSend').html('<?php echo e(trans("global.common.save")); ?>');
        var comments = $('#comments').val();
        var image = "<?php echo e($loader); ?>";
        $('#invoice_loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (comments == '') {
          $('#comments').after('<p class="error"><?php echo e(trans("global.enquires.messages.comments")); ?></p>');
          $('#comments').focus();
          errors++;
        }

        if (errors > 0) {
          $('#invoice_loading').html("").hide();
        }


      } else if ('booking-initiated' == action) {
        var get_form_data = getFormData('booking_initiated_form');
        //$('#paymentSend').html('<?php echo e(trans("global.common.save")); ?>');
        var toemail = $('#toemail').val();
        var toname = $('#toname').val();
        var ccemail = $('#ccemail').val();
        var phone_number = $('#phone_number').val();

        var image = "<?php echo e($loader); ?>";
        $('#invoice_loading').html("<img src='" + image + "' />");

        $('.error').remove();

        var errors = 0;
        if (toemail == '') {
          $('#toemail').after('<p class="error"><?php echo e(trans("global.enquires.messages.toemail")); ?></p>');
          $('#toemail').focus();
          errors++;
        }
        if (toname == '') {
          $('#toname').after('<p class="error"><?php echo e(trans("global.enquires.messages.toname")); ?></p>');
          $('#toname').focus();
          errors++;
        }
        if (phone_number == '') {
          $('#phone_number').after('<p class="error"><?php echo e(trans("global.enquires.messages.phone_number")); ?></p>');
          $('#phone_number').focus();
          errors++;
        }

        if (errors > 0) {
          $('#invoice_loading').html("").hide();
        }


      }

      if (errors == 0) {

        $('#invoice_loading').html("<img src='" + image + "' />").show();

        $.ajax({
          url: '<?php echo e(route("payments.save")); ?>',
          dataType: "json",
          method: 'post',
          data: {
            action: action,
            '_token': _token,
            'data': get_form_data
          },
          success: function(data) {
            $('#loadingModal').modal('toggle');
            // notifyMe(data.status, data.message);
            if (data.status == 'success') {
              $('#invoice_loading').html("").hide();
              window.location = data.url;
            } else {
              location.reload();
            }
          }
        });
      }


    });



    function loadEmailTemplate(invoice_id, action) {
      $('#loading_icon').show();

      $.ajax({
        url: "<?php echo e(route('invoices.payments')); ?>",
        type: 'POST',
        data: {
          '_token': _token,
          invoice_id: invoice_id,
          action: action
        },
        //dataType: 'json',
        beforeSend: function() {
          // setTimeout( console.log(crsf_token), 5000);
        },
        success: function(data) {
          $('#loading_icon').hide();
          $('#loadingModal #content').html(data);
          // $('.editor').ckeditor();
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