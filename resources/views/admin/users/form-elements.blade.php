
            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                  <div class="form-group m-b-20">
                    {!! Form::label('name',trans('custom.users.name').'*' ) !!}

                    {!! Form::text('name', old('name'), ['class' => 'form-control',
                    'id'=>'user-name','placeholder'=>trans('custom.users.name'),'required'=> 'true'

                    ]) !!}

                  </div>

                     <div class="form-group m-b-20">
                        <label for="currency_id">{{ trans('global.currency').'*' }}</label>

                         <?php
                            $currencies = \App\Currency::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
                            $default_currency = getDefaultCurrency('id');
                            $disable = '';
                            if ( ! empty( $record ) && haveTransactions( $record->id ) ) {
                                $disable = ' disabled';
                            }
                         ?>

                        {{ Form::select('currency_id', $currencies , old('currency_id'), ['class'=>'form-control', 
                        'id'=>'currency_id', 'required' => '', $disable

                        ]) }}
                     </div>
                 
                
                    @if( $record )
                     @if( $record->currency_id )
                      <input type="hidden" name="currency_id" value="{{ $record->currency_id ?? ''}}">
                     @endif
                    @endif 

                       <div class="form-group m-b-20">

                        {!! Form::label('email',trans('custom.users.email').'*' ) !!}

                        {!! Form::email('email', old('email'), ['class' => 'form-control',
                        'id'=>'user-email','placeholder'=>trans('custom.users.email'),'required'=>'true'

                        ]) !!}  
                        
                      </div>  

                   <div class="form-group m-b-20">

                    {!! Form::label('mobile',trans('custom.users.mobile').'*' ) !!}
                        
                    {!! Form::number('mobile', old('mobile'), ['class' => 'form-control',
                      'id'=>'user-mobile','placeholder'=>trans('custom.eforms.mobile-num'),'min'=>'0'
                      
                    ]) !!}
                    
                  </div>  


                     <div class="form-group m-b-20">
                        <label for="role_id">{{ trans('custom.users.role').'*' }}</label>

                        {{ Form::select('role_id', $roles ,old('role_id'), ['class'=>'form-control', 'placeholder'=>trans('custom.users.role'),

                        'id'=>'role_id', 'required'=>'true'

                        ]) }}
                     </div>

                    <div class="form-group m-b-20">

                      {!! Form::label('skype_email',trans('custom.users.skype-email') ) !!}

                      {!! Form::email('skype_email', old('skype_email'), ['class' => 'form-control',
                      'id'=>'user-skype_email','placeholder'=>trans('custom.users.skype-email'),

                      ]) !!}
                    
                  </div>

                  <div class="form-group m-b-20">

                       {!! Form::label('phone',trans('custom.users.phone') ) !!}

                      {!! Form::text('phone', old('phone'), ['class' => 'form-control',
                      'id'=>'user-phone','placeholder'=>trans('custom.users.phone'),'min'=>'0'

                      ]) !!}

                    
                  </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">

                   <div class="form-group m-b-20">

                     {!! Form::label('password',trans('custom.users.password').'*' ) !!}

                      {!! Form::password('password', old('password'), ['class' => 'new',
                      'id'=>'user-password','placeholder'=>trans('custom.users.password'),'required'=>'true'

                      ]) !!}
                  </div>

                     <div class="form-group m-b-20">

                          {!! Form::label('description',trans('custom.users.description'),['class' => 'mb-3']) !!}

                        <div class="row">
                           <div class="col-12">

                               {!! Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'user-description', 'rows'=>'5', 'placeholder' => trans('custom.users.description')]) !!}
                           </div>
                        </div>
                        <!-- end row -->
                     </div>

                     <div class="form-group m-b-20">
                           {!! Form::label('image',trans('custom.users.image')) !!}

                           <?php
                              if( $record )
                              {
                                  $image_url = $record->image;
                                
                              }else{
                                  $image_url = null;
                              }
                           ?>
                         
                     
                        <input type="file" class="dropify" name="image"  data-height="120" value="{{ $image_url }}"  accept=".jpeg, .png, .jpg, .gif, .svg">
                        <br/>

                         @if( $record )
                          <img src="{{getDefaultimgagepath($record->image,'users')}}" height="100" width="100"> 
                         @endif
                        
                     </div>
                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
            <div class="text-center">
               <button type="submit" class="btn btn-success waves-effect waves-light">{{ $button_name }}</button>
            </div>