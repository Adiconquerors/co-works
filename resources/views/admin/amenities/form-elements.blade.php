  @if($record)
    @php
      $icon_id = $record->icon_id;
    @endphp

    @else

         @php
           $icon_id = null;
        @endphp
   @endif

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                       <div class="form-group m-b-20">
                        {!! Form::label('name',trans('custom.icons.name') ) !!}

                      {!! Form::text('name', old('name'), ['class' => 'form-control',
                          'id'=>'icon-name','placeholder'=>trans('custom.icons.name'),
                          'required'=> 'true'
                        ]) !!}

                     </div> 

                     <div class="form-group m-b-20">
                        <label for="icon_id">@lang('custom.icons.select-icon')&nbsp;</label>

                          @foreach( $icons as $icon )
                            <i class="{{ $icon }}"></i>
                          @endforeach 

                         {!! Form::select('icon_id', $icons ,$icon_id, ['class' => 'form-control', 'id' => 'icon_id','required'=> 'true','placeholder'=>trans('custom.postrequirement.please_select') ]) !!}

                     </div>


                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                     <div class="form-group m-b-20">
                         {!! Form::label('description',trans('custom.icons.description'),['class' => 'mb-3']) !!}
                       
                        <div class="row">
                           <div class="col-12">

                              {!! Form::textarea('description', old('description'), [ 'id'=>'icon-description', 'placeholder' => trans('custom.icons.description') ,'rows'=>'5']) !!}  
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