<!--Summernote js-->
<script src="{{ PUBLIC_PLUGINS_NEW_ADMIN }}summernote/summernote-bs4.min.js"></script>

<!-- dropify js -->
<script src="{{ PUBLIC_PLUGINS_NEW_ADMIN }}dropify/js/dropify.min.js"></script>

<!-- page specific js -->
<script src="{{ PUBLIC_ASSETS_NEW_ADMIN }}pages/jquery.blog-add.init.js"></script>

<script>

    jQuery(document).ready(function(){
"use strict";
        $('.summernote').summernote({
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
      
    });
</script>