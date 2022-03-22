<div class="form-group">
      {!! Form::label('name',trans('custom.days.name') ) !!}
          
      {!! Form::text('name', old('name'), ['class' => 'form-control',
        'id'=>'day-name','placeholder'=>trans('custom.days.name'),
        'required'=> 'true'
      ]) !!}

      @if($errors->has('name'))
          <p class="help-block">
              {{ $errors->first('name') }}
          </p>
      @endif

       </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- listing form desc start  -->
      <div class="db-card listing-description">
         <div class="db-card-header">

           <h3 class="db-card-header-title">{!! Form::label('description',trans('custom.days.description')) !!}</h3>
         </div>
         <div class="db-card-body">

          {!! Form::textarea('description', old('description'), ['class' => 'editor-textarea' , 'rows'=>'5','cols'=>'70' , 'placeholder' => trans('custom.days.description')]) !!}
                              
         </div>
      </div>
      <!-- listing form desc close  -->
   </div>





