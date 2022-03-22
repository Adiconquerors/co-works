@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> @lang('custom.icons.amenities') </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('amenities.index') }}">{{ ucwords( $active_class ) }}</a>
            </li>
            <li class="breadcrumb-item">
               {{ $title }}
            </li>
         </ol>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
   
 <!-- Start -->
<div class="card led-view">
 
 
<ul class="list-group list-group-flush">
 
<li class="list-group-item">@lang('custom.icons.name') <span> {{ $record->name }} </span> </li>
<li class="list-group-item">@lang('custom.icons.icon') <span> <i class="{{ $record->icon->name }}"> </i> </span></li>
<li class="list-group-item">@lang('custom.icons.icon-name')<span>{{ $record->icon->name }} </span> </li>
<li class="list-group-item">@lang('custom.icons.description')<span>{{ $record->description }} </span> </li>

</ul>
 
</div>
<!-- End -->  


@endsection