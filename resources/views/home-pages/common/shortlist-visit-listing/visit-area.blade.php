<style>
  #styid1-fr{
    float:right;
  }.sty-h350ofy{
    height:350px; overflow-y: scroll; overflow-x: hidden;
  }
</style>
<div class="feedback_form_area_inner">

<h3>

<?php
   $properties_visits_count = $properties_visits->count();
?>

@lang('custom.eforms.visits') ({{ $properties_visits_count }})
  
  
@if( $properties_visits_count > 0 )
    <a href="#VisitsModal" data-toggle="modal" data-remote="false" class="" data-action="">    
    <i class="fa fa-share-alt" id="styid1-fr"></i>
</a> 

@endif  


</h3>
    
    

<h5 class="text-center red">
@lang('custom.eforms.schedule-visits')
</h5>

<div class="sty-h350ofy">
@foreach( $properties_visits as $property_visit )
    @php
     $cover_image = $property_visit->cover_image; 
     $property_sub_space_types = $property_visit->property_sub_space_types;   
    @endphp     

<div class="card-body-shortlist">
<!-- property card -->
<div class="property-card property-horizontal bg-white">
<div class="row">
<div class="col-sm-4">
  @if($cover_image)
  <div class="property-image shortlist-card-visits" style="background: url('{{ $cover_image }}') center center / cover no-repeat;height:60px !important;width:70px !important; ">
  </div>
  @else
    <div class="property-image shortlist-card-visits" style="background: url('{{ url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' ) }}') center center / cover no-repeat;height:60px !important;width:70px !important; ">
  </div>
  @endif
</div>
<!-- /col 4 -->
<div class="col-sm-8">
<div class="property-content-card">
<span class="pull-right clickable close-icon1" data-effect="fadeOut">
<i class="fa fa-times" id="visit-close_{{$property_visit->id}}">
</i>
</span>
<div class="listingInfo">
<div class="card-wid">
<h5>
 
    <a href="javascript:void(0);" class="text-dark property-lab property-main-lab">
        {{ $property_visit->company }}
    </a>
</h5>

<span>{{ $property_visit->property_address }}</span>

</div>
</div>
</div>
</div>
</div>
  

</div>
<!-- End property card -->
</div>
@endforeach
  @if( $properties_visits_count > 0 )
    <form class="visits-inline">
        <div class="control-group">
            <div class="controls">
                <input type="date" id="visit_date" name="visit_date" class="input-large form-control" />
            </div>
        </div>
        <div class="control-group">
                <div class="controls">
                    <input type="time" onchange="onTimeChange()" name="visit_time" id="visit_time" class="input-large form-control" />
                </div>
        </div>
    </form>
  @endif

</div>
</div>

<script>
    var inputEle = document.getElementById('visit_time');

function onTimeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }
  alert(hours + ':' + minutes + ' ' + meridian);
}
</script>