@extends( 'layouts.main' )

 @section( 'main_header_styles' )
 <style>
   .expertise-margin{
      margin-top:-118px;
   }
   .card-margin{
      margin-top:-50px; 
   }
   .sty-h420{
      height:420px;
   }
   .selh{
   	    height: 50px;
   }
   .our-loctop .btn + p {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}

.pad_50{
	margin-bottom: 100px;
}
 </style>
 @endsection

@section( 'content' )
<main class="main">
 <div class="our-loctop">   
<div class="container">
<div class="row">
<div class="col-lg-6 col-xs-12 col-lg-offset-3">
<h1 class="home-hero__title">  @lang('custom.mplocations.nearbylocations')</h1>
 <form  action="{{ route('properties.list') }}">
	<div class="form-group">
		 <input name="location" id="search" type="text"  placeholder="@lang('others.search-by')" autocomplete="off" onclick="initialize_top('search')" class="form-control">
	</div>
			@php
				$items = \App\SpaceType::getSpaceTypes(0);
			@endphp
				<div class="form-group">
					<select class="form-control minimal selh" id="sel1" name="wstype">

				@foreach( $items as $item )
					<option value="{{$item->id}}">{{ $item->name }}</option>
				@endforeach

				</select>
			</div>

	<div class="form-group">
	  <button type="submit" class="btn btn-info btn-lg btn-block"  id="span-search">@lang('custom.mplocations.submit')</button>
<p class="pad_50">  @lang('custom.mplocations.check-near')</p>

	</div>
</form>
</div>
</div>
</div>


</div>
<!-- footer -->
@include ( 'partials.footer' )
<!-- end footer -->

@include('home-pages.common.initializetop')
      
@stop