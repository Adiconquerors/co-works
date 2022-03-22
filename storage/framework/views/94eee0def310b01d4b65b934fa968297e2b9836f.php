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
   .selh{
   	    height: 50px;
   }
   .our-loctop .btn + p {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}

.pad_50{
	margin-bottom: 100px;
}
 </style>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'content' ); ?>
<main class="main">
 <div class="our-loctop">   
<div class="container">
<div class="row">
<div class="col-lg-6 col-xs-12 col-lg-offset-3">
<h1 class="home-hero__title">  <?php echo app('translator')->getFromJson('custom.mplocations.nearbylocations'); ?></h1>
 <form  action="<?php echo e(route('properties.list')); ?>">
	<div class="form-group">
		 <input name="location" id="search" type="text"  placeholder="<?php echo app('translator')->getFromJson('others.search-by'); ?>" autocomplete="off" onclick="initialize_top('search')" class="form-control">
	</div>
			<?php
				$items = \App\SpaceType::getSpaceTypes(0);
			?>
				<div class="form-group">
					<select class="form-control minimal selh" id="sel1" name="wstype">

				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				</select>
			</div>

	<div class="form-group">
	  <button type="submit" class="btn btn-info btn-lg btn-block"  id="span-search"><?php echo app('translator')->getFromJson('custom.mplocations.submit'); ?></button>
<p class="pad_50">  <?php echo app('translator')->getFromJson('custom.mplocations.check-near'); ?></p>

	</div>
</form>
</div>
</div>
</div>


</div>
<!-- footer -->
<?php echo $__env->make( 'partials.footer' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- end footer -->

<?php echo $__env->make('home-pages.common.initializetop', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.main' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>