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
               <a href="{{ route('leads.index') }}">{{ ucwords($list) }}</a>
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
   <?php $button_name = 'Create'; ?>
          
      @if ($record)
          <?php $button_name = 'Update'; ?>

      {!! Form::model($record, ['method' => 'POST', 'route' => ['leads.update',$record->id],'name'=>'formLeadType','class'=>'formvalidation' ]) !!}
            
      @else


      {!! Form::open(['method' => 'POST', 'route' => ['leads.store'], 'name'=>'formLeadType','class'=>'formvalidation']) !!}

        @endif

        @include('admin.leads.form-elements', 
                array('button_name'=> $button_name,'properties'=>$properties,'record'=>$record ))

         {!! Form::close() !!}
         <!-- end form -->
            <!-- leads form close  -->
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
@include('home-pages.common.autocomplete')
@endsection