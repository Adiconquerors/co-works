<?php $__env->startSection( 'new_content' ); ?>
  <style>
 .sty-mt{
    margin-top:200px;
 }
 .sty-di{
    display:inline;
 }
 .sty-ml60{
   margin-left: 60px;
 }
 .sty-ml50{
   margin-left: 50px;
 }
 #al-whatsapp{
   color: green; font-size: 20px;
 }
 .sty-ml103{
   margin-left: 103px;
 }
</style>
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <h4 class="page-title"><?php echo app('translator')->getFromJson('custom.listings.fields.property-listing'); ?></h4>

      <div class="breadcrumb p-0 m-0">
        <a href="<?php echo e(route('properties.create')); ?>" class="btn btn-purple waves-effect waves-light"><i class="fas fa-plus-square"></i>  <?php echo app('translator')->getFromJson('custom.listings.fields.add-property'); ?></a>
      </div>

      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!-- end row -->
<div class="row text-center">
  <div class="col-sm-12">
    <h5><?php echo app('translator')->getFromJson('custom.listings.fields.search-properties'); ?></h5>
    
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">

    <?php echo $__env->make('admin.listings.listing-filters',compact($items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>
<!-- end row -->
<div class="row">

  
<?php if(\Session::has('enquire')): ?>
    <div class="alert alert-danger">
        <ul>
            <li><?php echo \Session::get('enquire'); ?></li>
        </ul>
    </div>
<?php endif; ?>

<?php if(\Session::has('initiated')): ?>
    <div class="alert alert-danger">
        <ul>
            <li><?php echo \Session::get('initiated'); ?></li>
        </ul>
    </div>
<?php endif; ?>

  <div class="col-lg-12" id="listingList">
    <?php echo $__env->make('admin.listings.listing-list',['items'=>$items], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
  <!--END MAIN COL-8 -->
</div>
<!-- end row -->

<?php if( ! empty( $items ) ): ?>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Alternate Contact Modal -->
<div class="modal fade" id="modalContactForm_<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content sty-mt">
      <div class="modal-header text-center">
        <h4 class="modal-alternative-title w-100 font-weight-bold">
          <?php echo app('translator')->getFromJson('custom.listings.fields.alternative-contact-details'); ?>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table">

           <tbody>
            <tr>
              <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.alternate-contact-person-name'); ?></th>
              <td> <?php echo e($item->alter_cotact_person_name ? $item->alter_cotact_person_name : '-'); ?></td>

              </tr>
              <tr>
              <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.alternate-email-id'); ?></th>
              <td> <?php echo e($item->alter_email ? $item->alter_email : '-'); ?></td>

              </tr>
              <tr>
              <th scope="row"><?php echo app('translator')->getFromJson('custom.listings.fields.alternate-contact-person-number'); ?></th>
              <td><?php echo e($item->alter_cotact_person_number ? $item->alter_cotact_person_number : '-'); ?></td>

          </tr>
          </tbody>
          </table>
      </div>

    </div>
  </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php echo $__env->make('admin.listings.modal-loading', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?>

  <?php echo $__env->make('admin.listings.listings-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('admin.listings.shortlist-scripts',compact($items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('admin.listings.visits-scripts',compact($items), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('home-pages.common.autocomplete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function() {
    "use strict";
    function getSearchResults() {
      $('#listingList').val('');

      var _token = $("input[name='_token']").val();
      var property_manager_name = $("#property_manager_name").val();
      var property_manager_email = $("#property_manager_email").val();
      var property_address = $("#property_address").val();
      var property_id = $("#property_id").val();
      var space_type = $("#space_type").val();
      var pagination_value = $("#pagination_value").val();

      $.ajax({
        url: '<?php echo e(route("properties.filter")); ?>',
        type: 'GET',
        data: {
          _token: _token,
          property_manager_name: property_manager_name,
          property_manager_email: property_manager_email,
          property_address: property_address,
          property_id: property_id,
          space_type: space_type,
          pagination_value: pagination_value
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#listingList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    }
    

    $(document).on('click', '#listingSearch', function(e) {
      e.preventDefault();
      getSearchResults();
    });
  });
</script>
<!-- End Listing Search -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>