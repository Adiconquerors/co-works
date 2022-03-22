<?php
  $properties_shortlists = \App\Property::where( 'heart_color' , 'red' )->get();
  $properties_visits = \App\Property::where( 'schedule_visit' , 'no' )->get();
?>
  <!-- Right sliding forms -->
<!--feedback-form-->
<div id="feedback-form" class="feedback-form">

<a href="javascript:void(0);" class="feedback-form-btn-1 btn btn-success" id="OpenForm-visits">@lang('others.visits')</a>
<a href="javascript:void(0);" class="feedback-form-btn-2 btn btn-success" id="OpenForm-shortlist">@lang('others.shortlist')</a>
<!-- visits -->
<div class="feedback_form_area-visits">
    @include( 'home-pages.common.shortlist-visit-listing.visit-area' )
</div>
<!-- End visits -->

<!-- shortlist -->
<div class="feedback_form_area-shortlist">
    @include( 'home-pages.common.shortlist-visit-listing.shortlist-area',compact('properties_shortlists') )
</div>
</div>
@include( 'home-pages.common.shortlist-visit-listing.visit-area-modal' )

@include( 'home-pages.common.shortlist-visit-listing.shortlist-area-modal' )

 <script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script>
<!-- shortlist close -->
<script>
  @if(!empty($properties_shortlists))
  @foreach($properties_shortlists as $item)
  $(document).on('click', '#heart-close_{{$item->id}}', function(e) {
    e.preventDefault();

    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "{{route('property.shortlist_close')}}",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '{{ $item->id }}'
      },
      success: function(data) {
        location.reload();
      }
    });

    // $(".feedback_form_area-shortlist").toggle();

  });

  @endforeach
  @endif
</script>
<!-- end shortlist close -->


<!-- visits close -->
<script>
  @if(!empty($properties_visits))
  @foreach($properties_visits as $item)
  $(document).on('click', '#visit-close_{{$item->id}}', function(e) {
    e.preventDefault();

    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "{{route('property.visit_close')}}",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '{{ $item->id }}'
      },
      success: function(data) {
        location.reload();
      }
    });


  });

  @endforeach
  @endif
</script>
<!-- end visit close -->
<!--feedback-form-->
<!-- /Right Sliding Forms-->
