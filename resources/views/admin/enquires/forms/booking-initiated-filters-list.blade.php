
              @foreach( $booking_properties as $property)
                @php
                  $cover_image = $property->cover_image;
                  $property_sub_space_types = $property->property_sub_space_types;
                  $property_amenities = $property->property_amenities;
              @endphp

            <style>
              .sty-mb{
                margin-bottom: 20px;
              }
              #fawhatsappicon{
                color: green; font-size: 20px;
              }
              .styp5{
                padding:5px;
              }
            </style>
                      <div class="property-card property-horizontal bg-white">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="property-image" style="background: url('{{$cover_image}}') center center / cover no-repeat;">
                                         
                                    </div>
                                </div>

                                <input type="hidden" name="booking_property_name"  value="{{ $property->name }}">
                                <!-- /col 4 -->
                                <div class="col-sm-4">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                                <h4>
                                                    <a href="#" class="text-dark property-lab">
                                                        {{$property->company}}
                                                    </a>
                                                </h4>
                                                <p class="font-13 text-muted">
                                                    {{$property->property_address}}
                                                </p>
                                            </div>
                                        </div>


                               <h4 class="text-success price-tag sty-mb">
                       @foreach($property_sub_space_types as $property_type)
                         <?php 
                            $spacetypes = \App\SpaceType::find($property_type->space_type_id);
                            
                            $subspacetypes = \App\SpaceType::find($property_type->sub_space_type_id);
                            
                          ?> 
                            @if($spacetypes)
                             @if( $spacetypes->name == "Virtual Offices" )
                                        <?php
                                         $vo_price_per_month = ''
                                        ?>
                                        {{$vo_price_per_month}}
                              @else
                                 @lang('custom.inquiries.avalible-for') {{ $subspacetypes->name ?? '' }} : {{ $property_type->avaliable_seats ?? ''}}
                                 <br/>
                                 @lang('custom.inquiries.avalible-month'){{ $spacetypes->name ?? '' }} ( {{ $subspacetypes->name ?? '' }} ) : {{ $property_type->price_per_month.' / month' ?? ''}}<br/>

                              @endif
                              @endif     
                       @endforeach
                                </h4>
                                    </div>
                                   
                                </div>
                                <!-- /col 8 -->
                                <!-- /col 4 -->
                                <div class="col-sm-3">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                                <div>
                                                    
                                                    <p href="javascript:void(0);" class="btn-property badge btn-dark-property">
                                                    @foreach( $property_sub_space_types as $property_sub_space_type)
                                                      <?php
                                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                                      if( $space_types ){
                                                      $property_space_type_name = $space_types->name;
                                                      }else{
                                                      $property_space_type_name = '-';
                                                      }
                                                      ?>

                                                      {{ $space_types ? $space_types->name : '-' }}
                                                    @endforeach

                                                            </p>
                                                </div>
                                            
                                                <div class="detilphon">
                                                    <p >
                                                        <i class="fab fa-whatsapp" id="fawhatsappicon">
                                                        </i>
                                                        <span>
                                                   
                                                            <b>
                                                                {{ $property->phone_number }}
                                                            </b>
                                                        </span>
                                                    </p> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- /col 4 -->
                                <div class="col-sm-2">
                                    <div class="property-content">
                                    
                                      <a href="javascript:void(0);" id="booking_property_select_{{ $property->id }}" class="btn btn-medium-dark styp5" >
                                          @lang('custom.inquiries.select-property')
                                      </a>
                                        
                                    </div>
                                </div>
                                <!-- /col 8 -->
                            </div>
                            <!-- /inner row -->
                        </div>
                        <!-- End property item -->
                        @endforeach