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
                {!! Form::label('text', trans('global.internal-notifications.fields.text').'*' ) !!}

                {!! Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => trans('global.internal-notifications.fields.text'),'required'=>'true']) !!}

               </div>

                <div class="form-group m-b-20">

                  <?php
                    $type = array(
                        'topbar' => 'topbar',
                        'sidebar' => 'sidebar',
                    );

                  ?>   

              {!! Form::label('type',trans('custom.settings.type')) !!}

              {!! Form::select('type', $type, old('type') ,['class' => 'form-control'

              ]) !!}
                  

               </div>


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                   {!! Form::label('link', trans('global.internal-notifications.fields.link') ) !!}
                 
                  {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => trans('global.internal-notifications.fields.link')]) !!}
                  <!-- end row -->
               </div>

                   <div class="form-group m-b-20">
                        <label for="icon_id">@lang('custom.icons.select-icon') :&nbsp;</label>

                          @foreach( $icons as $icon )
                            <i class="{{ $icon }}"></i>
                          @endforeach 

                         {!! Form::select('icon_id', $icons ,$icon_id, ['class' => 'form-control', 'id' => 'icon_id','placeholder'=>'Please Select' ]) !!}

                       
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