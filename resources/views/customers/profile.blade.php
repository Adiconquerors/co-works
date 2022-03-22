@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
  @include('partials.newadmin.common.add-edit.formfields-headlinks')
@endsection

 @if($record)
    @php
      $name      = $record->name;
      $mobile    = $record->mobile;
      $image    = $record->image;
      $email    = $record->email;
    @endphp

    @else

      @php
        $name      = null;
        $mobile    = null;
        $email     = null;
        $image     = old('image');
      @endphp

     @endif    

@section( 'new_content' )
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
 

      {!! Form::open(['method' => 'POST', 'route' => ['profile.settings'], 'files' => true,'name'=>'formPropertyType','class'=>'formvalidation', 'enctype' => 'multipart/form-data' ]) !!}

               <div class="row">
         <div class="col-md-6">
            <div class="p-20">

               <div class="form-group m-b-20">
                {!! Form::label('name',trans('custom.users.name') ) !!}

                {!! Form::text('name',  $name , ['class' => 'form-control',
                'id'=>'user-name','placeholder'=>trans('custom.users.name'),'required'=>'true',

                ]) !!}

               </div>

                    <div class="form-group m-b-20">
                     {!! Form::label('image',trans('custom.articles.image')) !!}

                     <?php
                        if( $record )
                        {
                            $image_url = $record->image;
                          
                        }else{
                            $image_url = null;
                        }
                     ?>
                   
                    

               
                  <input type="file" class="dropify" name="image"  data-height="120" value="{{ $image_url }}"  accept=".jpeg, .png, .jpg, .gif, .svg">
                  <br/>
                    <img src="{{getDefaultimgagepath($image_url,'users','')}}" width="100" height="100">                  
               </div>


    
              


            </div>
            <!-- end class p-20 -->
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="p-20">

              <?php
              $disabled_enabled = '';
              if( isAdmin() )
              {
                $disabled_enabled = 'enabled';
              }else
              {
                $disabled_enabled = 'disabled';
              }
             ?>
              
               <div class="form-group m-b-20">
                    {!! Form::label('email',trans('custom.users.email') ) !!}
                 
                  <div class="row">
                     <div class="col-12">

                        {!! Form::email('email', $email, ['class' => 'form-control',
                        'id'=>'user-email','placeholder'=>trans('custom.users.email'), $disabled_enabled => $disabled_enabled,'required'=>'true',

                        ]) !!}

                     </div>

                      <div class="col-12">

                         {!! Form::label('mobile',trans('custom.users.mobile') ) !!}

                        {!! Form::text('mobile', $mobile, ['class' => 'form-control',
                        'id'=>'user-mobile','placeholder'=>trans('custom.users.mobile'),$disabled_enabled => $disabled_enabled,'required'=>'true',

                        ]) !!}
                       

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