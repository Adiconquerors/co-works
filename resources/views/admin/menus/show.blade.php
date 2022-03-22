@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">{{ $title }} </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('menus.index') }}">{{ ucwords($active_class) }}</a>
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

<!-- Start -->
<div class="card led-view">
 
 
<ul class="list-group list-group-flush">
 
<li class="list-group-item">@lang('custom.eforms.text') <span> {{ $record->text ?? ''}} </span> </li>
<li class="list-group-item">@lang('custom.eforms.link') <span><a href="{{$record->link}}" target="_blank"> {{ $record->link ?? '' }}</a></span></li>
<li class="list-group-item">@lang('custom.settings.type')<span>{{ $record->type ?? ''}} </span> </li>

</ul>
 
</div>
<!-- End -->

@endsection