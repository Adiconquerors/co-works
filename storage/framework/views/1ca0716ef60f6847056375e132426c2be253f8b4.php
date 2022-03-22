<?php $__env->startSection( 'new_admin_head_links' ); ?>
  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
<style>
.span-margin{
  margin-left:15px;color:green;
}
.b-fnt{
  font-size:25px;
}
</style>
  <div class="row">
   <div class="col-md-12">
     <b class="b-fnt"><?php echo app('translator')->getFromJson('custom.connect.earn'); ?> <br/>
           <span class="span-margin"><?php echo app('translator')->getFromJson('custom.connect.deal-value'); ?></span> 
        </b>  
      <div class="card-box">

 <?php if(\Session::has('connect')): ?>
    <div class="alert alert-success">
        <ul>
            <li><?php echo \Session::get('connect'); ?></li>
        </ul>
    </div>
<?php endif; ?>
 

      <?php echo Form::open(['method' => 'POST', 'route' => ['connect'], 'files' => true,'name'=>'formConnect','class'=>'formvalidation' ]); ?>


        <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                <?php echo Form::label('company_name',trans('custom.connect.company-name') ); ?>


                <?php echo Form::text('company_name', null, ['class' => 'form-control',
                'id'=>'connect-companyname','placeholder'=>trans('custom.connect.company-name'),'required'=>'true',

                ]); ?>


               </div>

                <div class="form-group m-b-20">
                <?php echo Form::label('client_name',trans('custom.connect.client-name') ); ?>


                <?php echo Form::text('client_name',null, ['class' => 'form-control',
                'id'=>'connect-clientname','placeholder'=>trans('custom.connect.client-name'),'required'=>'true',

                ]); ?>


               </div>

                <div class="form-group m-b-20">
                <?php echo Form::label('no_of_seats',trans('custom.connect.no-of-seats') ); ?>


                <?php echo Form::number('no_of_seats',null, ['class' => 'form-control','min'=>'0',
                'id'=>'connect-no-of-seats','placeholder'=>trans('custom.connect.no-of-seats'),'required'=>'true',

                ]); ?>


               </div>       


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                <?php echo Form::label('mobile',trans('custom.connect.mobile-number') ); ?>


                <?php echo Form::text('mobile',null, ['class' => 'form-control',
                'id'=>'connect-mobile','placeholder'=>trans('custom.connect.mobile-number'),'required'=>'true',

                ]); ?>


               </div>


               <div class="form-group m-b-20">
                <?php echo Form::label('location',trans('custom.connect.location') ); ?>


                <?php echo Form::text('location',null, ['class' => 'form-control',
                'id'=>'connect-location','placeholder'=>trans('custom.connect.location'),'required'=>'true',

                ]); ?>


               </div>

                 <div class="form-group m-b-20">
                <?php echo Form::label('email',trans('custom.connect.emailid') ); ?>


                <?php echo Form::email('email',null, ['class' => 'form-control',
                'id'=>'connect-email','placeholder'=>trans('custom.connect.emailid'),'required'=>'true',

                ]); ?>


               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row --> 

       <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo app('translator')->getFromJson('custom.connect.send'); ?></button>
      </div>
      
         <?php echo Form::close(); ?>

         <!-- end form -->
            
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