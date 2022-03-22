@extends('layouts.new_admin_layout')
@section( 'new_admin_head_links' )
  @include('partials.newadmin.common.add-edit.formfields-headlinks')
@endsection
@section( 'new_content' )

<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">{{ $title }} </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('testimonials.index') }}">{{ ucwords($active_class) }}</a>
            </li>
           
            <li class="breadcrumb-item">
               {{$title}}
            </li>
         </ol>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- end row -->
<div class="row">
   <div class="col-md-12">
      <div class="card-box">
         
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
  @endif
        <!-- article form start -->

    {!! Form::model($language, ['method' => 'PUT', 'route' => ['admin.languages.update', $language->id],'class'=>'formvalidation']) !!}

          

      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                {!! Form::label('language', trans('global.languages.fields.language').'*' ) !!}

                {!! Form::text('language', old('language'), ['class' => 'form-control', 'placeholder' => trans('global.languages.fields.language'), 'required' => '']) !!}

              
               </div>

               <div class="form-group m-b-20">

                {!! Form::label('code', trans('global.languages.fields.code').'*' ) !!}

                {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('global.languages.fields.code'), 'required' => '']) !!}

              
               </div>

            

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                  
                  {!! Form::label('is_rtl', trans('global.languages.fields.is-rtl').'*') !!}
                 
                  {!! Form::select('is_rtl', $enum_is_rtl, old('is_rtl'), ['class' => 'form-control select2', 'required' => '']) !!}
                  <!-- end row -->
               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
      <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light">{{ trans('global.app_update') }}</button>
      </div>


          

         {!! Form::close() !!}
         <!-- end form -->
            <!-- testimonials form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
@stop
@section( 'new_admin_js_scripts' )  
  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')
  @include('partials.newadmin.common.parseley-clientside-validation')
@endsection