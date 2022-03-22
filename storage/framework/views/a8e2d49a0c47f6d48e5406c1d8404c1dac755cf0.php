<script>
  //toggle-heart
  <?php if(!empty($items)): ?>
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var heart_color = 'red';
    $(document).on('click', '#property-heart_<?php echo e($item->id); ?>', function(e) {
      e.preventDefault();
      var _token = $("input[name='_token']").val();
      if (heart_color == 'red') {
        $(this).css("color", "#FFF");
        heart_color = 'white';
      } else {
        $(this).css("color", "red");
        heart_color = 'red';
      }

      $.ajax({
        url: "<?php echo e(route('property.shortlist')); ?>",
        type: 'POST',
        data: {
          _token: _token,
          property_id: '<?php echo e($item->id); ?>',
          heart_color: heart_color
        },
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            if (heart_color == "red") {
              alert(data.success);
              location.reload();
            } 
          }
        }
      });


    });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

   
</script>