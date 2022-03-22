@extends('layouts.new_admin_layout')
@section( 'new_admin_head_links' )
@include( 'partials.newadmin.common.datatables.datatables-head-links' )
@endsection

@section( 'new_content' )
<style>
   .font-13 span i {
    padding-left: 5px;
}  
</style>
 
<!-- end row -->
<div class="row text-center">
  <div class="col-sm-12">
    <h5  >
      @lang('custom.inquiries.search-leads')
    </h5>
    
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">
    <div class="filters-border">
    @include('admin.enquires.forms.enquiries-filter')
</div>
  </div>
</div>
<!-- end row -->
  
<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <?php
                       if( isAdmin() ){ 
                    ?>
                    {{ ucwords( $active_class ) }}
                    <?php  } else if( isCustomer() ) { ?> 
                       
                    @lang('custom.inquiries.inquiries')
                <?php } ?>

                </h4>
                @if( isAdmin() )
                <div class="breadcrumb p-0 m-0" >
                    
                        <a href="{{ route('leads.create') }}" class="btn btn-purple waves-effect waves-light sty-btn-margin"><i class="fas fa-plus-square">
                        </i>
                       @lang('custom.inquiries.add-lead')
                    </a>
                   
                </div>
                @endif
                <div class="clearfix">
                </div>
            </div>
            </div>
        </div>  

<div class="card">
  <div class="card-body" id="EnquireList">
    @include('admin.enquires.enquiry-list',compact( $items ))
  </div>
</div>

@include('admin.enquires.modal-loading')
<!-- end row -->
@endsection
@section( 'new_admin_js_scripts' )

@include('admin.enquires.scripts.formscripts')
@include('home-pages.common.autocomplete')

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



<script>
  function myFunction(x) {
    x.classList.toggle("fa-flag-checkered");
  }

  @if(!empty($items))
  @foreach($items as $item)
  var flag_color = 'white';
  $(document).on('click', '#checkered_{{$item->id}}', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var _token = $("input[name='_token']").val();


    if (flag_color == 'white') {
      
      flag_color = 'lightgreen';
      
    } else {
      
      flag_color = 'white';
      
    }

    $.ajax({
      url: "{{route('enquire.important')}}",
      type: 'POST',
      data: {
        _token: _token,
        lead_id: '{{$item->id}}',
        flag_color: flag_color
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          if (data.flag_color == "lightgreen") {
            alert(data.success);
            $('#gradex_{{$item->id}}').css('background', 'lightgreen');
          } else {
            alert(data.removed);
            $('#gradex_{{$item->id}}').css('background', '');
            
          }
        }
      }
    });


  });

  @endforeach
  @endif
</script>


<!-- filters -->
<script>
  $(document).ready(function() {
    "use strict";
    $(document).on('click', '#leadSearch', function(e) {
      e.preventDefault();
      $('#EnquireList').val('');

      var _token = $("input[name='_token']").val();

      var lead_address = $("#lead_address").val();
      var lead_assigned_to = $("#lead_assigned_to").val();
      var lead_name = $("#lead_name").val();
      var lead_email = $("#lead_email").val();
      var lead_number = $("#lead_number").val();
      var lead_status = $("#lead_status").val();


      $.ajax({
        url: '{{ route("enquires.filter") }}',
        type: 'POST',
        data: {
          _token: _token,
          lead_address: lead_address,
          lead_assigned_to: lead_assigned_to,
          lead_name: lead_name,
          lead_email: lead_email,
          lead_number: lead_number,
          lead_status: lead_status
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#EnquireList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- end filters -->
<script>
$(function(){
  $(".wrapper1").scroll(function(){
    $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
  });
  $(".wrapper2").scroll(function(){
    $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
  });
});
</script>

<!-- booking initiated filters -->  
<script>
  $(document).ready(function() {
    "use strict";
    $(document).on('click', '#bookingInitiatedSearch', function(e) {
      e.preventDefault();
      $('#EnquiryBookingInitiatedSearchList').val('');

      var _token = $("input[name='_token']").val();

      var property_address = $("#property_address").val();
      var property_id = $("#property_id").val();
      var property_company = $("#property_company").val();
      var space_type = $("#space_type").val();
      
      $.ajax({
        url: '{{ route("enquiresbookinginitiated.filter") }}',
        type: 'POST',
        data: {
          _token: _token,
          property_address: property_address,
          property_id: property_id,
          property_company: property_company,
          space_type: space_type,
          
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#EnquiryBookingInitiatedSearchList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    });
  });
</script>
<!-- End booking initiated filters   -->
@endsection