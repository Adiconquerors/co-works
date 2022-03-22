       <div class="row">
               <div class="col-md-6">
                  <div class="p-20">


                     <div class="form-group m-b-20">
                        {!! Form::label('name',trans('custom.eforms.name') ) !!}

                        {!! Form::text('name', old('name'), ['class' => 'form-control',
                        'id'=>'venue','placeholder'=>trans('custom.eforms.name'),
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
                         {!! Form::label('description',trans('custom.eforms.description')) !!}
                       
                        <div class="row">
                           <div class="col-12">
                              {!! Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'venue-description', 'placeholder' => trans('custom.eforms.description'),'rows'=>'3']) !!}  
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
               <button type="submit" class="btn btn-success waves-effect waves-light">{{ $button_name }}</button>
            </div>