@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
  @include('partials.newadmin.common.add-edit.formfields-headlinks')
@endsection

@section( 'new_content' )
<style>
.span-margin{
  margin-left:15px;color:green;
}
.b-fnt{
  font-size:25px;
}
</style>
  <div class="row">
   <div class="col-md-12">
     <b class="b-fnt">@lang('custom.connect.earn') <br/>
           <span class="span-margin">@lang('custom.connect.deal-value')</span> 
        </b>  
      <div class="card-box">

 @if (\Session::has('connect'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('connect') !!}</li>
        </ul>
    </div>
@endif
 

      {!! Form::open(['method' => 'POST', 'route' => ['connect'], 'files' => true,'name'=>'formConnect','class'=>'formvalidation' ]) !!}

        <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                {!! Form::label('company_name',trans('custom.connect.company-name') ) !!}

                {!! Form::text('company_name', null, ['class' => 'form-control',
                'id'=>'connect-companyname','placeholder'=>trans('custom.connect.company-name'),'required'=>'true',

                ]) !!}

               </div>

                <div class="form-group m-b-20">
                {!! Form::label('client_name',trans('custom.connect.client-name') ) !!}

                {!! Form::text('client_name',null, ['class' => 'form-control',
                'id'=>'connect-clientname','placeholder'=>trans('custom.connect.client-name'),'required'=>'true',

                ]) !!}

               </div>

                <div class="form-group m-b-20">
                {!! Form::label('no_of_seats',trans('custom.connect.no-of-seats') ) !!}

                {!! Form::number('no_of_seats',null, ['class' => 'form-control','min'=>'0',
                'id'=>'connect-no-of-seats','placeholder'=>trans('custom.connect.no-of-seats'),'required'=>'true',

                ]) !!}

               </div>       


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
              
               <div class="form-group m-b-20">
                {!! Form::label('mobile',trans('custom.connect.mobile-number') ) !!}

                {!! Form::text('mobile',null, ['class' => 'form-control',
                'id'=>'connect-mobile','placeholder'=>trans('custom.connect.mobile-number'),'required'=>'true',

                ]) !!}

               </div>


               <div class="form-group m-b-20">
                {!! Form::label('location',trans('custom.connect.location') ) !!}

                {!! Form::text('location',null, ['class' => 'form-control',
                'id'=>'connect-location','placeholder'=>trans('custom.connect.location'),'required'=>'true',

                ]) !!}

               </div>

                 <div class="form-group m-b-20">
                {!! Form::label('email',trans('custom.connect.emailid') ) !!}

                {!! Form::email('email',null, ['class' => 'form-control',
                'id'=>'connect-email','placeholder'=>trans('custom.connect.emailid'),'required'=>'true',

                ]) !!}

               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row --> 

       <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light">@lang('custom.connect.send')</button>
      </div>
      
         {!! Form::close() !!}
         <!-- end form -->
            
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