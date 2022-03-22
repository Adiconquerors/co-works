<script>
  //toggle-heart
  <?php if(!empty($items)): ?>
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  $(document).on('click', '#schedule-visit_<?php echo e($item->id); ?>', function(e) {
    e.preventDefault();
    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "<?php echo e(route('property.visit')); ?>",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '<?php echo e($item->id); ?>'
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {

          alert(data.success);
          location.reload();

        }
      }
    });

   

  });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

 
</script>