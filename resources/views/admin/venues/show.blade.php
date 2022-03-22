@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> Venue Details </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('venues.index') }}">{{ ucwords( $active_class ) }}</a>
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
                  <h5>Name</h5>
               </div>
               <div>
                  <p>{{ $record->name ?? '-' }}</p>
               </div>

               <div class="post-title">
                  <h5>Description</h5>
               </div>
               <div>
                  <p>{{ $record->description ?? '-' }}</p>
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