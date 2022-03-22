@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
  
@endsection

@section( 'new_content' )

@if( isAdmin() || isAgent() )
<div class="row">
  <div class="col-sm-12">
    @include('admin.leads.filters.leads-filters',array('items'=>$items))
</div>
</div>
@endif

<!-- table -->
<div class="row">
 <div class="col-sm-12" id="DealStatusList">
    @include('admin.leads.lead-list',array('items'=>$items))
 </div>
</div>
            <!-- end Table -->
@stop

@section( 'new_admin_js_scripts' )  
 
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
    $(document).on('click', '#DealStatusSearch', function(e) {
      e.preventDefault();
      $('#DealStatusList').val('');

      var _token = $("input[name='_token']").val();

      var deal_status = $("#deal_status").val();

      $.ajax({
        url: '{{ route("leads.dealstatusfilter") }}',
        type: 'POST',
        data: {
          _token: _token,
          deal_status: deal_status
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#DealStatusList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->

@endsection       

