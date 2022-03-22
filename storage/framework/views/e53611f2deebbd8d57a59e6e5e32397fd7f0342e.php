<style>
   .d-img{
   max-width: 100%;
   height:270px;
   }
   .btn-bookspace {
    margin-top: 34px!important;
   }
   span.fa.fa-check-circle {
    padding-right: 5px!important;
   }
   a.card, div.card {
    display: block;
    background-color: #fff;
    /* box-shadow: 0 1px 2px 0 rgb(0 0 0 / 13%); */
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0%);
    margin-bottom: 20px;
    cursor: pointer;
    text-decoration: none;
    max-height: 389px!important;
}
</style>
<!-- Properties -->
<div class="row">
<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$property = $rec;
$property_sub_space_types = $rec->property_sub_space_types;
$property_amenities = $rec->property_amenities;
$cover_image = $property->cover_image;
$price_html = '';
$price_per_day = 'NA';
if ( ! empty( $property_sub_space_types ) ) {
   $space_type_id = '';
   foreach( $property_sub_space_types as $details ) {
      if ( $space_type_id != $details->space_type_id ) {
         $price_html .= '<p>';
         $price_html .= ' <span>Price per day</span> <span>Price per month</span>';
      }
      $sub_types = \App\SpaceType::getSpaceTypes( $details->space_type_id );
      foreach( $sub_types as $sub_type ) {
         if ( $sub_type->id == $details->sub_space_type_id ) {
            $price_html .= '<p><span >'.$sub_type->name.'</span> <span>'.''.$details->price_per_day.'</span> <span>'.''.$details->price_per_month.'</span></p>';
         } else {

         }
      }
      if ( 'NA' === $price_per_day && ! empty( $details->price_per_day ) ) {
         $price_per_day = $details->price_per_day;
         break; // Let us take first value as default.
      }
      $space_type_id = $details->space_type_id;
      if ( $space_type_id != $details->space_type_id ) {
         $price_html .= '</p>';
      }
   }
}


$price_per_month = 'NA';
if ( ! empty( $property_sub_space_types ) ) {
   foreach( $property_sub_space_types as $details ) {
      if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
         $price_per_month = $details->price_per_month;
         break; // Let us take first value as default.
      }
   }
}


?>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 

   <?php
   if( $rec->area )
      $area =  $rec->area.'sq ft';
   else
      $area = '-';
  ?>
  
  
   <div class="selectProduct" data-title="<?php echo e($rec->id); ?>"  data-id="<?php echo e($rec->name); ?>" data-slug="<?php echo e($rec->slug); ?>"  data-weight="<?php echo e($rec->property_address); ?>" 
      data-processor="<?php echo e($property_amenities); ?>"  data-price_html="<?php echo e($price_html); ?>">
          
      <div class="figType-heart">
         <a class="w3-btn-floating w3-light-grey addButtonCircular addToCompare" title="Compare">+</a>
         <?php if( $cover_image ): ?>
         <img src="<?php echo e(url( $cover_image )); ?>" alt="image" class="imgFill productImg img-hidden" >   
         <?php endif; ?>
      </div>
   </div>

   <a href="<?php echo e(route('properties.edit',[$property->slug,$property->id])); ?>" class="card">
  

  <?php if( $cover_image ): ?>
      <div class="figure imgwih">
    
         <img src="<?php echo e(url( $cover_image )); ?>" alt="Cover image" >
      <?php else: ?>
         <img src="<?php echo e(url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg')); ?>" alt="default image"  class="d-img">
      <?php endif; ?>
      </div>
        
      <h2><?php echo e($property->company); ?></h2>

      <div class="cardAddress" title="<?php echo e($property->property_address); ?>"><span class="icon-pointer"></span> 
         <?php echo e($property->property_address); ?></div>
         




      <?php if( 'yes' === $rec->is_approved ): ?>
      <ul class="cardFeat">
         <li><span class="fa fa-check-circle" ></span><?php echo app('translator')->getFromJson('custom.profile.verified'); ?></li>
      </ul>
      <?php endif; ?> 

      <ul class="cardFeat-right">
         <li><button class="btn btn-bookspace" type="submit">
            <span class="booking"><?php echo app('translator')->getFromJson('custom.profile.book'); ?></span><br><b><?php echo app('translator')->getFromJson('custom.profile.space'); ?></b>
            </button>
         </li>
      </ul>
      <div class="clearfix"></div>
   </a>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo $__env->make('home-pages.property-compare', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- End properties -->
<?php if( ! empty( $records ) && $records->total() > PROPERTIES_PER_PAGE ): ?>
<ul class="pagination ">
   <?php echo e($records->links()); ?>

</ul>
<?php endif; ?>
<?php echo $__env->make('home-pages.common.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script>
 function openLogin() {
      $('#redirect_url').val('<?php echo e(route("properties.create" )); ?>')
      $('#login-modal').modal('toggle');
}
</script>

