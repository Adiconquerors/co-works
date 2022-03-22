 <?php $__env->startSection( 'main_header_styles' ); ?>
 <style>
 	.expertise-margin{
 		margin-top:-118px;
 	}
 	.card-margin{
 		margin-top:-50px;	
 	}
   .sty-h420{
      height:420px;
   }
   .sty-cp{
    cursor:pointer;
   }
 </style>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'content' ); ?>
<main class="main">

<?php
  $home_hero_bgimage = getSetting('home_hero_bgimage','our-workspaces-settings');
  $home_hero_bgimagecontainer = getSetting('home_hero_bgimagecontainer','our-workspaces-settings');
?>

<div class="home-hero__wrap home--height" style="background-image: url(<?php echo e(IMAGE_PATH_SETTINGS.$home_hero_bgimage); ?>); height:20em;">
         <div class="home-hero__overlay"></div>
         <div class="container">
            <div class="row">
            <div class="col-md-12 col-sm-12">
                  <h1 class="home-hero__title"><?php echo app('translator')->getFromJson('custom.postrequirement.workspaces'); ?></h2>
               </div>
            </div>
         </div>
      </div>
 
 
   <div class="workspce home-section__white" style="background-image: url(<?php echo e(IMAGE_PATH_SETTINGS.$home_hero_bgimagecontainer); ?>);background-repeat: no-repeat;">
      <div class="container">
         <div class="row">
            <?php
              $items = \App\SpaceType::getSpaceTypes(0);
            ?>
            
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>        
            <?php
             $sub_space_types = \App\SpaceType::getSpaceTypes($item->id);
           ?>
           <?php $__currentLoopData = $sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $image = $sub_space_type->image;
               
             ?>  

                     <div class="col-md-3 col-xs-12">
                        <div class="home-section__work-wrap">
                  <?php
                     $space_sub_loc = "location=&wstype=".$item->id."&subtype=".$sub_space_type->id;
                     $space_types_im = getDefaultimgagepath($image,'space-types');
                  ?>
                      
                           <img src="<?php echo e($space_types_im); ?>" alt="icon">
                       
                           <h3 class="sty-cp"><a href="<?php echo e(route('properties.list',$space_sub_loc)); ?>"><?php echo e($sub_space_type->name); ?></a></h3>
                           <p><?php echo e($sub_space_type->des_one ?? ''); ?></p>
                        </div>
                     </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
 
   </div>
 
</main>

<!-- footer -->
<?php echo $__env->make( 'partials.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>