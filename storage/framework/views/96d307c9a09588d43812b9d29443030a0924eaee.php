<?php
  $properties_shortlists = \App\Property::where( 'heart_color' , 'red' )->get();
  $properties_visits = \App\Property::where( 'schedule_visit' , 'no' )->get();
?>
  <!-- Right sliding forms -->
<!--feedback-form-->
<div id="feedback-form" class="feedback-form">

<a href="javascript:void(0);" class="feedback-form-btn-1 btn btn-success" id="OpenForm-visits"><?php echo app('translator')->getFromJson('others.visits'); ?></a>
<a href="javascript:void(0);" class="feedback-form-btn-2 btn btn-success" id="OpenForm-shortlist"><?php echo app('translator')->getFromJson('others.shortlist'); ?></a>
<!-- visits -->
<div class="feedback_form_area-visits">
    <?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.visit-area' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<!-- End visits -->

<!-- shortlist -->
<div class="feedback_form_area-shortlist">
    <?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.shortlist-area',compact('properties_shortlists') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
</div>
<?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.visit-area-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make( 'home-pages.common.shortlist-visit-listing.shortlist-area-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script>
<!-- shortlist close -->
<script>
  <?php if(!empty($properties_shortlists)): ?>
  <?php $__currentLoopData = $properties_shortlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  $(document).on('click', '#heart-close_<?php echo e($item->id); ?>', function(e) {
    e.preventDefault();

    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "<?php echo e(route('property.shortlist_close')); ?>",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '<?php echo e($item->id); ?>'
      },
      success: function(data) {
        location.reload();
      }
    });

    // $(".feedback_form_area-shortlist").toggle();

  });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</script>
<!-- end shortlist close -->


<!-- visits close -->
<script>
  <?php if(!empty($properties_visits)): ?>
  <?php $__currentLoopData = $properties_visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  $(document).on('click', '#visit-close_<?php echo e($item->id); ?>', function(e) {
    e.preventDefault();

    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "<?php echo e(route('property.visit_close')); ?>",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '<?php echo e($item->id); ?>'
      },
      success: function(data) {
        location.reload();
      }
    });


  });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</script>
<!-- end visit close -->
<!--feedback-form-->
<!-- /Right Sliding Forms-->
