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
               <a href="{{ route('templates.index') }}">{{ ucwords($active_class) }}</a>
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
        <!-- template form start -->
   <?php $button_name = trans('global.app_create'); ?>
          
      @if ($template)
          <?php $button_name = trans('global.app_update'); ?>

      {!! Form::model($template, ['method' => 'PUT', 'route' => ['templates.update',$template->id], 'name'=>'formTemplateType','class'=>'formvalidation' ]) !!}
            
      @else


      {!! Form::open(['method' => 'POST', 'route' => ['templates.store'], 'name'=>'formTemplateType','class'=>'formvalidation']) !!}

        @endif

        @include('admin.templates.form-elements', 
                array('button_name'=> $button_name,'template'=>$template ))

         {!! Form::close() !!}
         <!-- end form -->
            <!-- templates form close  -->
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