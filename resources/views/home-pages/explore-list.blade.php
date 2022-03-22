<style>
   .d-img{
   max-width: 100%;
   height:270px;
   }
   .btn-bookspace {
    margin-top: 34px!important;
   }
   span.fa.fa-check-circle {
    padding-right: 5px!important;
   }
   a.card, div.card {
    display: block;
    background-color: #fff;
    /* box-shadow: 0 1px 2px 0 rgb(0 0 0 / 13%); */
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0%);
    margin-bottom: 20px;
    cursor: pointer;
    text-decoration: none;
    max-height: 389px!important;
}
</style>
<!-- Properties -->
<div class="row">
@foreach( $records as $rec )
<?php
$property = $rec;
$property_sub_space_types = $rec->property_sub_space_types;
$property_amenities = $rec->property_amenities;
$cover_image = $property->cover_image;
$price_html = '';
$price_per_day = 'NA';
if ( ! empty( $property_sub_space_types ) ) {
   $space_type_id = '';
   foreach( $property_sub_space_types as $details ) {
      if ( $space_type_id != $details->space_type_id ) {
         $price_html .= '<p>';
         $price_html .= ' <span>Price per day</span> <span>Price per month</span>';
      }
      $sub_types = \App\SpaceType::getSpaceTypes( $details->space_type_id );
      foreach( $sub_types as $sub_type ) {
         if ( $sub_type->id == $details->sub_space_type_id ) {
            $price_html .= '<p><span >'.$sub_type->name.'</span> <span>'.''.$details->price_per_day.'</span> <span>'.''.$details->price_per_month.'</span></p>';
         } else {

         }
      }
      if ( 'NA' === $price_per_day && ! empty( $details->price_per_day ) ) {
         $price_per_day = $details->price_per_day;
         break; // Let us take first value as default.
      }
      $space_type_id = $details->space_type_id;
      if ( $space_type_id != $details->space_type_id ) {
         $price_html .= '</p>';
      }
   }
}


$price_per_month = 'NA';
if ( ! empty( $property_sub_space_types ) ) {
   foreach( $property_sub_space_types as $details ) {
      if ( 'NA' === $price_per_month && ! empty( $details->price_per_month ) ) {
         $price_per_month = $details->price_per_month;
         break; // Let us take first value as default.
      }
   }
}


?>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 

   <?php
   if( $rec->area )
      $area =  $rec->area.'sq ft';
   else
      $area = '-';
  ?>
  
  
   <div class="selectProduct" data-title="{{$rec->id}}"  data-id="{{$rec->name}}" data-slug="{{$rec->slug}}"  data-weight="{{$rec->property_address}}" 
      data-processor="{{$property_amenities}}"  data-price_html="{{$price_html}}">
          
      <div class="figType-heart">
         <a class="w3-btn-floating w3-light-grey addButtonCircular addToCompare" title="Compare">+</a>
         @if( $cover_image )
         <img src="{{ url( $cover_image ) }}" alt="image" class="imgFill productImg img-hidden" >   
         @endif
      </div>
   </div>

   <a href="{{ route('properties.edit',[$property->slug,$property->id]) }}" class="card">
  

  @if( $cover_image )
      <div class="figure imgwih">
    
         <img src="{{ url( $cover_image ) }}" alt="Cover image" >
      @else
         <img src="{{ url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg') }}" alt="default image"  class="d-img">
      @endif
      </div>
        
      <h2>{{ $property->company }}</h2>

      <div class="cardAddress" title="{{ $property->property_address }}"><span class="icon-pointer"></span> 
         {{ $property->property_address }}</div>
         




      @if( 'yes' === $rec->is_approved )
      <ul class="cardFeat">
         <li><span class="fa fa-check-circle" ></span>@lang('custom.profile.verified')</li>
      </ul>
      @endif 

      <ul class="cardFeat-right">
         <li><button class="btn btn-bookspace" type="submit">
            <span class="booking">@lang('custom.profile.book')</span><br><b>@lang('custom.profile.space')</b>
            </button>
         </li>
      </ul>
      <div class="clearfix"></div>
   </a>
</div>

@endforeach
</div>

@include('home-pages.property-compare')

<!-- End properties -->
@if( ! empty( $records ) && $records->total() > PROPERTIES_PER_PAGE )
<ul class="pagination ">
   {{ $records->links() }}
</ul>
@endif
@include('home-pages.common.app')


<script>
 function openLogin() {
      $('#redirect_url').val('{{route("properties.create" )}}')
      $('#login-modal').modal('toggle');
}
</script>

