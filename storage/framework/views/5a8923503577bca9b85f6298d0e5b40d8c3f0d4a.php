<style>
  #styid-fr{
    float:right;
  }.sty-h50{
    height:50%;
  }
</style>
<div class="feedback_form_area_inner">
<h3>
<?php echo app('translator')->getFromJson('custom.eforms.myshortlist'); ?> 
<span id="property-heart-count">
    <?php
       $shortlists_count = $properties_shortlists->count();
    ?>

( <?php echo e($shortlists_count); ?> )

<?php if( $shortlists_count > 0 ): ?>
  <a href="#ShortlistModal" data-toggle="modal" data-remote="false" class="" data-action="" >    
    <i class="fa fa-share-alt" id="styid-fr"></i>
 </a>  
<?php endif; ?>
 
</span>
</h3>

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#send-proposal" role="tab">
<?php echo app('translator')->getFromJson('custom.eforms.share'); ?>
</a>
</li>

</ul>
<div class="tab-content">
<div class="tab-pane fade in show active" id="send-proposal" role="tabpanel">


<?php $__currentLoopData = $properties_shortlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_shortlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
     $cover_image = $property_shortlist->cover_image; 
     $property_sub_space_types = $property_shortlist->property_sub_space_types;   
    ?> 
<div class="card-body-shortlist">
<!-- property card -->
<div class="property-card property-horizontal bg-white">
<div class="row">
<div class="col-sm-4">
  <?php if($cover_image): ?>
    <div class="property-image shortlist-card" style="background: url('<?php echo e(url( $cover_image )); ?>') center center / cover no-repeat;">
    </div>
   <?php else: ?>
    <div class="property-image shortlist-card" style="background: url('<?php echo e(url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' )); ?>') center center / cover no-repeat;">
    </div>
   <?php endif; ?> 
</div>
<!-- /col 4 -->
<div class="col-sm-8">
    <div class="property-content-card">
        <span class="pull-right clickable close-icon1"  data-effect="fadeOut">
            <i class="fa fa-times" id="heart-close_<?php echo e($property_shortlist->id); ?>">
            </i>
        </span>
        <div class="listingInfo">
            <div class="card-wid">
                <h5>
                    <a href="javascript:void(0);" class="text-dark property-lab property-main-lab">

                       <input type="hidden" name="prop_id" id="prop_id" class="list-item" data-id="<?php echo e($property_shortlist->id); ?>"> 

                       <span class="list-item" data-id="<?php echo e($property_shortlist->company); ?>"> <?php echo e($property_shortlist->company); ?> </span>
                    </a>
                </h5>
                <h6>
                  <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                       $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                       if( $space_types ){
                        $property_space_type_name = $space_types->name;
                        }else{
                          $property_space_type_name = '-';
                        }
                    ?>

                    <span> <?php echo e($space_types ? $space_types->name : '-'); ?> </span>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </h6>
                <div class="clearfix"></div>
                <div class="card-property-d">
                     

                    <h6>
                        <span id="property-heart-price-month"></span>
                       <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php   
                                $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);

                            ?>      
                       <?php echo e($space_types ? $space_types->name : ''); ?> ( <?php echo e($sub_space_types ? $sub_space_types->name : ''); ?> ) : <?php echo e($property_sub_space_type->price_per_month); ?> <?php echo app('translator')->getFromJson('custom.listings.fields.per-month'); ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           

                    </h6>
                    <a href="<?php echo e(route('properties.show', $property_shortlist->slug)); ?>" target="_blank" class="btn-danger card-property-btn sty-h50" alt="view-property">
                        <?php echo app('translator')->getFromJson('custom.eforms.view-details'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
</div>
<!-- End property card -->
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<!-- END Tab1 -->
</div>
</div>