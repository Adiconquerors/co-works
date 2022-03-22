@extends('layouts.new_admin_layout')

@section( 'new_content' )
<style>
  .sty-flex{
    display: flex;
  }
  .sty-mtfs{
    margin-top: 5px; font size: 13px;
  }
</style>
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="sty-flex">
        <div class="col-sm-6 col-md-6">
          <div class="form-group">
            <label class="control-label sty-mtfs">
              @lang('custom.dealtracker.booking-initiated')
            </label>
          </div>
        </div>
      
      </div>

    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- end row -->

<div class="card">
  <div class="card-body" id="EnquireList">
    @include('admin.enquires.dealtracker.dealtracker-booking-initiated-list',compact( $items ))
  </div>
</div>

@include('admin.enquires.modal-loading')
<!-- end row -->
@endsection
@section( 'new_admin_js_scripts' )

@include('admin.enquires.scripts.formscripts')

<script src="{{PUBLIC_ASSETS_NEW_ADMIN}}pages/jquery.datatables.editable.init.js"></script>

<script>
  $(document).ready(function() {
    "use strict";
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
      keys: true
    });
    $('#datatable-responsive').DataTable();
    $('#datatable-colvid').DataTable({
      "dom": 'C<"clear">lfrtip',
      "colVis": {
        "buttonText": "Change columns"
      }
    });
   
    var table = $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });
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


@endsection