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
            <h2 class="db-pageheader-title">{{ $title }}</h2>
            <p class="db-pageheader-text"> @lang('custom.days.add_new_day') </p>
         </div>
         <div class="d-flex align-items-center">
            <a href="{{ route('days.index') }}" class="btn btn-primary">@lang('custom.days.back_days')</a>
         </div>
      </div>
      <!-- pageheader close  -->
   </div>
</div>

<div class="row">

   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="db-card listing-details">
         <div class="db-card-header">
            <h3 class="db-card-header-title">@lang('custom.days.fontawesome-days')</h3>
         </div>
         <div class="db-card-body">
            <!-- listing form start -->
	<?php $button_name = trans('global.app_create'); ?>
          
      @if ($record)
          <?php $button_name = trans('global.app_update'); ?>

		{!! Form::model($record, ['method' => 'PUT', 'route' => ['days.update',$record->slug], 'files' => true,'name'=>'formDayType' ]) !!}
            
		@else

		{!! Form::open(['method' => 'POST', 'route' => ['days.store'], 'files' => true,'name'=>'formDayType']) !!}

        @endif

        @include('admin.days.form-elements', 
					 array('button_name'=> $button_name,'record'=>$record))

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