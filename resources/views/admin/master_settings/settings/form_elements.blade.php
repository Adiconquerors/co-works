				
			<div class="col-xs-6"> 	

				<div class="form-group">
                    {!! Form::label('title', getPhrase('title'), ['class' => 'control-label']) !!}

                    <span class="text-red">*</span>

                    {{ Form::text('title', old('title'), $attributes = 

                    array('class' => 'form-control', 

                    'placeholder' => trans('global.master-settings.title'),

                    'ng-model' => 'title', 

                    'required' => 'true',

                    'ng-pattern' => getRegexPattern("name"),

					
					'ng-class'=>'{"has-error": formValidate.title.$touched && formValidate.title.$invalid}',



                    )) }}


                    
                    <div class="validation-error" ng-messages="formValidate.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

					</div>

                </div>




                <div class="form-group">

                    {!! Form::label('key', getPhrase('key'), ['class' => 'control-label']) !!}

                    <span class="text-red">*</span>

                    {{ Form::text('key', old('key'), $attributes = 

                    array('class' => 'form-control', 

                    'placeholder' => trans('global.master-settings.key'),

                    'ng-model' => 'key', 

                    'required' => 'true',

                    'readonly'=>'true',
                  
                    'ng-class'=>'{"has-error": formValidate.key.$touched && formValidate.key.$invalid}',



                    )) }}


                    
                    <div class="validation-error" ng-messages="formValidate.key.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('pattern')!!}

                    </div>


                </div>




                 <div class="form-group">

                    {{ Form::label('image', getphrase('image')) }}

                    <div class="form-group">

                             <div class="row"> 

                       <div class="col-md-6">

                            

                        {!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

                        </div>

                        <?php if(isset($record) && $record) { 

                              if($record->image!='') {

                            ?>

                        <div class="col-md-6">
                            
                            @if ( ! empty( $record->image ) && file_exists($record->image))
                            <img src="{{ IMAGE_PATH_SETTINGS.$record->image }}" height="80" width="150"/>
                            @else
                            <img src="{{ DEFAULT_SPACETYPES_PATH }}" height="80" width="150"/>
                            @endif



                        </div>

                        <?php } } ?>
                     </div>  

                 </div>



                 <div class="form-group">

                    {!! Form::label('description', getPhrase('description'), ['class' => 'control-label']) !!}

                   
                    {{ Form::textarea('description', old('description'), $attributes = 

                    array('class' => 'form-control', 

                    'placeholder' => trans('global.master-settings.description'),

                    'ng-model' => 'description'

                    )) }}

                </div>




               <div class="form-group pull-right">

					<button class="btn btn-success" ng-disabled='!formValidate.$valid'>{{ getPhrase('save') }}</button>

				</div>

			</div>



                