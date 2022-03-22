 
      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                {!! Form::label('name',trans('custom.users.name').'*' ) !!}

                {!! Form::text('name', old('name'), ['class' => 'form-control',
                'id'=>'venue','placeholder'=>trans('custom.users.name'),
                'required'=> 'true'
                ]) !!}  

               </div>

                <div class="form-group m-b-20">
                     {!! Form::label('image','Image') !!}

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

                   <img src="{{getDefaultimgagepath($image_url,'testimonials','')}}" width="100" height="70" class="sty-br">
                  
               </div>

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                  {!! Form::label('description',trans('custom.users.description')) !!}
                 
                  {!! Form::textarea('description', old('description'), ['class' => 'summernote' , 'id'=>'venue-description', 'placeholder' => trans('custom.users.description'),'required'=> 'true']) !!}
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