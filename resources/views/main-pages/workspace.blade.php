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
   .sty-cp{
    cursor:pointer;
   }
 </style>
 @endsection

@section( 'content' )
<main class="main">

<?php
  $home_hero_bgimage = getSetting('home_hero_bgimage','our-workspaces-settings');
  $home_hero_bgimagecontainer = getSetting('home_hero_bgimagecontainer','our-workspaces-settings');
?>

<div class="home-hero__wrap home--height" style="background-image: url({{IMAGE_PATH_SETTINGS.$home_hero_bgimage}}); height:20em;">
         <div class="home-hero__overlay"></div>
         <div class="container">
            <div class="row">
            <div class="col-md-12 col-sm-12">
                  <h1 class="home-hero__title">@lang('custom.postrequirement.workspaces')</h2>
               </div>
            </div>
         </div>
      </div>
 
 
   <div class="workspce home-section__white" style="background-image: url({{IMAGE_PATH_SETTINGS.$home_hero_bgimagecontainer}});background-repeat: no-repeat;">
      <div class="container">
         <div class="row">
            @php
              $items = \App\SpaceType::getSpaceTypes(0);
            @endphp
            
          @foreach( $items as $item )        
            @php
             $sub_space_types = \App\SpaceType::getSpaceTypes($item->id);
           @endphp
           @foreach( $sub_space_types as $sub_space_type )
              @php
                $image = $sub_space_type->image;
               
             @endphp  

                     <div class="col-md-3 col-xs-12">
                        <div class="home-section__work-wrap">
                  <?php
                     $space_sub_loc = "location=&wstype=".$item->id."&subtype=".$sub_space_type->id;
                     $space_types_im = getDefaultimgagepath($image,'space-types');
                  ?>
                      
                           <img src="{{ $space_types_im }}" alt="icon">
                       
                           <h3 class="sty-cp"><a href="{{ route('properties.list',$space_sub_loc) }}">{{ $sub_space_type->name }}</a></h3>
                           <p>{{ $sub_space_type->des_one ?? ''}}</p>
                        </div>
                     </div>
         @endforeach
         @endforeach
                
 
   </div>
 
</main>

<!-- footer -->
@include ( 'partials.footer' )
<!-- end footer -->
      
@stop