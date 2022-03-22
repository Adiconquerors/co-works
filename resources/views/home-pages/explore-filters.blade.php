@inject('request', 'Illuminate\Http\Request')

<style>
  .sty_ddn{
    display: none;
  }
</style>
<div class="filter filterto">

<div class="clearfix"></div>
<div class="container">
<div class="row">
 <div class="col-xs-12 col-lg-12">
 <h1 class="osLight">@lang('custom.explore.filter')</h1>
<p>@lang('custom.explore.space-type')</p> 
<ul id="myTabs" class="nav nav-pills lidtwork" role="tablist" data-tabs="tabs">
<?php
if ( empty( $clear ) ) {
    $clear = 'no';
}
if ( empty( $wstype ) ) {
    $wstype = SPACE_TYPE_COWORKING;
}

$parents = \App\SpaceType::where('parent_id', 0)->get();

$location = $request->input('location');

foreach ($parents as $spacetype) {

    $active = '';
   if ( $wstype == $spacetype->id ) {
    $active = 'active';
   }
?>
<li class="spacetype spacetype_{{$spacetype->id}} {{$active}}">
 <a href="javascript:void(0)" onclick="fetchData('{{$location}}', '{{$spacetype->id}}')" >
@if($spacetype->id == 1)
  <img src="{{ PUBLIC_ASSETS }}images/workspace.png" > <b>{{$spacetype->name}}</b>
  @elseif($spacetype->id == 2)
  <img src="{{ PUBLIC_ASSETS }}images/meeting-space.png" > <b>{{$spacetype->name}}</b>
  @elseif($spacetype->id == 3)
  <img src="{{ PUBLIC_ASSETS }}images/virtualspace.png" > <b>{{$spacetype->name}}</b>
  @elseif($spacetype->id == 4)
  <img src="{{ PUBLIC_ASSETS }}images/workspace.png" > <b>{{$spacetype->name}}</b>
   @elseif($spacetype->id == 5)
  <img src="{{ PUBLIC_ASSETS }}images/meeting-space.png" > <b>{{$spacetype->name}}</b> 

  @endif
</a>
</li>
<?php } ?>
</ul>
<br>
<div class="tab-content">
<!-- tab1 -->
<div role="tabpanel" class="tab-pane fade in active filtre" id="Workspace" >

 <?php
 
$parent_id = '';
$parent = \App\SpaceType::where( 'id', $wstype)->first();
if ( $parent ) {
  $parent_id = $parent->id;
}

$subtype = '';
if ( request('subtype') ) {
  $subtype = request('subtype');
}

 $children = \App\SpaceType::select(['space_types.*'])->join('space_types as s2', 's2.id', '=', 'space_types.parent_id')->get();
  foreach ( $children as $child ) {
    if ( ! empty( $excludefilters ) ) {
        $parts = explode( ',', $excludefilters);
        if ( in_array( $child->id, $parts ) ) {
            continue;
        }
    }
$display = false;

if ( ! empty( $subtype ) ) {
  if( $subtype == $child->id ) {
    $display = true;
  }
} elseif ( $parent_id == $child->parent_id ) {
  $display = true;
}

 ?>
<button class="btn btn-default filterbutton subspacetypefilterbutton subspacetype_{{$child->parent_id}}" type="submit" value="{{$child->id}}" style="display: @if($display) inline-block @else none @endif">{{ $child->name }}
    <span class="fa fa-close subtypefilterclear" data-subtype_id="{{$child->id}}" data-location="{{$location}}" data-wstype="{{$child->parent_id}}" data-filter_type="subtype"></span>
</button>
<?php } ?>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="{{$filter_available_date}}" >@lang('custom.explore.avaliable') {{$filter_available_date}}
    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="{{$location}}" data-wstype="{{$wstype}}" data-filter_type="available_date"></span>
</button>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="{{$filter_months}}">@lang('custom.explore.no-of-months') {{$filter_months}}
    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="{{$location}}" data-wstype="{{$wstype}}" data-filter_type="months"></span>
</button>







<button class="btn btn-default filterbutton sty_ddn" type="submit" value="{{$filter_seats}}" >@lang('custom.explore.no-of-seats') {{$filter_seats}}
    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="{{$location}}" data-wstype="{{$wstype}}" data-filter_type="seats"></span>
</button>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="{{$price_range_start}}_{{$price_range_end}}" >@lang('custom.explore.no-of-seats') {{$price_range_start}} - {{$price_range_end}}
    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="{{$location}}" data-wstype="{{$wstype}}" data-filter_type="price_range"></span>
</button>

<input type="hidden" name="excludefilters" id="excludefilters" value="">
<input type="hidden" name="location" id="location" value="{{$location}}">
<input type="hidden" name="wstype" id="wstype" value="{{$wstype}}">
<input type="hidden" name="subtype_id" id="subtype_id" value="{{$subtype}}">
<input type="hidden" name="datasource" id="datasource" value="{{route('properties.list')}}">

<button class="btn btn-danger clearFilters sty_ddn" data-location="{{$location}}" data-wstype="{{$wstype}}"  type="submit">@lang('custom.explore.clear')
<span class="fa fa-trash-o"></span>
</button>


 <!-- More filters tab1 -->
<div class="filter" id="morefiltersDiv">
<h1 class="osLight">
<button class="btn btn-info handleFilter" type="submit" ><b>@lang('custom.explore.more-filters')</b>
<span class="fa fa-filter"></span>
</button>
</h1>

<div class="clearfix"></div>
<form class="filterForm">

<div class="row">
<!-- Availability -->
<label>
<b>@lang('custom.explore.avaliability')</b>
</label><br>
            <div class='col-sm-3'>
              <div class="form-group">
                <label><b>@lang('custom.explore.date')</b></label>
                <div class='input-group date' id='datepicker'>
                  <input type='text' class="form-control" id="filter_available_date" value="{{$filter_available_date}}" />
                  <span class="input-group-addon">
                 <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>

           
             <!-- datepicker -->
            <div class='col-sm-2'>
            <div class="form-group">
                <label><b>@lang('custom.explore.no-of-months')</b></label>
                <input type="number" min="1" class="form-control" id="filter_months" value="{{$filter_months}}">
            </div>
            </div>
            <div class='col-sm-2'>
            <div class="form-group">
                <label><b>@lang('custom.explore.no-of-seats')</b></label>
                <input type="number" min="1"class="form-control" id="filter_seats" value="{{$filter_seats}}">
            </div>
            </div>
<!-- /Availability -->

</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
<div class="formField">
    <label><b>@lang('custom.explore.price-range')</b></label>
    <div class="slider priceSlider">
        <div class="sliderTooltip">
            <div class="stArrow"></div>
            <div class="stLabel"></div>
        </div>
    </div>
    <input type="hidden" name="price_rang_start" id="price_range_start" value="{{$price_range_start}}">
    <input type="hidden" name="price_rang_end" id="price_range_end" value="{{$price_range_end}}">
</div>
</div>
</div>

<div class="sduiv3-filter-button-affixed">
        <a href="#" class="btn btn-info handleFilterClose">@lang('custom.explore.show-spaces')</a>
    </div>

</form>
</div>
<!-- /More filters -->
</div>
<!-- /tab1 -->

</div>
</div>
</div>
</div>
</div>
