 @if($record)
    @php
      $spacetypes_id     = $record->spacetypes_id;
    @endphp

    @else

        @php    
           $spacetypes_id     = null;
        @endphp

     @endif

<div class="form-group">
      {!! Form::label('name','Sub Space name' ) !!}
          
      {!! Form::text('name', old('name'), ['class' => 'form-control',
        'id'=>'sub-space-name','placeholder'=>'Sub Space name',
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

           <h3 class="db-card-header-title">{!! Form::label('description',trans('custom.eforms.description')) !!}</h3>
         </div>
         <div class="db-card-body">

          {!! Form::textarea('description', old('description'), ['class' => 'editor-textarea' , 'rows'=>'5','cols'=>'70' , 'placeholder' => trans('custom.eforms.description')]) !!}
                              
         </div>
      </div>
      <!-- listing form desc close  -->
   </div>


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<!-- card header  -->
<div class="db-card listing-category">
    <div class="db-card-header">
        <h3 class="db-card-header-title">@lang('custom.eforms.please-select')</h3>
    </div>
    <div class="db-card-body">

    {{ Form::select('spacetypes_id', $space_types ,$spacetypes_id, $attributes = array('class'=>'select2 form-control', 'placeholder'=>'Select space status',

       'id'=>'space_type', 
       'required' => 'true',

      )) }}

    </div>
</div>
<!-- card header  -->
</div>


  @php
    $is_verified = array(
        'yes' => 'Yes',
        'no' => 'No',
    );
    @endphp

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<!-- card header  -->
<div class="db-card listing-category">
    <div class="db-card-header">
        <h3 class="db-card-header-title">@lang('custom.eforms.isverified')</h3>
    </div>
    <div class="db-card-body">

    {{ Form::select('is_verified', $is_verified, old('is_verified') ,$attributes = array('class'=>'select2 form-control',

       'id'=>'is_verified', 
       'required' => 'true',

      )) }}

    </div>
</div>
<!-- card header  -->
</div>




<div class="form-group">
  {!! Form::label('capacity',trans('custom.eforms.capacity') ) !!}
      
  {!! Form::number('capacity', old('capacity'), ['class' => 'form-control',
    'id'=>'capacity','min'=>'0','placeholder'=>trans('custom.eforms.capacity'),
    'required'=> 'true'
  ]) !!}

  @if($errors->has('capacity'))
      <p class="help-block">
          {{ $errors->first('capacity') }}
      </p>
  @endif

   </div>

   <div class="form-group">
  {!! Form::label('area',trans('custom.eforms.area') ) !!}
      
  {!! Form::number('area', old('area'), ['class' => 'form-control',
    'id'=>'area','min'=>'0','placeholder'=>trans('custom.eforms.area'),
    'required'=> 'true'
  ]) !!}

  @if($errors->has('area'))
      <p class="help-block">
          {{ $errors->first('area') }}
      </p>
  @endif

   </div>

   <div class="form-group">
  {!! Form::label('price',trans('custom.eforms.price') ) !!}
      
  {!! Form::number('price', old('price'), ['class' => 'form-control',
    'id'=>'price','min'=>'0','placeholder'=>trans('custom.eforms.price'),
    'required'=> 'true'
  ]) !!}

  @if($errors->has('price'))
      <p class="help-block">
          {{ $errors->first('price') }}
      </p>
  @endif

   </div>

   <div class="form-group">
  {!! Form::label('address',trans('custom.eforms.address') ) !!}
      
  {!! Form::text('address', old('address'), ['class' => 'form-control',
    'id'=>'address','placeholder'=>trans('custom.eforms.address'),
    'required'=> 'true'
  ]) !!}

  @if($errors->has('address'))
      <p class="help-block">
          {{ $errors->first('address') }}
      </p>
  @endif

   </div>
<!-- four images -->
       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-photo">
         <div class="db-card-header">
            <h3 class="db-card-header-title">
              {!! Form::label('image_one',trans('custom.eforms.first-image')) !!}
            </h3>
         </div>
         <div class="db-card-body">
            <!-- listing dropzone start  -->
            <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

               {!! Form::file('image_one', old('image_one') , $attributes = array('class'=>'dropzone dz-clickable','data-provides'=>'fileinput',

              )) !!}

               </div>
            </div>
            <!-- listing dropzone close  -->
            <!-- listing photo start  -->
            <div class="row">
               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="listing-photo-upload">
                     @if($record)
                      @if($record->image_one)
                     <img src="{{ IMAGE_PATH_UPLOAD_SUB_SPACE_TYPES.$record->image_one }}" alt="" class="img-fluid">
                     @endif
                     @endif

                  </div>
               </div>
            </div>
            <!-- listing photo close  -->



         </div>
      </div>
   </div>

       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-photo">
         <div class="db-card-header">
            <h3 class="db-card-header-title">
              {!! Form::label('image_two',trans('custom.eforms.second-image')) !!}
            </h3>
         </div>
         <div class="db-card-body">
            <!-- listing dropzone start  -->
            <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

               {!! Form::file('image_two', old('image_two') , $attributes = array('class'=>'dropzone dz-clickable','data-provides'=>'fileinput',

              )) !!}

               </div>
            </div>
            <!-- listing dropzone close  -->
            <!-- listing photo start  -->
            <div class="row">
               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="listing-photo-upload">
                     @if($record)
                      @if($record->image_two)
                     <img src="IMAGE_PATH_UPLOAD_SUB_SPACE_TYPES.$record->image_two" alt="" class="img-fluid">
                     @endif
                     @endif

                  </div>
               </div>
            </div>
            <!-- listing photo close  -->



         </div>
      </div>
   </div>


       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-photo">
         <div class="db-card-header">
            <h3 class="db-card-header-title">
              {!! Form::label('image_three',trans('custom.eforms.third-image')) !!}
            </h3>
         </div>
         <div class="db-card-body">
            <!-- listing dropzone start  -->
            <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

               {!! Form::file('image_three', old('image_three') , $attributes = array('class'=>'dropzone dz-clickable','data-provides'=>'fileinput',

              )) !!}

               </div>
            </div>
            <!-- listing dropzone close  -->
            <!-- listing photo start  -->
            <div class="row">
               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="listing-photo-upload">
                     @if($record)
                      @if($record->image_three)
                     <img src="IMAGE_PATH_UPLOAD_SUB_SPACE_TYPES.$record->image_three" alt="" class="img-fluid">
                     @endif
                     @endif

                  </div>
               </div>
            </div>
            <!-- listing photo close  -->



         </div>
      </div>
   </div>

       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-photo">
         <div class="db-card-header">
            <h3 class="db-card-header-title">
              {!! Form::label('image_four',trans('custom.eforms.fourth-image')) !!}
            </h3>
         </div>
         <div class="db-card-body">
            <!-- listing dropzone start  -->
            <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

               {!! Form::file('image_four', old('image_four') , $attributes = array('class'=>'dropzone dz-clickable','data-provides'=>'fileinput',

              )) !!}

               </div>
            </div>
            <!-- listing dropzone close  -->
            <!-- listing photo start  -->
            <div class="row">
               <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="listing-photo-upload">
                     @if($record)
                      @if($record->image_four)
                     <img src="IMAGE_PATH_UPLOAD_SUB_SPACE_TYPES.$record->image_four" alt="" class="img-fluid">
                     @endif
                     @endif

                  </div>
               </div>
            </div>
            <!-- listing photo close  -->



         </div>
      </div>
   </div>
   <!-- end four images -->



        




