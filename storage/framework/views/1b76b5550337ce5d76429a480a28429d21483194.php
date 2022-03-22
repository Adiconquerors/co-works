<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
<style>
   .font-13 span i {
    padding-left: 5px;
}  
</style>
 
<!-- end row -->
<div class="row text-center">
  <div class="col-sm-12">
    <h5  >
      <?php echo app('translator')->getFromJson('custom.inquiries.search-leads'); ?>
    </h5>
    
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">
    <div class="filters-border">
    <?php echo $__env->make('admin.enquires.forms.enquiries-filter', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
  </div>
</div>
<!-- end row -->
  
<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <?php
                       if( isAdmin() ){ 
                    ?>
                    <?php echo e(ucwords( $active_class )); ?>

                    <?php  } else if( isCustomer() ) { ?> 
                       
                    <?php echo app('translator')->getFromJson('custom.inquiries.inquiries'); ?>
                <?php } ?>

                </h4>
                <?php if( isAdmin() ): ?>
                <div class="breadcrumb p-0 m-0" >
                    
                        <a href="<?php echo e(route('leads.create')); ?>" class="btn btn-purple waves-effect waves-light sty-btn-margin"><i class="fas fa-plus-square">
                        </i>
                       <?php echo app('translator')->getFromJson('custom.inquiries.add-lead'); ?>
                    </a>
                   
                </div>
                <?php endif; ?>
                <div class="clearfix">
                </div>
            </div>
            </div>
        </div>  

<div class="card">
  <div class="card-body" id="EnquireList">
    <?php echo $__env->make('admin.enquires.enquiry-list',compact( $items ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

<?php echo $__env->make('admin.enquires.modal-loading', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'new_admin_js_scripts' ); ?>

<?php echo $__env->make('admin.enquires.scripts.formscripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('home-pages.common.autocomplete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="<?php echo e(PUBLIC_ASSETS_NEW_ADMIN); ?>pages/jquery.datatables.editable.init.js"></script>
<?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-script-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script>
  $(document).ready(function() {
    "use strict";
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
      keys: true
    });
    $('#datatable-responsive').DataTable();
    $('#datatable-colvid').DataTable({
      "dom": 'C<"clear">lfrtip',
      "colVis": {
        "buttonText": "Change columns"
      }
    });
    $('#datatable-scroller').DataTable({
     
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });
    var table = $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });
    var table = $('#datatable-fixed-col').DataTable({
      scrollY: "300px",
      scrollX: true,
      scrollCollapse: true,
      paging: false,
      fixedColumns: {
        leftColumns: 1,
        rightColumns: 1
      }
    });
  });
  TableManageButtons.init();
</script>



<script>
  function myFunction(x) {
    x.classList.toggle("fa-flag-checkered");
  }

  <?php if(!empty($items)): ?>
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  var flag_color = 'white';
  $(document).on('click', '#checkered_<?php echo e($item->id); ?>', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var _token = $("input[name='_token']").val();


    if (flag_color == 'white') {
      
      flag_color = 'lightgreen';
      
    } else {
      
      flag_color = 'white';
      
    }

    $.ajax({
      url: "<?php echo e(route('enquire.important')); ?>",
      type: 'POST',
      data: {
        _token: _token,
        lead_id: '<?php echo e($item->id); ?>',
        flag_color: flag_color
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          if (data.flag_color == "lightgreen") {
            alert(data.success);
            $('#gradex_<?php echo e($item->id); ?>').css('background', 'lightgreen');
          } else {
            alert(data.removed);
            $('#gradex_<?php echo e($item->id); ?>').css('background', '');
            
          }
        }
      }
    });


  });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</script>


<!-- filters -->
<script>
  $(document).ready(function() {
    "use strict";
    $(document).on('click', '#leadSearch', function(e) {
      e.preventDefault();
      $('#EnquireList').val('');

      var _token = $("input[name='_token']").val();

      var lead_address = $("#lead_address").val();
      var lead_assigned_to = $("#lead_assigned_to").val();
      var lead_name = $("#lead_name").val();
      var lead_email = $("#lead_email").val();
      var lead_number = $("#lead_number").val();
      var lead_status = $("#lead_status").val();


      $.ajax({
        url: '<?php echo e(route("enquires.filter")); ?>',
        type: 'POST',
        data: {
          _token: _token,
          lead_address: lead_address,
          lead_assigned_to: lead_assigned_to,
          lead_name: lead_name,
          lead_email: lead_email,
          lead_number: lead_number,
          lead_status: lead_status
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#EnquireList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->
<script>
$(function(){
  $(".wrapper1").scroll(function(){
    $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
  });
  $(".wrapper2").scroll(function(){
    $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
  });
});
</script>

<!-- booking initiated filters -->  
<script>
  $(document).ready(function() {
    "use strict";
    $(document).on('click', '#bookingInitiatedSearch', function(e) {
      e.preventDefault();
      $('#EnquiryBookingInitiatedSearchList').val('');

      var _token = $("input[name='_token']").val();

      var property_address = $("#property_address").val();
      var property_id = $("#property_id").val();
      var property_company = $("#property_company").val();
      var space_type = $("#space_type").val();
      
      $.ajax({
        url: '<?php echo e(route("enquiresbookinginitiated.filter")); ?>',
        type: 'POST',
        data: {
          _token: _token,
          property_address: property_address,
          property_id: property_id,
          property_company: property_company,
          space_type: space_type,
          
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#EnquiryBookingInitiatedSearchList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- End booking initiated filters   -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>