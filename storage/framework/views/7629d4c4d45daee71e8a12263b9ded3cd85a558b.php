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
               <a href="<?php echo e(route('currencies.index')); ?>"><?php echo e(ucwords($active_class)); ?></a>
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

    <?php echo Form::model($currency, ['method' => 'PUT', 'route' => ['currencies.update', $currency->id],'class'=>'formvalidation']); ?>

          
         <p><?php echo app('translator')->getFromJson('custom.currencies.currency_layer_message', ['url' => '<a href="https://currencylayer.com" target="_blank">https://currencylayer.com</a>', 'settings_url' => '<a href="'.url('admin/mastersettings/settings/view/currency-settings').'" target="_blank">here</a>']); ?></p>    

      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                <?php echo Form::label('name', trans('global.currencies.fields.name').'*' ); ?>


                <?php echo Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.name'), 'required' => '']); ?>


              
               </div>

               <div class="form-group m-b-20">

                <?php echo Form::label('symbol', trans('global.currencies.fields.symbol').'*' ); ?>


               <?php echo Form::text('symbol', old('symbol'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.symbol'), 'required' => '']); ?>


              
               </div>

                <div class="form-group m-b-20">

                <?php echo Form::label('code', trans('global.currencies.fields.code').'*' ); ?>


               <?php echo Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.code'), 'required' => '']); ?>


              
               </div> 

                 <div class="form-group m-b-20">

                <?php echo Form::label('rate', trans('global.currencies.fields.rate').'*' ); ?>


               <?php echo Form::number('rate', old('rate'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.rate'), 'required' => '','min'=>'1','step'=>'0.01']); ?>


              
               </div> 



            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                  
                  <?php echo Form::label('status', trans('global.currencies.fields.status').'*'); ?>

                 
                   <?php echo Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2', 'required' => '']); ?>

                  <!-- end row -->
               </div>

                 <div class="form-group m-b-20">
                  
                  <?php echo Form::label('is_default', trans('global.currencies.fields.is_default').'*'); ?>

                 
                   <?php echo Form::select('is_default', $enum_is_default, old('is_default'), ['class' => 'form-control select2', 'required' => '']); ?>

                  <!-- end row -->
               </div>
            

              <div class="form-group m-b-20">
                  
                  <?php echo Form::label('update_currency_online', trans('custom.currencies.update_currency_online') ); ?>

                 
                   <?php echo Form::select('update_currency_online', $enum_is_default, 'no', ['class' => 'form-control select2', 'required' => '']); ?>

                  <!-- end row -->
               </div>
            
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e(trans('global.app_update')); ?></button>
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