<style>
  #styid-fr{
    float:right;
  }.sty-h50{
    height:50%;
  }
</style>
<div class="feedback_form_area_inner">
<h3>
@lang('custom.eforms.myshortlist') 
<span id="property-heart-count">
    <?php
       $shortlists_count = $properties_shortlists->count();
    ?>

( {{ $shortlists_count }} )

@if( $shortlists_count > 0 )
  <a href="#ShortlistModal" data-toggle="modal" data-remote="false" class="" data-action="" >    
    <i class="fa fa-share-alt" id="styid-fr"></i>
 </a>  
@endif
 
</span>
</h3>

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#send-proposal" role="tab">
@lang('custom.eforms.share')
</a>
</li>

</ul>
<div class="tab-content">
<div class="tab-pane fade in show active" id="send-proposal" role="tabpanel">


@foreach( $properties_shortlists as $property_shortlist )
    @php
     $cover_image = $property_shortlist->cover_image; 
     $property_sub_space_types = $property_shortlist->property_sub_space_types;   
    @endphp 
<div class="card-body-shortlist">
<!-- property card -->
<div class="property-card property-horizontal bg-white">
<div class="row">
<div class="col-sm-4">
  @if($cover_image)
    <div class="property-image shortlist-card" style="background: url('{{ url( $cover_image ) }}') center center / cover no-repeat;">
    </div>
   @else
    <div class="property-image shortlist-card" style="background: url('{{ url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' ) }}') center center / cover no-repeat;">
    </div>
   @endif 
</div>
<!-- /col 4 -->
<div class="col-sm-8">
    <div class="property-content-card">
        <span class="pull-right clickable close-icon1"  data-effect="fadeOut">
            <i class="fa fa-times" id="heart-close_{{$property_shortlist->id}}">
            </i>
        </span>
        <div class="listingInfo">
            <div class="card-wid">
                <h5>
                    <a href="javascript:void(0);" class="text-dark property-lab property-main-lab">

                       <input type="hidden" name="prop_id" id="prop_id" class="list-item" data-id="{{ $property_shortlist->id }}"> 

                       <span class="list-item" data-id="{{ $property_shortlist->company }}"> {{ $property_shortlist->company }} </span>
                    </a>
                </h5>
                <h6>
                  @foreach( $property_sub_space_types as  $property_sub_space_type)

                    <?php
                       $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                       if( $space_types ){
                        $property_space_type_name = $space_types->name;
                        }else{
                          $property_space_type_name = '-';
                        }
                    ?>

                    <span> {{ $space_types ? $space_types->name : '-' }} </span>
                   @endforeach  
                </h6>
                <div class="clearfix"></div>
                <div class="card-property-d">
                     

                    <h6>
                        <span id="property-heart-price-month"></span>
                       @foreach($property_sub_space_types as $property_sub_space_type)
                            <?php   
                                $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);

                            ?>      
                       {{ $space_types ? $space_types->name : '' }} ( {{ $sub_space_types ? $sub_space_types->name : ''}} ) : {{ $property_sub_space_type->price_per_month  }} @lang('custom.listings.fields.per-month')
                         @endforeach           

                    </h6>
                    <a href="{{ route('properties.show', $property_shortlist->slug) }}" target="_blank" class="btn-danger card-property-btn sty-h50" alt="view-property">
                        @lang('custom.eforms.view-details')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
</div>
<!-- End property card -->
</div>

@endforeach

</div>
<!-- END Tab1 -->
</div>
</div>