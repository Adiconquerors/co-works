<html lang="en">
    <head>

     <style>
        
        body{background: #f5f5f5;    }
            .productlis{  padding: 20px;width: 100%; max-width: 800px; background: #fff; margin: 0 auto; display: block;}
            .productlis h2{ padding: 0px 0 20px; margin: 0; color: #40c8f4;}
            .productlis ul{margin: 0; padding: 0; display: grid; grid-template-columns: auto auto; grid-gap: 10px;}
            .productlis ul li{list-style: none;    border: 1px solid #ccc;
                padding: 15px;}
            .imgea img
            {
              width: 100%;
            }
            .productlis ul li h5{margin: 0;    font-weight: lighter;
                font-size: 18px;}
                .productlis ul li h3 { color:  #cc3333;}
               
                .icons {
                display: flex;
                justify-content: space-between;
                text-align: center;
            }
            .icons span {
                width: 50px;
                height: 50px;    align-items: center;
                border-radius: 100px;
                border: 1px solid #ccc;
                margin: 15px 0 0;
            }
            .icons img {
                width: 35px;
                margin: 8px 0;
            }
            .mte{font-style: italic;   font-weight: bold;}
            .ViewD {
                display: flex;
                justify-content: space-around;
            }
            .ViewD a {
                margin: 15px;
                padding: 10px;
                border: 1px solid #ccc;
                width: 100%;
                text-align: center;
                border-radius: 10px; color: #cc3333; font-weight: bold; text-decoration: none;
            }
            .ViewD a:hover{ background: #cc3333; color: #fff;}
            .allview {
                margin: 20px auto;
                width: 150px;
                text-align: center;
                padding: 18px;
                border-radius: 10px;
                background: #40c8f4;
            }
            .badge {
              white-space: normal;
              text-align: left;
              padding: 8px;
              border-radius: 5px;
            }
            .allview a{color: #fff;}

            .uline{
                text-decoration: underline;
            }
            .flo-right{
                float:right;
            }
            .color-sp{
                color:black;
            }

        </style>
        
    </head>
<body>

    <?php
       $properties_shortlists = \App\Property::where( 'heart_color' , 'red' )->get();
    ?>

    <div class="productlis">
  
<h2> Hi {{ ucwords( $mail['toname'] ) }} @lang('custom.propertyvisits.find')
   <span class="flo-right"><span class="color-sp">Date : {{ $mail['date'] }}</span> 
</h2>

        <ul>
           @foreach( $properties_shortlists as $shortlist )
              @php
                $property_sub_space_types = $shortlist->property_sub_space_types;
                $property_amenities = $shortlist->property_amenities;
                $property_timings = $shortlist->property_timings;
                $cover_image = $shortlist->cover_image ?? '';
                $agents = \App\User::find($shortlist->agent_id);
              @endphp 
            <li>
               <div class="imgea"> 
                <img src="{{$cover_image}}" alt="image">
              </div>

            <p class="badge badge-pill badge-secondary">  @foreach( $property_sub_space_types as $property_sub_space_type)
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
        <p class="mte">*{{ $mail['no_of_seats'] ?? '' }} {{$mail['mail_description'] ?? ''}}  @lang('custom.propertyvisits.in') {{$shortlist->property_address ?? ''}}</p>
        
        <p> @lang('custom.propertyvisits.near-by-landmark')<br/> 
           {{ $shortlist->near_by_landmark ?? ''  }}
        </p>
               
<div class="icons">
   @foreach ($shortlist->property_amenities as $property_amenity)
    <span class="{{ $property_amenity->icon->name }}"> </span>
   @endforeach
 
</div>
<p> @lang('custom.propertyvisits.amount-day-month') <br/>
  @foreach($property_sub_space_types as $property_sub_space_type)
                            <?php   
                                $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);

                            ?>      
                       {{ $space_types ? $space_types->name : '' }} ( {{ $sub_space_types ? $sub_space_types->name : ''}} ) :<br/>

                        {{ $property_sub_space_type->price_per_day  }} @lang('custom.propertyvisits.day')
                        <br/>
                        {{ $property_sub_space_type->price_per_month  }} @lang('custom.propertyvisits.month')
                        <br/>
                    @endforeach   </p>


<div class="ViewD"><a href="{{ route('properties.show', $shortlist->slug) }}"> @lang('custom.propertyvisits.viewdetails') </a> 
  
</div>
 

            </li>
           @endforeach  
        </ul>


<h4>@lang('custom.propertyvisits.message')</h4>

<p>
  {{ $mail['mail_description'] ?? ''}}
</p>


<hr>
<p>
   <b class="uline">@lang('custom.propertyvisits.contact-details')</b><br/>
   <b>@lang('custom.propertyvisits.site-address') </b>{{ $mail['site_address'] }}<br/>
   <b>@lang('custom.propertyvisits.siteccsp') </b>{{ $mail['country_code'] }}  {{ $mail['site_phone'] }}<br/>
   <b>@lang('custom.propertyvisits.sited') </b>{{ $mail['site_email'] }}<br/>
   <a href="{{ $mail['site_url'] ?? '' }}">@lang('custom.propertyvisits.url')</a>
</p>

    </div>

</body>
</html>