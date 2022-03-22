@include('partials.newadmin.common.add-edit.formfields-headlinks')

<div class="modal-header">
  <h4 class="modal-title">@lang('custom.inquiries.properties-shared')</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
 
            <form class="" role="form" id="properties_shared_form" method="post">
              <div class="shrelist">
                  <?php
                    $shortlisted_data = json_decode($item->shortlisted_properties, true);
                    $count = 1;
                  ?>

                 @if (is_array($shortlisted_data) || is_object($shortlisted_data))
                  @foreach( $shortlisted_data as $shortlist)
                    <?php
                      $property_sub_space_types = $shortlist["property_sub_space_types"];
                    ?>
                       
                    <div class="listydei">
                    <div class="cobting">

                       
                       @if( $shortlist['cover_image'] && file_exists(public_path("/thumb/coverimages/". $shortlist['cover_image'])))
                          <img src="{{$shortlist['cover_image']}}" height="100" width="100">
                       @else
                         <img src="{{url(PUBLIC_ASSETS . 'images/default-imgs/1.jpg')}}" height="100" width="100">
                       @endif
                    
                      
                       
                    <h2>   {{$shortlist["name"]}}</h2> 
                    <h4>    {{$shortlist["company"]}}</h4> 
                    <h6>    {{$shortlist["property_address"]}}</h6> 

          </div>
                     @foreach($property_sub_space_types as $property_sub_space_type)

                      <?php 
                        $space_types = \App\SpaceType::find($property_sub_space_type["space_type_id"]);
                        $sub_space_types = \App\SpaceType::find($property_sub_space_type["sub_space_type_id"]);
                       
                      ?>    

                          <div class="tbgrid">
                       
                      
                          @if($space_types)    
                                      @if( $space_types["name"] == "Virtual Offices" )
                                        <?php
                                         $vo_price_per_month = ''
                                        ?>
                                        {{$vo_price_per_month}}
                                      @else 
                                    <p>
                                        @lang('custom.eforms.ava-seats-for') {{ $sub_space_types["name"] }} : <span> {{ $property_sub_space_type["avaliable_seats"] ?? ''}}</span> 
                                  </p>
                                   <p>  
                                    @lang('custom.eforms.price-per-m')  {{ $space_types["name"] }} ( {{ $sub_space_types["name"] }} ) : <span> {{ $property_sub_space_type["price_per_month"] ? $property_sub_space_type["price_per_month"].' / month' : '' }}</span> 
                                     
                                     </p> @endif
                                    @endif
                                    </div>
                     @endforeach
                     </div>
 
                 
                  @endforeach
                 @endif 
               
              </div>

              <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$item->id}}">
              <input type="hidden" id="customer_id" name="customer_id" value="{{$item->customer_id}}">
              <input type="hidden" id="action" name="action" value="{{$action}}">
              <input type="hidden" id="sub" name="sub" value="{{$sub}}">

            </form>

  </div>

  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')