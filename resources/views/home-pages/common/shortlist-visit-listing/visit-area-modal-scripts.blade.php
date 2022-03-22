<script type="text/javascript">
  var _token  = $("input[name='_token']").val();

 $(document).ready(function () {
  "use strict";
    var $modal = $('#ajax-modal');
    var sysrender = $('#application_ajaxrender');
    var visit_property_id = $('#visit_property_id').val();

    $(document).on('click', '.sendVisit', function( e ) {
      e.preventDefault();
      var action = $(this).data('action');
      var loadtemplate = true;
  
      if ( loadtemplate ) {
        $('#visit_loading_icon').show();
        $('#visitModalContent #visit-content').html('');
        loadEmailTemplate( action );
      } else {
        $('#visitModalContent').modal('toggle');
      }
    });

    $("#visitModalContent").draggable({
          handle: ".modal-header"
     });

    function getFormData( formid ){
        if ( typeof( formid ) == 'undefined' ) {
          formid = 'email_form';
        }
        var unindexed_array = $( '#' + formid ).serializeArray();
        var indexed_array = {};
        console.log( unindexed_array );
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    <?php
      $loader = LOADER;
    ?>

   $(document).on('click', '#propertyVisitSend', function( e ) {
    e.preventDefault();
   var action = $('#action').val();
   if ('property-visit' == action) {

    var toname           = $('#visit_toname').val();
    var visit_date       = $('#visit_date').val();
    var visit_time       = $('#visit_time').val();
   
    var toemail          = $('#visit_toemail').val();
    var sub              = $('#sub').val();
    var action           = $('#action').val();
    var mail_mobile      = $('#visit_mail_mobile').val();
    
    var ccemail         = $('#visit_ccemail').val();
    var visit_message   = $('#visit_message').val();
    
    var mail_description = $('#visit_mail_description').val();
   
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

    if( mail_mobile == '' ) {
    $('#visit_mail_mobile').after('<p class="error">{{trans("custom.eforms.enter-mobile")}}</p>');
    errors++;
    }


    if (errors > 0) {
      $('#visit_loading').html("").hide();
    }       

  }

        if ( errors == 0 ) {

         $('#visit_loading').html("<img src='"+image+"' />").show();  

          $.ajax({
                    url: '{{route("properties.sendvisits")}}',
                    dataType: "json",
                    method: 'post',
                    data: {
                      action: action,
                      '_token': _token,
                      'data': { toname:toname, toemail:toemail,radiovisit: radiovisit,visit_date: visit_date,visit_time:visit_time,toemail:toemail, mail_mobile:mail_mobile,mail_description:mail_description,sub:sub,id:id,action:action,ccemail:ccemail,visit_message:visit_message},
                      
                    },
                    success: function (data) {
              
                      $('#visitModalContent').modal('toggle');
                        
                        if ( data.status == 'success' ) {
                          alert("Success");
                          $('#visit_loading').html("").hide();  
                             location.reload();
                        } else {
                         alert("Something went wrong!!");
                      }
                    }
                });
        }
      
    });

  function loadEmailTemplate (action) {
    $('#visit_loading_icon').show();

    $.ajax({
          url : '{{ url("properties/total-visits") }}',
          type: 'POST',
          data: {
            '_token': _token,
            action: action
          },
          
          beforeSend: function() {
              
          },
          success: function (data) {
              $('#visit_loading_icon').hide();
              $('#visitModalContent #visit-content').html( data );
              
          },
          error: function (data) {
              $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
              $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
              $("html, body").scrollTop($("body").offset().top);
          }
      });
  }

  });

</script>