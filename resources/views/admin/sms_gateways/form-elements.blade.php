       

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                     <div class="form-group m-b-20">

                        {!! Form::label('name',trans('global.sms-gateways.fields.name') ) !!}

                        {!! Form::text('name', old('name'), ['class' => 'form-control',
                        'id'=>'name','placeholder'=>trans('global.sms-gateways.fields.name'),
                        'required'=> 'true'
                        ]) !!}
                      
                     </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                      <div class="form-group m-b-20">
                          {!! Form::label('key',trans('global.sms-gateways.fields.key') ) !!}

                          {!! Form::text('key', old('key'), ['class' => 'form-control',
	                        'id'=>'key','placeholder'=>trans('global.sms-gateways.fields.key'),
	                        'required'=> 'true'
	                        ]) !!}
                      </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
            </div>
            <!-- End row -->
            <div class="row">
            	<div class="col-md-6">
                  <div class="p-20">
                      
                       <div class="form-group m-b-20">

                        {!! Form::label('description',trans('global.sms-gateways.fields.description') ) !!}

                        {!! Form::text('description', old('description'), ['class' => 'form-control',
                        'id'=>'description','placeholder'=>trans('global.sms-gateways.fields.description'),
                        'required'=> 'true'
                        ]) !!}
                        
                       </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
            </div>
            <!-- end row -->
            <div class="text-center">
               <button type="submit" class="btn btn-success waves-effect waves-light">{{ $button_name }}</button>
            </div>