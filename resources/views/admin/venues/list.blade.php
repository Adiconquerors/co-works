@extends('layouts.new_admin_layout')

@section( 'new_content' )
<div class="row" >
<div class="col-12">
    <div class="page-title-box">
        <h4 class="page-title">
            {{ ucwords( $active_class ) }}
        </h4>
      
        <div class="clearfix">
        </div>
    </div>
    </div>
</div>

 <div class="row text-center">
  <div class="col-sm-12">
    <h3 class="m-t-20">
      @lang('custom.eforms.search') 
    </h3>
    <div class="border mx-auto d-block m-b-20"></div>
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">
    @include('admin.venues.filters.venue-filter')
  </div>
</div>
<!-- end row -->
    <!-- table -->
         <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive" id="VenueList">
                     @include('admin.venues.venue-list',compact( $items ))
                </div>
            </div>
        </div>

                   

                <!-- end Table -->
@stop

    @section( 'new_admin_js_scripts' )
     @include('home-pages.common.autocomplete')  
     
        <script>
            $(document).ready(function () {
              "use strict";
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    //ajax: "{{ route( 'venues.index' ) }}",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            
        </script>

        <!-- filters -->
<script>
  $(document).ready(function() {
    "use strict";

    $(document).on('click', '#venueSearch', function(e) {
      e.preventDefault();
      $('#VenueList').val('');

      var _token = $("input[name='_token']").val();

      var property_name = $("#property_name").val();
      var property_address = $("#property_address").val();
      var manager_name = $("#manager_name").val();
      var manager_email = $("#manager_email").val();
      var manager_phone = $("#manager_phone").val();

      $.ajax({
        url: '{{ route("venues.filter") }}',
        type: 'POST',
        data: {
          _token: _token,
          property_name: property_name,
          property_address: property_address,
          manager_name: manager_name,
          manager_email: manager_email,
          manager_phone: manager_phone,
          
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#VenueList').html(data);

          } else {
            alert("{{trans('others.went-wrong')}}");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->

    @endsection       