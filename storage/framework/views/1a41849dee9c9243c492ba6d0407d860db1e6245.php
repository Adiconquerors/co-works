<?php $__env->startSection( 'new_admin_head_links' ); ?>
  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'new_content' ); ?>

<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><?php echo e($title); ?> </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('admin.languages.index')); ?>"><?php echo e(ucwords($active_class)); ?></a>
            </li>
           
            <li class="breadcrumb-item">
               <?php echo e($title); ?>

            </li>
         </ol>
         <div class="clearfix"></div>
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

    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.languages.store'],'class'=>'formvalidation']); ?>

          

      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                <?php echo Form::label('language', trans('global.languages.fields.language').'*' ); ?>


                <?php echo Form::text('language', old('language'), ['class' => 'form-control', 'placeholder' => trans('global.languages.fields.language'), 'required' => '']); ?>


              
               </div>

               <div class="form-group m-b-20">

                <?php echo Form::label('code', trans('global.languages.fields.code').'*' ); ?>


                <?php echo Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('global.languages.fields.code'), 'required' => '']); ?>


              
               </div>

            

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                  
                  <?php echo Form::label('is_rtl', trans('global.languages.fields.is-rtl').'*'); ?>

                 
                  <?php echo Form::select('is_rtl', $enum_is_rtl, old('is_rtl'), ['class' => 'form-control select2', 'required' => '']); ?>

                  <!-- end row -->
               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e(trans('global.app_create')); ?></button>
      </div>


          

         <?php echo Form::close(); ?>

         <!-- end form -->
            <!-- testimonials form close  -->
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