@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> @lang('custom.templates.email-template-details') </h4>
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
<!-- end row -->
<div class="blog-list-wrapper">
   <div class="row">
       
      <div class="col-lg-10">
         <div class="p-20">
            <!-- Image Post -->
            <div class="blog-post m-b-30">

               <div class="post-title">
                  <h5>@lang('custom.templates.title')</h5>
               </div>
               <div>
                  <p>{{ $template->title }}</p>
               </div>

             
               
               <div class="post-title">
                  <h5>@lang('custom.templates.key')</h5>
               </div>
               <div>
                  <p>{{ $template->key }}</p>
               </div>  

               <div class="post-title">
                  <h5>@lang('custom.templates.type')</h5>
               </div>
               <div>
                  <p>{{ $template->type }}</p>
               </div> 

                <div class="post-title">
                  <h5>@lang('custom.templates.subject')</h5>
               </div>
               <div>
                  <p>{{ $template->subject }}</p>
               </div> 

               <div class="post-title">
                  <h5>@lang('custom.templates.from-name')</h5>
               </div>
               <div>
                  <p>{{ $template->from_name }}</p>
               </div> 


              <div class="post-title">
                  <h5>@lang('custom.templates.from-email')</h5>
               </div>
               <div>
                  <p>{{ $template->from_email }}</p>
               </div> 

               <div class="post-title">
                  <h5>@lang('custom.templates.status')</h5>
               </div>
               <div>
                  <p>{{ $template->status }}</p>
               </div> 


              <div class="post-title">
                  <h5>@lang('custom.templates.content')</h5>
               </div>
               <div>
                  <p>{!! $template->content !!}</p>
               </div> 

              
            </div>
         </div>   


      </div>
      <!-- end col -->
   
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
@endsection