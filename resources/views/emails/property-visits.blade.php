<html>
    <head>
        <style>
            
body{background: #f5f5f5;font-family: 'Roboto', sans-serif;    }
.productlis{  padding: 20px;width: 100%; max-width: 800px; background: #fff; margin: 0 auto; display: block;}
.productlis h2{ padding: 0px 0 20px; margin: 0; color: #40c8f4;}
.productlis ul{margin: 0; padding: 0; display: grid; grid-template-columns: auto auto; grid-gap: 10px;}
.productlis ul li{list-style: none;    border: 1px solid #ccc;
    padding: 15px;}
.imgea img{width: 100%;}
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
.allview a{color: #fff;}
.productlis table{ width: 100%; text-align: left;  border-spacing: 0;
    border-collapse: separate;}
.productlis table tr td img{ width: 125px;}
.productlis table tr th{padding: 12px 10px; font-size: 14px;}
.productlis table tr td{border: 1px solid #ccc; padding: 12px;} 
.productlis table thead{background: #f5f5f5;}
.productlis table tr td p{font-weight: bold;}
a.btn {
    padding: 5px 12px;
    display: table;
    margin: auto;
    font-size: 13px;
    background: red;
    border-radius: 9px;
    color: #fff;
    margin-bottom: 7px;
}
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
      $properties_visits = \App\Property::where( 'schedule_visit' , 'no' )->get();
    ?>
    <div class="productlis">
        <h2>@lang('custom.propertyvisits.vd')
           <span class="flo-right"><span class="color-sp">@lang('custom.propertyvisits.date') {{ $mail['date'] }}</span>  
        </h2>

<table bor>
    <thead>
        <tr>
            <th> @lang('custom.propertyvisits.cover-image')</th>
            <th>@lang('custom.propertyvisits.office-address')</th>
            <th>@lang('custom.propertyvisits.visit-details')</th>
            <th> @lang('custom.propertyvisits.property-manager-details')</th>
        </tr>
    </thead>
    <tbody>
      @foreach( $properties_visits as $visit )
              @php
                $property_sub_space_types = $visit->property_sub_space_types;
                $property_amenities = $visit->property_amenities;
                $property_timings = $visit->property_timings;
                $cover_image = $visit->cover_image;
                $agents = \App\User::find($visit->agent_id);
              @endphp
        <tr>
            <td> <img src="{{ $cover_image }}"> </td>

            <td> 
                {{ $visit->company ?? '' }}
                <p>@lang('custom.propertyvisits.near-by-landmark') {{ $visit->property_address ?? '' }}</p>
            </td>
            <td> 
                    {{ $mail['visit_date'] ?? ''}}<br/> 
                    {{ $mail['visit_time'] ?? '' }}  
            </td>
            <td> {{ $visit->property_manager_name ?? '' }}<br/> 
                {{$visit->property_manager_number ?? ''}}<br/>  
                {{$visit->property_manager_email ?? ''}}  

            </td>
        </tr>
       @endforeach 
     
    </tbody>
    
</table>



<h4>@lang('custom.propertyvisits.comments')</h4>

<p>
    {{ $mail['mail_description'] ?? ''}}
</p>

<hr>
<p>
   <b class="uline">@lang('custom.propertyvisits.contact-details')</b><br/>
   <b>@lang('custom.propertyvisits.site-address') </b>{{ $mail['site_address'] }}<br/>
   <b>@lang('custom.propertyvisits.siteccsp')</b>{{ $mail['country_code'] }}  {{ $mail['site_phone'] }}<br/>
   <b>@lang('custom.propertyvisits.sited') </b>{{ $mail['site_email'] }}<br/>
   <a href="{{ $mail['site_url'] ?? '' }}">@lang('custom.propertyvisits.url')</a>
</p>

 </div>

</body>
</html>