@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> {{ $language->language }} </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('admin.languages.index') }}"> {{ ucfirst($title) }}</a>
            </li>
            <li class="breadcrumb-item">
               {{ ucfirst($title) }}
            </li>
         </ol>
         <div class="clearfix"></div>  
      </div>
   </div>
</div>
<!-- end row -->

<div class="card led-view">
 
 
      <ul class="list-group list-group-flush">
 
<li class="list-group-item">@lang('global.languages.fields.language') <span> {{ $language->language }} </span> </li>
<li class="list-group-item">@lang('global.languages.fields.code') <span> {{ $language->code }}</span></li>
<li class="list-group-item">@lang('global.languages.fields.is-rtl')<span>{{ $language->is_rtl }} </span> </li>

</ul>
 
</div>

 
@endsection