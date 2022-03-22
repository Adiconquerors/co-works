<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>

  <div class="row">
     <div class="col-12">
         <div class="page-title-box">
             <h4 class="page-title">
                <?php echo e($title); ?>

             </h4>
             <div class="breadcrumb p-0 m-0">
                 
                     <a href="<?php echo e(route('space_types.index')); ?>" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                     </i>
                     <?php echo app('translator')->getFromJson('custom.spacetypes.back_to_spacetypes'); ?></a>
                
             </div>
             <div class="clearfix">
             </div>
         </div>
         </div>
     </div>

<!-- end row -->
<div class="row">
   <div class="col-md-12">
      <div class="card-box">
        
  <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
  <?php endif; ?>
        <!-- article form start -->
   <?php $button_name = trans('global.app_create'); ?>
          
      <?php if($record): ?>
          <?php $button_name = trans('global.app_update'); ?>

      <?php echo Form::model($record, ['method' => 'PUT', 'route' => ['space_types.update',$record->slug], 'files' => true,'name'=>'formSpaceType','class'=>'formvalidation', 'enctype' => 'multipart/form-data' ]); ?>

            
      <?php else: ?>


      <?php echo Form::open(['method' => 'POST', 'route' => ['space_types.store'], 'files' => true,'name'=>'formSpaceType','class'=>'formvalidation', 'enctype' => 'multipart/form-data']); ?>


        <?php endif; ?>

        <?php echo $__env->make('admin.list-spaces.form-elements', 
                array('button_name'=> $button_name,'record'=>$record ), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

         <div class="text-center">
           <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e($button_name); ?></button>
         </div>     

         <?php echo Form::close(); ?>

         <!-- end form -->
            <!-- space_types form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_admin_js_scripts' ); ?>  
  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.newadmin.common.parseley-clientside-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>