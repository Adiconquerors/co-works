@extends('layouts.new_admin_layout')
@section( 'new_admin_head_links' )
@include( 'partials.newadmin.common.datatables.datatables-head-links' )
@endsection

@section( 'new_content' )
<style>
.sty-mtfs{
   margin-top: 5px; font size: 13px;
}
.sty-df{
  display:flex;
}
</style>
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="sty-df">
        <div class="col-sm-6 col-md-1">
          <div class="form-group">
            <label class="control-label sty-mtfs" >
              @lang('custom.providers.providers')
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
  <div class="card-body">
    @include('admin.listings.providers.provider-list',compact( $items ))
  </div>
</div>

<!-- end row -->
@endsection
@section( 'new_admin_js_scripts' )

<script src="{{PUBLIC_ASSETS_NEW_ADMIN}}pages/jquery.datatables.editable.init.js"></script>
@include( 'partials.newadmin.common.datatables.datatables-script-links' )
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
    $('#datatable-scroller').DataTable({
      //ajax: "{{ route( 'users.index' ) }}",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
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
  TableManageButtons.init();
</script>
@endsection