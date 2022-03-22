
            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                  <div class="form-group m-b-20">
                    <?php echo Form::label('name',trans('custom.users.name').'*' ); ?>


                    <?php echo Form::text('name', old('name'), ['class' => 'form-control',
                    'id'=>'user-name','placeholder'=>trans('custom.users.name'),'required'=> 'true'

                    ]); ?>


                  </div>

                     <div class="form-group m-b-20">
                        <label for="currency_id"><?php echo e(trans('global.currency').'*'); ?></label>

                         <?php
                            $currencies = \App\Currency::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
                            $default_currency = getDefaultCurrency('id');
                            $disable = '';
                            if ( ! empty( $record ) && haveTransactions( $record->id ) ) {
                                $disable = ' disabled';
                            }
                         ?>

                        <?php echo e(Form::select('currency_id', $currencies , old('currency_id'), ['class'=>'form-control', 
                        'id'=>'currency_id', 'required' => '', $disable

                        ])); ?>

                     </div>
                 
                
                    <?php if( $record ): ?>
                     <?php if( $record->currency_id ): ?>
                      <input type="hidden" name="currency_id" value="<?php echo e($record->currency_id ?? ''); ?>">
                     <?php endif; ?>
                    <?php endif; ?> 

                       <div class="form-group m-b-20">

                        <?php echo Form::label('email',trans('custom.users.email').'*' ); ?>


                        <?php echo Form::email('email', old('email'), ['class' => 'form-control',
                        'id'=>'user-email','placeholder'=>trans('custom.users.email'),'required'=>'true'

                        ]); ?>  
                        
                      </div>  

                   <div class="form-group m-b-20">

                    <?php echo Form::label('mobile',trans('custom.users.mobile').'*' ); ?>

                        
                    <?php echo Form::number('mobile', old('mobile'), ['class' => 'form-control',
                      'id'=>'user-mobile','placeholder'=>trans('custom.eforms.mobile-num'),'min'=>'0'
                      
                    ]); ?>

                    
                  </div>  


                     <div class="form-group m-b-20">
                        <label for="role_id"><?php echo e(trans('custom.users.role').'*'); ?></label>

                        <?php echo e(Form::select('role_id', $roles ,old('role_id'), ['class'=>'form-control', 'placeholder'=>trans('custom.users.role'),

                        'id'=>'role_id', 'required'=>'true'

                        ])); ?>

                     </div>

                    <div class="form-group m-b-20">

                      <?php echo Form::label('skype_email',trans('custom.users.skype-email') ); ?>


                      <?php echo Form::email('skype_email', old('skype_email'), ['class' => 'form-control',
                      'id'=>'user-skype_email','placeholder'=>trans('custom.users.skype-email'),

                      ]); ?>

                    
                  </div>

                  <div class="form-group m-b-20">

                       <?php echo Form::label('phone',trans('custom.users.phone') ); ?>


                      <?php echo Form::text('phone', old('phone'), ['class' => 'form-control',
                      'id'=>'user-phone','placeholder'=>trans('custom.users.phone'),'min'=>'0'

                      ]); ?>


                    
                  </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">

                   <div class="form-group m-b-20">

                     <?php echo Form::label('password',trans('custom.users.password').'*' ); ?>


                      <?php echo Form::password('password', old('password'), ['class' => 'new',
                      'id'=>'user-password','placeholder'=>trans('custom.users.password'),'required'=>'true'

                      ]); ?>

                  </div>

                     <div class="form-group m-b-20">

                          <?php echo Form::label('description',trans('custom.users.description'),['class' => 'mb-3']); ?>


                        <div class="row">
                           <div class="col-12">

                               <?php echo Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'user-description', 'rows'=>'5', 'placeholder' => trans('custom.users.description')]); ?>

                           </div>
                        </div>
                        <!-- end row -->
                     </div>

                     <div class="form-group m-b-20">
                           <?php echo Form::label('image',trans('custom.users.image')); ?>


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

                         <?php if( $record ): ?>
                          <img src="<?php echo e(getDefaultimgagepath($record->image,'users')); ?>" height="100" width="100"> 
                         <?php endif; ?>
                        
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