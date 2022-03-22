 
      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                <?php echo Form::label('text', trans('global.internal-notifications.fields.text').'*' ); ?>


                <?php echo Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => '','required'=>true]); ?>


               </div>

               <div class="form-group m-b-20">
                <?php echo Form::label('users', trans('global.internal-notifications.fields.users').'*', ['class' => 'control-label']); ?>


                <?php echo Form::select('users[]', $users, old('users'), ['class' => 'form-control', 'multiple' => 'multiple','required'=>true]); ?>


               </div>

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                   <?php echo Form::label('link', trans('global.internal-notifications.fields.link') ); ?>

                 
                  <?php echo Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '']); ?>

                  <!-- end row -->
               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e($button_name); ?></button>
      </div>