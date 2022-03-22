@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
  <style>
 .sty-mt{
    margin-top:200px;
 }
 .sty-di{
    display:inline;
 }
 .sty-ml60{
   margin-left: 60px;
 }
 .sty-ml50{
   margin-left: 50px;
 }
 #al-whatsapp{
   color: green; font-size: 20px;
 }
 .sty-ml103{
   margin-left: 103px;
 }
</style>
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <h4 class="page-title">@lang('custom.listings.fields.property-listing')</h4>

      <div class="breadcrumb p-0 m-0">
        <a href="{{ route('properties.create') }}" class="btn btn-purple waves-effect waves-light"><i class="fas fa-plus-square"></i>  @lang('custom.listings.fields.add-property')</a>
      </div>

      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!-- end row -->
<div class="row text-center">
  <div class="col-sm-12">
    <h5>@lang('custom.listings.fields.search-properties')</h5>
    
  </div>
</div>
<!-- end row -->
<div class="row">
  <div class="col-sm-12">

    @include('admin.listings.listing-filters',compact($items))
  </div>
</div>
<!-- end row -->
<div class="row">

  
@if (\Session::has('enquire'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('enquire') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('initiated'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('initiated') !!}</li>
        </ul>
    </div>
@endif

  <div class="col-lg-12" id="listingList">
    @include('admin.listings.listing-list',['items'=>$items])
  </div>
  <!--END MAIN COL-8 -->
</div>
<!-- end row -->

@if( ! empty( $items ) )
@foreach( $items as $item )
<!-- Alternate Contact Modal -->
<div class="modal fade" id="modalContactForm_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content sty-mt">
      <div class="modal-header text-center">
        <h4 class="modal-alternative-title w-100 font-weight-bold">
          @lang('custom.listings.fields.alternative-contact-details')
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table">

           <tbody>
            <tr>
              <th scope="row">@lang('custom.listings.fields.alternate-contact-person-name')</th>
              <td> {{ $item->alter_cotact_person_name ? $item->alter_cotact_person_name : '-'}}</td>

              </tr>
              <tr>
              <th scope="row">@lang('custom.listings.fields.alternate-email-id')</th>
              <td> {{ $item->alter_email ? $item->alter_email : '-'}}</td>

              </tr>
              <tr>
              <th scope="row">@lang('custom.listings.fields.alternate-contact-person-number')</th>
              <td>{{ $item->alter_cotact_person_number ? $item->alter_cotact_person_number : '-'}}</td>

          </tr>
          </tbody>
          </table>
      </div>

    </div>
  </div>
</div>

@endforeach
@endif

@include('admin.listings.modal-loading')

@stop

@section( 'new_admin_js_scripts' )

  @include('admin.listings.listings-scripts')

  @include('admin.listings.shortlist-scripts',compact($items))

  @include('admin.listings.visits-scripts',compact($items))

  @include('home-pages.common.autocomplete')

<script>
  $(document).ready(function() {
    "use strict";
    function getSearchResults() {
      $('#listingList').val('');

      var _token = $("input[name='_token']").val();
      var property_manager_name = $("#property_manager_name").val();
      var property_manager_email = $("#property_manager_email").val();
      var property_address = $("#property_address").val();
      var property_id = $("#property_id").val();
      var space_type = $("#space_type").val();
      var pagination_value = $("#pagination_value").val();

      $.ajax({
        url: '{{ route("properties.filter") }}',
        type: 'GET',
        data: {
          _token: _token,
          property_manager_name: property_manager_name,
          property_manager_email: property_manager_email,
          property_address: property_address,
          property_id: property_id,
          space_type: space_type,
          pagination_value: pagination_value
        },

        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $('#listingList').html(data);

          } else {
            alert("Somthing went wrong!!");

          }
        }
      });
    }
    

    $(document).on('click', '#listingSearch', function(e) {
      e.preventDefault();
      getSearchResults();
    });
  });
</script>
<!-- End Listing Search -->
@endsection