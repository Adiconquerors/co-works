@include('partials.newadmin.common.add-edit.formfields-headlinks')
<div class="modal-header">
  <h4 class="modal-title">  @lang('custom.bookings.payment-for-invoice-id') : {{ $item->invoice_id }} </h4>
  <?php
    $customers = \App\User::find( $item->customer_id );
  ?>

  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">
          <div class="">
            <form class="" role="form" id="payment_form" method="POST">
              <div class="row clearfix">
                <div class="col_half"> {!! Form::label('customer_name',trans('custom.bookings.customer-name') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="customer_name" id="customer_name" placeholder="@lang('custom.eforms.name')" value="{{ $customers ? $customers->name : ''}}" disabled> </div>
                </div>
                <input type="hidden" id="customer_name" name="customer_name" value="{{$customers ? $customers->name : ''}}">
                <div class="col_half"> {!! Form::label('customer_email',trans('custom.bookings.customer-email') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="customer_email" id="customer_email" value="{{$customers ? $customers->email : ''}}" placeholder="@lang('custom.eforms.email')" disabled> </div>
                </div>
                <input type="hidden" id="customer_email" name="customer_email" value="{{$customers ? $customers->email : ''}}">
                <div class="col_half"> {!! Form::label('customer_mobile',trans('custom.bookings.customer-mobile') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="customer_mobile" value="{{$customers ? $customers->mobile : ''}}" id="customer_mobile" placeholder="@lang('custom.eforms.mobile')" disabled> </div>
                </div>
                <input type="hidden" id="customer_mobile" name="customer_mobile" value="{{$customers ? $customers->name : ''}}">
                  <?php
                    $inquiries = \App\Enquire::find($item->property_id);
                    $booking_initiated = json_decode($inquiries->booking_initiated, true);
                  ?>
                  <div class="col_half"> 
                    {!! Form::label('company_name',trans('custom.bookings.company-name') ) !!}
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                      <input type="text" name="company_name" id="company_name" value="{{ $inquiries ? $inquiries->company : '' }}" placeholder="@lang('custom.eforms.mobile')" disabled> </div>
                  </div>
                  <input type="hidden" id="company_name" name="company_name" value="{{ $inquiries ? $inquiries->company : '' }}">
                  <div class="col_half"> 
                    {!! Form::label('no_of_seats',trans('custom.bookings.no-of-seats') ) !!}
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                      <input type="text" name="no_of_seats" value="{{ $item->no_of_seats ?? '' }}" id="no_of_seats" placeholder="@lang('custom.eforms.no-of-seats')" disabled> </div>
                  </div>
                   <div class="col_half"> 
                    {!! Form::label('transaction_id',trans('custom.bookings.transaction-id') ) !!}
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-money"></i></span>
                      <input type="text" name="transaction_id" value="" id="transaction_id" placeholder="@lang('custom.eforms.payment-transactionid')"> </div>
                  </div>

                  <input type="hidden" id="no_of_seats" name="no_of_seats" value="{{$item->no_of_seats}}">
                  <div class="col_half"> 
                    {!! Form::label('total_amount',trans('custom.bookings.total-amount') ) !!}
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-money"></i></span>
                      <input type="text" name="total_amount" value="{{ $item->total_amount ?? ''}}" id="total_amount" placeholder="@lang('custom.eforms.amount')" disabled> </div>
                  </div>
                  <input type="hidden" id="total_amount" name="total_amount" value="{{$item->total_amount}}">
                  <input type="hidden" id="invoice_action" name="invoice_action" value="{{$item->action}}">
                  <input type="hidden" id="property_id" name="property_id" value="{{$item->property_id}}">
                  <input type="hidden" id="amount" name="amount" value="{{$item->amount ?? ''}}">
                  <input type="hidden" id="gstin" name="gstin" value="{{$item->gstin ?? ''}}">
                  <br/> </div>
              <div class="input_field"> </div>
              <br/>
              <input type="hidden" id="invoice_id" name="invoice_id" value="{{$item->id}}">
              <input type="hidden" id="action" name="action" value="{{$action}}">
              <input type="hidden" id="sub" name="sub" value="{{$sub}}"> </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')