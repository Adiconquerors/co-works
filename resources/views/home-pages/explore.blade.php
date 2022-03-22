@extends( 'layouts.main_two' )

@section( 'content_two' )
@include( 'home-pages.common.head-links' )       
<div id="content">
<div class="resultsList" id="resultsList">
    @include('home-pages.explore-list')
</div>

<!-- Checkout Wrapper -->
<div class="sm-wrapper ">
  <div class='container'>
     <div class='row'>
       @include('home-pages.property-compare')
     </div>
  </div>
</div>
<!-- /Checkout Wrapper -->

</div>
<div class="clearfix "></div>
@stop

@section('main_two_javascripts_links')
<script type="text/javascript">
    function fetchData(loc, wstype) {
        $('#resultsList').html('');

	    var _token   = $("input[name='_token']").val();
            $.ajax({
                url: '{{ route("properties.list") }}',
                type:'POST',
                data: { _token:_token, location: loc, wstype: wstype},
                success: function(data) {
                 
                 $('#resultsList').html( data );

                 
                }
            });

    }
</script>
@stop