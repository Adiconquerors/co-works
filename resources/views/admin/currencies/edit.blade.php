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
               <a href="{{ route('currencies.index') }}">{{ ucwords($active_class) }}</a>
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

    {!! Form::model($currency, ['method' => 'PUT', 'route' => ['currencies.update', $currency->id],'class'=>'formvalidation']) !!}
          
         <p>@lang('custom.currencies.currency_layer_message', ['url' => '<a href="https://currencylayer.com" target="_blank">https://currencylayer.com</a>', 'settings_url' => '<a href="'.url('admin/mastersettings/settings/view/currency-settings').'" target="_blank">here</a>'])</p>    

      <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                {!! Form::label('name', trans('global.currencies.fields.name').'*' ) !!}

                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.name'), 'required' => '']) !!}

              
               </div>

               <div class="form-group m-b-20">

                {!! Form::label('symbol', trans('global.currencies.fields.symbol').'*' ) !!}

               {!! Form::text('symbol', old('symbol'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.symbol'), 'required' => '']) !!}

              
               </div>

                <div class="form-group m-b-20">

                {!! Form::label('code', trans('global.currencies.fields.code').'*' ) !!}

               {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.code'), 'required' => '']) !!}

              
               </div> 

                 <div class="form-group m-b-20">

                {!! Form::label('rate', trans('global.currencies.fields.rate').'*' ) !!}

               {!! Form::number('rate', old('rate'), ['class' => 'form-control', 'placeholder' => trans('global.currencies.fields.rate'), 'required' => '','min'=>'1','step'=>'0.01']) !!}

              
               </div> 



            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                  
                  {!! Form::label('status', trans('global.currencies.fields.status').'*') !!}
                 
                   {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2', 'required' => '']) !!}
                  <!-- end row -->
               </div>

                 <div class="form-group m-b-20">
                  
                  {!! Form::label('is_default', trans('global.currencies.fields.is_default').'*') !!}
                 
                   {!! Form::select('is_default', $enum_is_default, old('is_default'), ['class' => 'form-control select2', 'required' => '']) !!}
                  <!-- end row -->
               </div>
            

              <div class="form-group m-b-20">
                  
                  {!! Form::label('update_currency_online', trans('custom.currencies.update_currency_online') ) !!}
                 
                   {!! Form::select('update_currency_online', $enum_is_default, 'no', ['class' => 'form-control select2', 'required' => '']) !!}
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