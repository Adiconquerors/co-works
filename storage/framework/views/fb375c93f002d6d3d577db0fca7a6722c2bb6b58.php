      <!-- form validation -->
    <script>
      $(document).ready(function() {
        "use strict";
        $('form').parsley();
      });

            $(function () {
                $('.formvalidation').parsley().on('field:validated', function () {
                    var ok = $('.parsley-error').length === 0;
                    $('.alert-info').toggleClass('d-none', !ok);
                    $('.alert-warning').toggleClass('d-none', ok);
                })
               
            });

            // Don't submit form for this demo
    </script>
    <!-- end form validation -->