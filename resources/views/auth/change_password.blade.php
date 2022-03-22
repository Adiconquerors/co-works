@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
@include('partials.newadmin.common.add-edit.formfields-headlinks')
@endsection

@section( 'new_content' )
  <div class="row">
   <div class="col-md-12">
      <div class="card-box">

      @if(session('success'))
		<!-- If password successfully show message -->
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
	@else	

		{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}

        <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">

                {!! Form::label('current_password',trans('custom.eforms.currentpassword') ) !!}

				{!! Form::password('current_password', ['class' => 'form-control','id'=>'current_password','placeholder'=>trans('custom.eforms.currentpassword'), 'required'=>'true'

				]) !!}

				@if($errors->has('current_password'))
					<p class="help-block">
					{{ $errors->first('current_password') }}
					</p>
				@endif

               </div>

            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">
    
               <div class="form-group m-b-20">
                    {!! Form::label('new_password', trans('custom.eforms.newpassword')) !!}
                 
                  <div class="row">
                     <div class="col-12">

					{!! Form::password('new_password', ['class' => 'form-control','id'=>'new_password','placeholder'=>trans('custom.eforms.newpassword'), 'required'=>'true'

						]) !!}

					@if($errors->has('new_password'))
					<p class="help-block">
					{{ $errors->first('new_password') }}
					</p>
					@endif		

                     </div>

                      <div class="col-12">

                      	{!! Form::label('new_password_confirmation', trans('custom.eforms.confirm-new-password')) !!}


						{!! Form::password('new_password_confirmation',['class' => 'form-control','id'=>'new_password_confirmation','placeholder'=>trans('custom.eforms.confirm-new-password'), 'required'=>'true'

						]) !!}

						@if($errors->has('new_password_confirmation'))
							<p class="help-block">
								{{ $errors->first('new_password_confirmation') }}
							</p>
						@endif


                     </div>
                  </div>
                  <!-- end row -->
               </div>
            
            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row --> 

       <div class="text-center">
         <button type="submit" class="btn btn-success waves-effect waves-light">@lang('custom.eforms.change-password')</button>
      </div>
      
         {!! Form::close() !!}
      @endif
         <!-- end form -->
            <!-- change password form close  -->
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