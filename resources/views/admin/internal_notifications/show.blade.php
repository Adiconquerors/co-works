@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"> @lang('custom.eforms.ndetails') </h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href=""></a>
            </li>
            <li class="breadcrumb-item">
               
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
                  <h5> @lang('custom.eforms.text')</h5>
               </div>
               <div>
                  <p>{{ $record->text ?? ''}}</p>
               </div>

               
               <div class="post-title">
                  <h5> @lang('custom.eforms.link')</h5>
               </div>
               <div class="post-title">
                  <a href="{{$record->link}}" target="_blank">{{ $record->link }}</a>
               </div>

               <div class="post-title">
                  <h5> @lang('custom.eforms.users')</h5>
               </div>
               <div>
                  <p>
                     @foreach ($record->users as $singleUsers)
                     {{ $singleUsers->name }}
                     @endforeach
                  </p>
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