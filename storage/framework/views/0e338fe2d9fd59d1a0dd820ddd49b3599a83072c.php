 
      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

               <?php echo Form::label('title', trans('custom.listings.fields.property-name').'*'); ?>


                <?php echo Form::text('title', old('title'), ['class' => 'form-control',
                  'id'=>'template-name','placeholder'=>trans('custom.listings.fields.property-name'),
                  'required'=> 'true'
                ]); ?>


               </div>


                <div class="form-group m-b-20">

                <?php echo Form::label('key',trans('custom.templates.key').'*' ); ?>


                <?php echo Form::text('key', old('key'), ['class' => 'form-control', 'id'=>'template-key', 'placeholder' => trans('custom.templates.key'), 'required' => '']); ?>


               </div>

                <div class="form-group m-b-20">

                <?php echo Form::label('type',trans('custom.templates.type').'*' ); ?>


                <?php echo Form::select('type', $enum_type ,old('type'),  ['class'=>'form-control', 'id'=>'template-type', 'required' => 'true' ]); ?>


               </div>

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
                <div class="form-group m-b-20">

                <?php echo Form::label('from_email',trans('custom.templates.from-email').'*',['class' => 'mb-3'] ); ?>


                <?php echo Form::text('from_email', old('from_email'), ['class' => 'form-control', 'id'=>'template-fromemail', 'placeholder' => 'From Email']); ?>


               </div>

                <div class="form-group m-b-20">

                <?php echo Form::label('from_name',trans('custom.templates.from-name').'*',['class' => 'mb-3'] ); ?>


                <?php echo Form::text('from_name', old('from_name'), ['class' => 'form-control','id'=>'template-fromname', 'placeholder' =>trans('custom.templates.from-name')]); ?>


               </div>

               <div class="form-group m-b-20">

                <?php echo Form::label('subject',trans('custom.templates.subject').'*' ); ?>


                <?php echo Form::text('subject', old('subject'), ['class' => 'form-control','id'=>'template-subject','placeholder'=>trans('custom.templates.subject'),
                'required'=> 'true'
                ]); ?>


               </div>   
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
  </div>

      <div class="row">
          <div class="col-md-10">
          <div class="form-group">
             <?php echo Form::label('content',trans('custom.templates.content'),['class' => 'mb-3']); ?>

           
            <div class="row">
               <div class="col-12">

                  <?php echo Form::textarea('content', old('content'), ['class' => 'summernote' ,  'id'=>'template-content', 'placeholder' => trans('custom.templates.content')]); ?>  
               </div>
            </div>
            <!-- end row -->
          </div>
        </div>
      </div>

      
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e($button_name); ?></button>
      </div>