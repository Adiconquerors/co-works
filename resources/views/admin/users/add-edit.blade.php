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
               <a href="{{ route('users.index') }}">{{ ucwords($active_class) }}</a>
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
        <!-- record form start -->
   <?php $button_name = trans('global.app_create'); ?>
          
      @if ($record)
          <?php $button_name = trans('global.app_update'); ?>

      {!! Form::model($record, ['method' => 'PUT', 'route' => ['users.update',$record->id], 'files' => true,'name'=>'formUserType','class'=>'formvalidation', 'enctype' => 'multipart/form-data' ]) !!}
            
      @else


      {!! Form::open(['method' => 'POST', 'route' => ['users.store'], 'files' => true,'name'=>'formUserType','class'=>'formvalidation', 'enctype' => 'multipart/form-data']) !!}

        @endif

        @include('admin.users.form-elements', 
                array('button_name'=> $button_name,'record'=>$record ))

         {!! Form::close() !!}
         <!-- end form -->
            <!-- users form close  -->
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