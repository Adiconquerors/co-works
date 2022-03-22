@extends('layouts.new_admin_layout')
  @section( 'new_admin_head_links' )

  @endsection
@section( 'new_content' )

<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">@lang('global.sms-gateways.title') </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('admin.sms_gateways.index') }}">{{ ucwords($active_class) }}</a>
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
        <!-- sms_gateway form start -->
   <?php $button_name = trans('global.app_create'); ?>
          
      @if ($sms_gateway)
          <?php $button_name = trans('global.app_update'); ?>

      {!! Form::model($sms_gateway, ['method' => 'PUT', 'route' => ['admin.sms_gateways.update',$sms_gateway->id,'class'=>'formvalidation'], 'files' => true,'name'=>'formMemberType' ]) !!}
            
      @else

      {!! Form::open(['method' => 'POST', 'route' => ['admin.sms_gateways.store'], 'files' => true,'name'=>'formMemberType','class'=>'formvalidation']) !!}


        @endif

        @include('admin.sms_gateways.form-elements', 
                array('button_name'=> $button_name,'sms_gateway'=>$sms_gateway))

         {!! Form::close() !!}
         <!-- end form -->
            <!-- sms_gateways form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
@stop
@section( 'new_admin_js_scripts' )  
  @include('partials.newadmin.common.parseley-clientside-validation')
@endsection