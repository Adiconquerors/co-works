@extends( 'layouts.new_admin_layout' )
@section( 'new_admin_head_links' )
@include('partials.newadmin.common.add-edit.formfields-headlinks')
@endsection
@section('new_content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">@lang('global.master-settings.title') </h4>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- end row -->

<div class="row">
   <div class="col-md-12">
      <div class="card-box">

        <!-- record form start -->
        {!! Form::model($master_setting, ['method' => 'PUT', 'route' => ['admin.master_settings.update', $master_setting->id],'class'=>'formvalidation']) !!}
        
           <!-- Start  -->

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                  <div class="form-group m-b-20">
                   

                    {!! Form::label('module', trans('global.master-settings.fields.module').'*') !!}

                     {!! Form::text('module', old('module'), ['class' => 'form-control', 'placeholder' => trans('global.master-settings.fields.module'), 'required' => '']) !!}

                      <p class="help-block"></p>
                    @if($errors->has('module'))
                        <p class="help-block">
                            {{ $errors->first('module') }}
                        </p>
                    @endif

                  </div>

                  <div class="form-group m-b-20">
                   
                    {!! Form::label('key', trans('global.master-settings.fields.key').'*') !!}

                    {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => trans('global.master-settings.fields.key'), 'required' => '']) !!}

                      <p class="help-block"></p>
                    @if($errors->has('key'))
                        <p class="help-block">
                            {{ $errors->first('key') }}
                        </p>
                    @endif

                  </div>

                     <div class="form-group m-b-20">
                        

                        {!! Form::label('moduletype', trans('custom.settings.moduletype').'*') !!}


                        {!! Form::select('moduletype', $enum_moduletype, old('moduletype'), ['class' => 'form-control', 'required' => '']) !!}

                        <p class="help-block"></p>
                    @if($errors->has('moduletype'))
                        <p class="help-block">
                            {{ $errors->first('moduletype') }}
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

                   @php
                      $statuses = array(
                          'Active' => trans( 'custom.common.active' ),
                      'Inactive' => trans( 'custom.common.inactive' ),
                      );
                   @endphp

                    {!! Form::label('status', trans('custom.settings.status').'*') !!}

                      {!! Form::select('status', $statuses, old('status'), ['class' => 'form-control', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif

                        
                  </div>

                     <div class="form-group m-b-20">

                           {!! Form::label('description', trans('global.master-settings.fields.description').'') !!}

                        <div class="row">
                           <div class="col-12">

                              {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('global.master-settings.fields.description'),'rows'=>'4']) !!}
                          <p class="help-block"></p>
                          @if($errors->has('description'))
                              <p class="help-block">
                                  {{ $errors->first('description') }}
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
               <button type="submit" class="btn btn-success waves-effect waves-light">@lang('global.app_update')</button>
            </div>
           <!-- End  -->

         {!! Form::close() !!}       
       
         <!-- end form -->
            <!-- users form close  -->
      </div>
      <!-- end card-box -->
   </div>
   <!-- end col -->
</div>
@stop

