@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> @lang('custom.users.user-details') </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('users.index') }}">{{ ucwords( $active_class ) }}</a>
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
     $user_role    = \App\Role::find($record->role_id);
    @endphp

 @lang('custom.users.name')
  <span> 
    {{ $record->name ?? '-' }} 
  </span> 
</li>
<li class="list-group-item">
  @lang('custom.users.image')
  <span> 
    @if($image)
    <img src="{{ IMAGE_PATH_UPLOAD_USERS.$image }}" alt="" class="img-fluid  d-block" height="120" width="120">
    @else
      <img src="{{ IMAGE_PATH_UPLOAD_SPACE_TYPES }}1.jpg" alt="" class="img-fluid  d-block" height="120" width="120">
    @endif
  </span>
</li>
<li class="list-group-item">@lang('custom.users.email')<span>{{ $record->email ?? '-'}} </span> </li>
<li class="list-group-item">@lang('custom.users.role')<span>{{ $user_role ? $user_role->name : '-' }}</span> </li>
<li class="list-group-item">@lang('custom.users.mobile')<span>{{ $record->mobile ? $record->mobile : '-' }}</span> </li>
<li class="list-group-item">@lang('custom.users.skype-email')<span>{{ $record->skype_email ?? '-'}}</span> </li>
<li class="list-group-item">@lang('custom.users.phone')<span>{{ $record->phone ?? '-'}}</span> </li>
<li class="list-group-item">@lang('custom.users.description')<span>{{ $record->description ?? '-' }}</span> </li>
<li class="list-group-item">@lang('custom.users.mobile-verified')<span>{{ $record->is_mobile_verified }}</span> </li>
<li class="list-group-item">@lang('global.currency')<span>{{ $record->currency->name }}</span> </li>

</ul>
 
</div>
<!-- End -->  
@endsection