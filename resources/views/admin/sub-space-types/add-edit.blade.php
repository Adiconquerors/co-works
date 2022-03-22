@extends( 'layouts.admin_layout' )
@section( 'admin_head_links' )
	@include('admin.common.head-links')
@endsection

@section( 'dashboard_content' )
<div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- pageheader start  -->
      <div class="db-pageheader d-flex justify-content-between">
         <div class="">
            <h2 class="db-pageheader-title">{{ $title }}
              
            </h2>
            <p class="db-pageheader-text"> @lang('custom.eforms.addsubtypes') </p>
         </div>
         <div class="d-flex align-items-center">
            <a href="{{ route('sub_space_types.index') }}" class="btn btn-primary">@lang('custom.eforms.backsubtypes')</a>
         </div>
      </div>
      <!-- pageheader close  -->
   </div>
</div>

<div class="row">

   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-details">
         <div class="db-card-header">
            <h3 class="db-card-header-title">@lang('custom.eforms.detailssubtypes')</h3>
         </div>
         <div class="db-card-body">
            <!-- listing form start -->
	<?php $button_name = 'Create'; ?>
          
      @if ($record)
          <?php $button_name = 'Update'; ?>

		{!! Form::model($record, ['method' => 'PUT', 'route' => ['sub_space_types.update',$record->slug], 'files' => true,'name'=>'formSubSpaceType' ]) !!}
            
		@else

		{!! Form::open(['method' => 'POST', 'route' => ['sub_space_types.store'], 'files' => true,'name'=>'formSubSpaceType']) !!}

        @endif

   @include('admin.sub-space-types.form-elements', 
	array('button_name'=> $button_name,'record'=>$record,'space_types'=>$space_types,'space_type_parent_list'=>$space_type_parent_list,'space_type_lists',$space_type_lists))

            <!-- listing form close  -->
         </div>

      </div>
   </div>
   
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <button type="submit" class="btn btn-primary">{{$button_name}}</button>
   </div>
      {!! Form::close() !!}
</div>
@endsection

@section( 'admin_script_links' )
 @include('admin.common.script-links')
@endsection