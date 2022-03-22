@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<style>
  .lglvh{
      visibility:hidden;
  }
</style>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> @lang('custom.eforms.tdetails') </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('testimonials.index') }}">{{ ucwords( $active_class ) }}</a>
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
 
<li class="list-group-item">

    @php
     $image = $record->image;
     $description = strip_tags($record->description);
    @endphp

 @lang('custom.users.name') 
  <span> 
    {{ $record->name ?? ''}} 
  </span> 
</li>
<li class="list-group-item">
  @lang('custom.users.image')
  <span> 
    @if($image)
    <img src="{{ IMAGE_PATH_UPLOAD_TESTIMONALS.$image }}" alt="" class="img-fluid  d-block" height="120" width="120">
    @else
      <img src="{{ IMAGE_PATH_UPLOAD_SPACE_TYPES }}1.jpg" alt="" class="img-fluid  d-block" height="120" width="120">
    @endif
  </span>
</li>
<li class="list-group-item">@lang('custom.users.description') <span>{{$record->description ? $description : '-' }} </span> </li>
<li class="list-group-item lglvh">@lang('custom.users.description') <span>{{$record->description ? $description : '-' }} </span> </li>


</ul>
 
</div>
<!-- End -->  
@endsection