<?php $__env->startSection( 'content_two' ); ?>
<?php echo $__env->make( 'home-pages.common.head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/24hrs-time.css" rel="stylesheet" id="app">
 <link href="<?php echo e(PUBLIC_ASSETS); ?>css-maps/datepicker.css" rel="stylesheet">
<style>
   .prop{
      font-weight: bold;
   }
   .new-checkbox{
    display: flex;
   }
   .check-box-slash:before{
    content: "\002F";.
    padding-left:10px;
    }

   #content {
      overflow-x: hidden;
      overflow-y: auto;
      background-color: #f3f3f3;
      width: 60%;
      height: 100%!important;
      border-top: 1px solid #e8e8e8;
      float: right;
      -webkit-overflow-scrolling: touch;
  }

</style>

<div id="content" class="mob-max">
   <div class="rightContainer">
      <h1><b><?php echo app('translator')->getFromJson('custom.listings.fields.list-a-new-property'); ?></b></h1>

  <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
  <?php endif; ?>

  <?php if(session('success')): ?>
        <div class="alert alert-success">
          <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>


<?php $button_name = trans('global.app_create'); ?>

    <?php if($record): ?>
    <?php $button_name = trans('global.app_update'); ?>

    <?php echo Form::model($record, ['method' => 'PUT', 'route' => ['prop.update',$record->slug], 'files' => true,'name'=>'formPropertyType','id'=>'form_enter_propertytype']); ?>


    <?php else: ?>

    <?php echo Form::open(['method' => 'POST', 'route' => ['properties.store'], 'files' => true,'name'=>'formPropertyType','id'=>'form_enter_propertytype']); ?>


    <?php endif; ?>

     <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>links/moment29/moment-with-locales.js"></script>
    <script src="<?php echo e(PUBLIC_ASSETS); ?>js/jquery/3.4.1/jquery.min.js"></script> <!-- previously jquery 2.1.3 is used -->
   <script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>links/bootstrap-validator/bootstrapvalidator.min.js"></script>
<script src="<?php echo e(PUBLIC_ASSETS); ?>js-maps/bootstrap.js"></script>

<script>
// highlight current day on opeining hours
$(document).ready(function() {
"use strict";

$('.opening-hours li').eq(new Date().getDay()).addClass('today');
});


// datetimepicker

        $(function () {
        $('#datetimepicker1').datetimepicker({

        format: 'YYYY/MM/DD'
        });
        });

    $(function () {
        $('#datetimepicker2').datetimepicker({
            format: 'LT'
        });
    });

    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });

    <?php if( ! empty( $days ) ): ?>
      <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        $(function () {
            $('#datetimepicker<?php echo e($day->id); ?>from').datetimepicker({
                format: 'LT'
            });
        });

        $(function () {
            $('#datetimepicker<?php echo e($day->id); ?>to').datetimepicker({
                format: 'LT'
            });
        });
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</script>



    <?php echo $__env->make('admin.properties.form-elements', array('button_name'=> $button_name,'record'=>$record ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<div class="clearfix"></div>



<script>

$('.subtype').on('click', function () {
  var sub_space_type_id = $(this).data('sub_space_type_id');
  var checked = $(this).is(':checked');

  if ( checked ) {
    $('#hd_hidden_fields_' + sub_space_type_id).slideDown();
  } else {
    $('#hd_hidden_fields_' + sub_space_type_id).slideUp();
  }
});

</script>

<script>
  $('#form_enter_propertytype').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make( 'layouts.new_admin_property_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>