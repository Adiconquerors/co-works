@extends( 'layouts.admin_layout' )
@section( 'admin_head_links' )
  @include('admin.common.head-links')
@endsection

@section( 'dashboard_content' )

<div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- pageheader start  -->
      <div class="db-pageheader d-flex justify-content-between">
         <div class="">
            <h2 class="db-pageheader-title"></h2>
           
         </div>
         <div class="d-flex align-items-center">
            <a href="{{ route('templates.index') }}" class="btn btn-primary">@lang('custom.eforms.back-to-templates')</a>
         </div>
      </div>
      <!-- pageheader close  -->
   </div>
</div>


<div class="row">

   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-details">
         <div class="db-card-header">
            <h3 class="db-card-header-title">@lang('custom.eforms.email-template-details')</h3>
         </div>
         <div class="db-card-body">
            <!-- listing form start -->
 
    {!! Form::open(['method' => 'POST', 'route' => ['templates.store'], 'files' => true,'name'=>'formTemplateType']) !!}

    

       <div class="form-group">
      {!! Form::label('title',trans('custom.templates.title').'*' ) !!}

      
          
      {!! Form::text('title', old('title'), ['class' => 'form-control',
        'id'=>'template-name','placeholder'=>trans('custom.templates.title'),
        'required'=> 'true'
      ]) !!}

      @if($errors->has('name'))
          <p class="help-block">
              {{ $errors->first('name') }}
          </p>
      @endif

       </div>


       <div class="form-group">
      {!! Form::label('key',trans('custom.templates.key').'*' ) !!}
          
      {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => trans('custom.templates.key'), 'required' => '']) !!}

      @if($errors->has('key'))
          <p class="help-block">
              {{ $errors->first('key') }}
          </p>
      @endif

       </div>

    <div class="form-group">
      {!! Form::label('type',trans('custom.templates.type').'*' ) !!}

      {!! Form::select('type', $enum_type ,old('type'),  ['class'=>'select2 form-control', 

      'required' => ''

      ]) !!}
          

      @if($errors->has('type'))
          <p class="help-block">
              {{ $errors->first('type') }}
          </p>
      @endif

       </div>
   


      <div class="form-group">
      {!! Form::label('subject',trans('custom.templates.subject').'*' ) !!}

      {!! Form::text('subject', old('subject'), ['class' => 'form-control','placeholder'=>trans('custom.templates.subject'),
      'required'=> 'true'
      ]) !!}

      @if($errors->has('subject'))
      <p class="help-block">
      {{ $errors->first('subject') }}
      </p>
      @endif

      </div>

       <div class="form-group">
      {!! Form::label('from_email',trans('custom.templates.from-email').'*' ) !!}

      {!! Form::text('from_email', old('from_email'), ['class' => 'form-control', 'placeholder' => trans('custom.templates.from-email')]) !!}

      
      @if($errors->has('from_email'))
      <p class="help-block">
      {{ $errors->first('from_email') }}
      </p>
      @endif

      </div>


          <div class="form-group">
      {!! Form::label('from_name',trans('custom.templates.from-name').'*' ) !!}

      {!! Form::text('from_name', old('from_name'), ['class' => 'form-control', 'placeholder' =>trans('custom.templates.from-name')]) !!}

      

      @if($errors->has('from_name'))
      <p class="help-block">
      {{ $errors->first('from_name') }}
      </p>
      @endif

      </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- listing form desc start  -->
      <div class="db-card listing-description">
         <div class="db-card-header">

           <h3 class="db-card-header-title">{!! Form::label('content',trans('custom.templates.content')) !!}</h3>
         </div>
         <div class="db-card-body">

          {!! Form::textarea('content', old('content'), ['class' => 'editor-textarea' , 'rows'=>'5','cols'=>'70' , 'placeholder' => trans('custom.templates.content'),'required'=>'true']) !!}

          
                   
            @if($errors->has('content'))
          <p class="help-block">
              {{ $errors->first('content') }}
          </p>
      @endif

         </div>
      </div>
      <!-- listing form desc close  -->
   </div>
        


            <!-- listing form close  -->
         </div>

      </div>
   </div>
   
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <button type="submit" class="btn btn-primary">{{ trans('custom.templates.create') }}</button>
   </div>
      {!! Form::close() !!}
</div>



@endsection

@section( 'admin_script_links' )
 @include('admin.common.script-links')
@endsection
    