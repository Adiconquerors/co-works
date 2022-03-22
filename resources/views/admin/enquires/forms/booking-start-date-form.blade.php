@include('partials.newadmin.common.add-edit.formfields-headlinks')
<style>
  .req-formcontrol {
    padding: 9px 46px !important;
  }
</style>
<div class="modal-header">
  <h4 class="modal-title">( @lang('custom.inquiries.inquiry-id') : {{$item->id}} )</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">

          <div class="">

            <form class="" role="form" id="bookingstart-date-form" method="post">
              <div class="row clearfix">
               <div class="input_field">
                 {!! Form::label('booking_start_date', ucwords(trans('custom.eforms.booking-start-date')) ) !!}
                    <input type="date" id="booking_start_date" name="booking_start_date" class="input-large form-control" placeholder="@lang('custom.eforms.booking-start-date')" value="{{$item->booking_start_date}}">
                </div>

                 <div class="input_field">  
                {!! Form::label('revenue_generated', ucwords(trans('custom.eforms.revenue-generated')) ) !!}  
                  <input type="number" id="revenue_generated" min="0" name="revenue_generated" class=" form-control" placeholder="@lang('custom.eforms.revenue-generated')" value="{{$item->revenue_generated}}">
                 </div>

                 <div class="input_field">  
                 {!! Form::label('payment_mode', ucwords(trans('custom.eforms.payment-mode')) ) !!}
                  <input type="text" id="payment_mode"  name="payment_mode" class=" form-control" placeholder="@lang('custom.eforms.payment-mode')" value="{{$item->payment_mode ?? ''}}">
                 </div> 

              </div>

              <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$item->id}}">
              <input type="hidden" id="action" name="action" value="{{$action}}">
              <input type="hidden" id="sub" name="sub" value="{{$sub}}">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')