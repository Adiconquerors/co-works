 
      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                {!! Form::label('name',trans('custom.users.name') ) !!}

                {!! Form::text('name', old('name'), ['class' => 'form-control',
                    'id'=>'icon-name','placeholder'=>trans('custom.eforms.name'),
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
                   {!! Form::label('description',trans('custom.users.description'),['class' => 'mb-3']) !!}
                 
                  <div class="row">
                     <div class="col-12">

                        {!! Form::textarea('description', old('description'), [ 'id'=>'icon-description', 'placeholder' => trans('custom.eforms.description'),'rows'=>'5']) !!}  
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