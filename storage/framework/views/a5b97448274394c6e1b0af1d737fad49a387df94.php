<?php $__env->startSection( 'new_admin_head_links' ); ?>
  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

 <?php if($record): ?>
    <?php
      $name      = $record->name;
      $mobile    = $record->mobile;
      $image    = $record->image;
      $email    = $record->email;
    ?>

    <?php else: ?>

      <?php
        $name      = null;
        $mobile    = null;
        $email     = null;
        $image     = old('image');
      ?>

     <?php endif; ?>    

<?php $__env->startSection( 'new_content' ); ?>
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
 

      <?php echo Form::open(['method' => 'POST', 'route' => ['profile.settings'], 'files' => true,'name'=>'formPropertyType','class'=>'formvalidation', 'enctype' => 'multipart/form-data' ]); ?>


               <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                <?php echo Form::label('name',trans('custom.users.name') ); ?>


                <?php echo Form::text('name',  $name , ['class' => 'form-control',
                'id'=>'user-name','placeholder'=>trans('custom.users.name'),'required'=>'true',

                ]); ?>


               </div>

                    <div class="form-group m-b-20">
                     <?php echo Form::label('image',trans('custom.articles.image')); ?>


                     <?php
                        if( $record )
                        {
                            $image_url = $record->image;
                          
                        }else{
                            $image_url = null;
                        }
                     ?>
                   
                    

               
                  <input type="file" class="dropify" name="image"  data-height="120" value="<?php echo e($image_url); ?>"  accept=".jpeg, .png, .jpg, .gif, .svg">
                  <br/>
                    <img src="<?php echo e(getDefaultimgagepath($image_url,'users','')); ?>" width="100" height="100">                  
               </div>


    
              


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">

              <?php
              $disabled_enabled = '';
              if( isAdmin() )
              {
                $disabled_enabled = 'enabled';
              }else
              {
                $disabled_enabled = 'disabled';
              }
             ?>
              
               <div class="form-group m-b-20">
                    <?php echo Form::label('email',trans('custom.users.email') ); ?>

                 
                  <div class="row">
                     <div class="col-12">

                        <?php echo Form::email('email', $email, ['class' => 'form-control',
                        'id'=>'user-email','placeholder'=>trans('custom.users.email'), $disabled_enabled => $disabled_enabled,'required'=>'true',

                        ]); ?>


                     </div>

                      <div class="col-12">

                         <?php echo Form::label('mobile',trans('custom.users.mobile') ); ?>


                        <?php echo Form::text('mobile', $mobile, ['class' => 'form-control',
                        'id'=>'user-mobile','placeholder'=>trans('custom.users.mobile'),$disabled_enabled => $disabled_enabled,'required'=>'true',

                        ]); ?>

                       

                     </div>
                  </div>
                  <!-- end row -->
               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row --> 

       <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo app('translator')->getFromJson('global.app_update'); ?></button>
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