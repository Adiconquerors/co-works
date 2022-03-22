@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
 <!-- Bx slider css -->
<link href="{{ PUBLIC_PLUGINS_NEW_ADMIN }}bx-slider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
@endsection

@section( 'new_content' )
 <style>
      
      #sty-mr8{
        margin-right: 8px;
      }
      .sty-tc{
        text-align: center;
      }
      .sty-fs16{
        font-size: 16px;
      }
      .styy_ohto{
        overflow:hidden;
        text-overflow:ellipsis;white-space:nowrap;
      }
  </style>

      <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">@lang('custom.listings.fields.property-detail')</h4>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

@if($record)
    @php
        $images            = json_decode($record->image,false);
        $description       = $record->description;
        $property_address  = $record->property_address;
        $records[] = $record;

    @endphp

    @else

         @php

           $description      = null;
           $property_address  = null;

        @endphp

     @endif


    <div class="property-detail-wrapper">
        <div class="row">
            <div class="col-lg-8">
            @if($images)
                <div class="">
                    <ul class="bxslider property-slider">
                          @if (is_array($images) || is_object($images))
                        @foreach ($images as $image)
                            <?php
                                $image_path = PREFIX1 . 'thumb/' . $image;
                                $water_mark = getSetting('carousel_head_two','login-settings');
                            ?>

                        <li><img src="{{ url( $image_path ) }}" alt="slide-image" />  <div class="watermark">{{ $water_mark }} </div> </li>
                        @endforeach
                        @endif

                    </ul>

                    <div id="bx-pager" class="text-center hide-phone">
                        @if (is_array($images) || is_object($images))
                        @foreach ($images as $image)
                            <?php
                              $image_path = PREFIX1 . 'thumb/' . $image;
                            ?>
                        <a data-slide-index="{{$loop->index}}" href="javascript:void(0);"><img src="{{ url( $image_path ) }}" alt="slide-image" height="70" /></a>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
                <!-- end slider -->

                <div class="m-t-30">
                    <h3>{{$record->company}}</h3>
                    <p class="text-muted text-overflow"><i class="mdi mdi-map-marker-radius m-r-5"></i>{{ $record->property_address }}</p>

                    <p class="m-t-20">
                        {{$record->description}}
                    </p>

                      <h5>@lang('custom.listings.fields.property-manager-details')</h5>
                    <p class="text-muted text-overflow">
                      <span><b>@lang('custom.listings.fields.property-manager-name')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>  </span>&nbsp;&nbsp;  {{ $record->property_manager_name }}<br/>
                      <span><b>@lang('custom.listings.fields.property-manager-email')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b></span>&nbsp;&nbsp; {{ $record->property_manager_email }}<br/>
                      <span><b>@lang('custom.listings.fields.property-manager-phone')&nbsp;&nbsp;:</b> </span> &nbsp;&nbsp;{{ $record->property_manager_number }}
                    </p>


                 <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                             <h4 class="">@lang('custom.listings.fields.general-amenities')</h4>

                            <ul class="list-unstyled proprerty-features">
                            @if(count( $record->property_amenities ) > 0)
                                @foreach ($record->property_amenities as $property_amenity)
                                <li>
                                 
                                    <i class="{{ $property_amenity->icon->name }}" id="sty-mr8"></i>
                                  {{ $property_amenity->name }}
                                </li>
                                @endforeach
                             @else
                                <h5 class="sty-tc">@lang('custom.listings.fields.no-amenities-avaliable')</h5>
                             @endif
                            </ul>
                        </div> <!--- end col -->

                            <div class="col-sm-6">
                             <h4 class="">@lang('custom.listings.fields.property-timings')</h4>

                                <table width=100%>
                                        <thead>
                                        <tr class="sty-fs16">
                                            <th>@lang('custom.listings.fields.days')</th>
                                            <th>@lang('custom.listings.fields.from')</th>
                                            <th>@lang('custom.listings.fields.to')</th>
                                          
                                        </tr>
                                        </thead>

                                <tbody>         
                                @foreach ($record->property_timings as $property_timing)
                                   <?php
                                        $days = \App\Day::find($property_timing->day_id);
                                   ?> 
                                <tr>
                                  <td>{{ $days ? $days->name : '' }}</td>
                                  <td>{{ $property_timing->time_from ?? ''  }}</td>
                                  <td>{{ $property_timing->time_to ?? ''  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                         </table>   
                           
                        </div> <!--- end col -->


                    </div> <!-- end row -->
                </div>

                    <h4 class="m-t-30 m-b-20">@lang('custom.listings.fields.location')</h4>

                    <div class="card-box">
                        <div id="map-property"></div>
                    </div>

                </div> <!-- end m-t-30 -->

            </div> <!-- end col -->

            <div class="col-lg-4">
                @if( isAgent() || isAdmin())

                <?php
                        $agents = \App\User::find($record->agent_id);
                        if( ! empty($agents) ){
                          $agent_image = $agents->image;
                        }

                    ?> 
                  @if(! empty($agents))    
                <div class="text-center card-box">
                  
                    <div class="text-left">
                        <h4 class="header-title m-t-0 m-b-20">@lang('custom.listings.fields.agent')</h4>
                    </div>
                    <div class="member-card">
                    
                        <div class="thumb-xl member-thumb m-b-10 mx-auto d-block">
                            
                               <img src="{{ getDefaultimgagepath($agent_image,'users')  }}" class="rounded-circle img-thumbnail" alt="profile-image">
                          
                        </div>

                        <div class="" >
                            <h4 class="m-b-5">{{ $agents ? $agents->name : '-' }}</h4>
                            <br/>
                            <p>
                               <span>  @lang('custom.listings.fields.mobile') :</span>
                               <span> {{ $agents ? $agents->mobile : '-' }} </span>
                            </p>
                            <p>
                               <span>   @lang('custom.listings.fields.email') :</span>
                               <span> {{ $agents ? $agents->email : '-' }} </span>
                            </p>
                        </div>

                        <div class="m-t-20">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                <?php
                                $agent_properties = \App\Property::where('agent_id',$record->agent_id)->count();
                                ?>

                                    <h4>{{ $agent_properties }}</h4>
                                    <p>@lang('custom.listings.fields.listed-properties')</p>
                                </li>

                             
                            </ul>
                        </div>
                      
                    </div> <!-- end membar card -->
                </div> <!-- end card-box -->
                   @endif
                @endif

                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-bordered m-b-0">
                            <tbody>

                              <?php
                                 $property_sub_space_types = $record->property_sub_space_types;
                                  $count = 1;
                              ?>

                                <tr>
                                    <th scope="row">@lang('custom.listings.fields.price-per-month')</th>
                                    <td>
                                    @foreach($property_sub_space_types as $property_sub_space_type)

                                    <?php
                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                      $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                                    ?>    
                                    <b>

                                    <span class="badge badge-pill badge-dark"> {{ $count++ }} </span>
                                    <br/>  

                                    @if($space_types)    
                                      @if( $space_types->name == "Virtual Offices" )
                                        <?php
                                         $vo_price_per_month = '-'
                                        ?>
                                         Price Per Month {{ $space_types->name }} : {{$vo_price_per_month}}
                                      @else 

                                       Avaliable Seats For {{ $sub_space_types->name }} : {{ $property_sub_space_type->avaliable_seats ?? ''}}

                                      <br/><br/>
                                      Price Per Month {{ $space_types->name }} ( {{ $sub_space_types->name }} ) : {{ $property_sub_space_type->price_per_month ? $property_sub_space_type->price_per_month.' / month' : ''}}
                                     
                                      <br/>
                                      @endif
                                    @endif
                                 
                                    </b>
                                    <br/>
                                   @endforeach
                                	</td>
                                </tr>

                                 @if($space_types)    
                                  @if( $space_types->name == "Virtual Offices" )
                                <tr>
                                    <th scope="row">@lang('custom.listings.fields.vo-with-bussiness-reg-no')</th>
                                    <td>{{ $space_types ? $property_sub_space_type->vo_reg_no : '-' }}</td>
                                </tr>

                                 <tr>
                                    <th scope="row">@lang('custom.listings.fields.vo-with-mailing-address')</th>
                                    <td>{{ $space_types ? $property_sub_space_type->vo_mailing_address : '-' }}</td>
                                </tr>

                               @endif
                               @endif 

                                <?php
                                  $count = 1;
                                ?>


                                 <tr>
                                    <th scope="row">@lang('custom.listings.fields.price-per-day')</th>
                                    <td>
                                    @foreach($property_sub_space_types as $property_sub_space_type)

                                     <?php 
                                      $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                      $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);
                                    ?>    
                                      
                                     <span class="badge badge-pill badge-dark"> {{ $count++ }} </span>
                                     <br/>    

                                    @if($space_types)    
                                      @if( $space_types->name == "Virtual Offices" )
                                        <?php
                                         $vo_price_per_day = '-'
                                        ?>
                                        Price Per Day {{ $space_types->name }} : {{$vo_price_per_day}}
                                       @else    
                                        <b> 
                                          Price Per Day {{ $space_types->name }} ( {{ $sub_space_types->name }} ) : {{ $property_sub_space_type->price_per_day ? $property_sub_space_type->price_per_day.' /Day' : ''}}
                                          <br/>
                                        </b>
                                        <br/>
                                       @endif 
                                      @endif 
                                @endforeach
                                    </td>
                                </tr>

                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.is-approved') }}</th>
                                    <td>{{ $record->is_approved }}</td>
                                </tr>

                                

                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.contact-person-name') }} </th>
                                    <td><span class="label label-danger">{{ $record->cotact_person_name }}</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.phone-number') }}:</th>
                                    <td>{{ $record->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.email') }}:</th>
                                    <td>{{ $record->email }}</td>
                                </tr>
                                <tr>
                                   
                                    <th scope="row">{{ trans('custom.listings.fields.near-by-land-marks') }}:</th>
                                    
                                    <td>{{ $record->near_by_landmark }}</td>
                                </tr>

                                @if( isAdmin() )
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.no-of-workstation') }}:</th>
                                    <td>{{ $record->no_of_workstation }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.no-of-private-office') }}</th>
                                    <td>{{ $record->no_of_private_office }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.no-of-meeting-rooms') }}</th>
                                    <td>{{ $record->no_of_meeting_office }}</td>
                                </tr>
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.no-of-training-rooms') }}</th>
                                    <td>{{ $record->no_of_training_office }}</td>
                                </tr>
                                
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.pan-no') }}</th>
                                    <td>{{ $record->pan_no }}</td>
                                </tr>
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.billing-address') }}</th>
                                    <td>{{ $record->billing_address }}</td>
                                </tr>
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.registered-address') }}</th>
                                    <td>{{ $record->registered_address }}</td>
                                </tr>
                                  <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.bank-name') }}</th>
                                    <td>{{ $record->bank_name }}</td>
                                </tr>
                                  <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.account-holder-name') }}</th>
                                    <td>{{ $record->account_holder_name }}</td>
                                </tr>
                                  <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.account-number') }}</th>
                                    <td>{{ $record->account_number }}</td>
                                </tr>
                                  <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.ifsc-code') }}</th>
                                    <td>{{ $record->ifsc_code }}</td>
                                </tr>
                                 <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.cin-no') }}</th>
                                    <td>{{ $record->cin_no }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ trans('custom.listings.fields.gst') }}</th>
                                    <td>{{ $record->gst }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-box -->

            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- end property-detail-wrapper -->
       @stop

       @section( 'new_admin_js_scripts' )

       <?php
         $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );
       ?>

              <!-- Bx slider js -->
        <script src="{{ PUBLIC_PLUGINS_NEW_ADMIN }}bx-slider/jquery.bxslider.min.js"></script>

        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$google_api_key}}"></script>
        <script src="{{ PUBLIC_PLUGINS_NEW_ADMIN }}gmaps/gmaps.js"></script>

        <script>
            $(document).ready(function () {
              "use strict";
                $('.property-slider').bxSlider({
                    pagerCustom: '#bx-pager'
                });
            });
            var map = new GMaps({
                el: '#map-property',
                lat: '{{$record->property_address_latitude}}',
                lng: '{{$record->property_address_longitude}}',
                mapTypeControlOptions: {
                    mapTypeIds : ["hybrid", "roadmap", "satellite", "terrain", "osm"]
                }
            });
            var marker = map.addMarker({
                lat: '{{$record->property_address_latitude}}',
                lng: '{{$record->property_address_longitude}}',
                title: 'Im your custom marker',
                
                animation: google.maps.Animation.DROP
            });

            var infoboxContent = '<div class="infoW">' +
                            '<div class="propImg">' +
                                
                                '</div>' +
                            '</div>' +
                            '<div class="paWrapper">' +

                                '<div class="propTitle">{{$record->company}}</div>' +

                        '<div class="propAddress styy_ohto" title="{{$record->property_address}}">{{$record->property_address}}</div>' +
                            '</div>'  +
                '<div class="clearfix"></div>' +
                '<div class="infoButtons">' +
                    '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Close</a></div>' +
             '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: infoboxContent,
                disableAutoPan: false,
                maxWidth: 202,
                
                zIndex: null,
                boxStyle: {
                    background: "url({{PREFIX}}'images/infobox-bg.png') no-repeat",
                    opacity: 1,
                    width: "202px",
                    height: "245px"
                },
                closeBoxMargin: "28px 26px 0px 0px",
                closeBoxURL: "",
                infoBoxClearance: new google.maps.Size(1, 1),
                pane: "floatPane",
                enableEventPropagation: false
            });
            

            marker.addListener('click', function() {
                infowindow.setContent(infoboxContent);
                infowindow.open(map, marker);
              });
        </script>
        @endsection