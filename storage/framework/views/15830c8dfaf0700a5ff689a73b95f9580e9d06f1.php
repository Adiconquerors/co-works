<?php $__env->startSection('new_content'); ?>
<style>
    .sty_db{
        display:block;
    }
</style>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('custom.settings.settings'); ?></h3>

     <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo e(isset($title) ? $title : ''); ?>

        </div>

        

        <div class="row" ng-controller="angTopicsController">

          <div class="col-md-6">
             <div class="p-20">

              <div class="form-group m-b-20">  
            <?php $field_types = array(
                            '' => 'Select Type',
                            'text' => 'Text',
                            'number' => 'Number',
                            'email' => 'Email',
                            'password' => 'Password',
                            'select' => 'Select',
                            'checkbox' => 'Checkbox',
                            'file' => 'Image(.png/.jpeg/.jpg)',
                            'textarea' => 'Textarea',
                            ); ?>

            <?php echo Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'POST', 
                        'name'=>'formSettings ', 'files'=>'true')); ?>


               </div>         
                                      
        		
                <div class="form-group m-b-20">

                        <?php echo e(Form::label('key', trans('custom.settings.key'))); ?>

                        <span class="text-red">*</span>
                        <?php echo e(Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => trans('custom.settings.key'),
                    
                         ))); ?>


                     
                </div>


                 <div class="form-group m-b-20">

                       <?php echo e(Form::label('tool_tip', trans('custom.settings.tool-tip'))); ?>

                        <span class="text-red">*</span>
                        <?php echo e(Form::text('tool_tip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => trans('custom.settings.tool-tip'),
                    
                         ))); ?>


                     </div>



                    <div class="form-group m-b-20">
                        <?php echo e(Form::label('type', trans('custom.settings.type'))); ?>


                        <span class="text-red">*</span>
                        <?php echo e(Form::select('type',$field_types, null, ['class'=>'form-control', 
                        'ng-model' => 'field_type' ])); ?>


                     </div>

                    
                    <div class="form-group m-b-20" ng-if="field_type=='text' || field_type=='password' || field_type=='number' || field_type=='email'||  field_type=='file' ">
                        <?php echo e(Form::label('type', trans('custom.settings.value'))); ?>

                        
                         <input 
                            type="{{field_type}}" 
                            class="form-control" 
                            name="value" 
                            ng-model='value'>
                     </div>
                   

                    </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->

                <div class="col-md-6">
                  <div class="p-20">

                    
                     <div class="form-group m-b-20" ng-if="field_type=='checkbox' ">
                        <?php echo e(Form::label('type', trans('custom.settings.value'))); ?>

                        
                         <input 
                            type="checkbox" 
                            

                            class="form-control sty_db" 
                            name="value" 
                            value="1" 
                            required="true" 
                            
                            
                            checked>
                     </div>

                  


                      <div class="form-group m-b-20" ng-if="field_type=='select'">

                        <?php echo e(Form::label('total_options', trans('custom.settings.total-options'))); ?>

                        
                        <input 
                            type="number" 
                            class="form-control" 
                            name="total_options" 
                            min="1"
                            required="true" 
                            ng-model='obj.total_options'
                            ng-change="intilizeOptions(obj.total_options)"
                     >
                     </div>



                     <div class="form-group m-b-20" ng-if="field_type=='textarea'">

                        <?php echo e(Form::label('description', getphrase('description'))); ?>

                        
                       <textarea name="value" class="form-control ckeditor" ng-model='value' rows="5" ></textarea>

                     </div>



                     <div class="form-group m-b-20" data-ng-repeat="option in options">
                        <div class="col-md-12">
                        
                    <div class="form-group m-b-20 col-md-4" >
                        <?php echo e(Form::label('option_value', trans('custom.settings.value') )); ?> {{option}}
                            <input 
                            type="text" 
                            class="form-control" 
                            name="option_value[]" 
                            required="true" >
                    </div>

                    <div class="form-group m-b-20 col-md-4" >
                        <?php echo e(Form::label('option_text', trans('custom.settings.option-text') )); ?> {{option}}
                            <input 
                            type="text" 
                            class="form-control" 
                            name="option_text[]" 
                            required="true" >
                    </div>

                    <div class="form-group m-b-20 col-md-4" >
                    
                            <input type="radio" name="value" value="{{option-1}}" id="radio{{option}}" >
                            <label for="radio{{option}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <?php echo e(getPhrase('make_default')); ?> </label>
                    
                    </div>

                        </div>

                     </div>

                   </div>
                 </div>



                </div>

			</div>


    	</div>

</div>
           <div class="form-group pull-right">
              <br>
                <button class="btn btn-success"><?php echo e(trans('custom.settings.save')); ?></button>

            </div>


            <?php echo Form::close(); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('new_admin_js_scripts'); ?>

<?php echo $__env->make('admin.general_settings.scripts.js-scripts' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<?php echo $__env->make('admin.common.validations', array('isLoaded'=>true), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<script type="javascript" src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>

<?php $__env->stopSection(); ?>    
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>