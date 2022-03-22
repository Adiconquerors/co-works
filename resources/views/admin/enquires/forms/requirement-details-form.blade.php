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

            <form class="" role="form" id="req_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('capacity_id', trans('custom.eforms.capacity') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>

                    <?php
                    $capicities = array(

                    '1 - 50' => '1 - 50 People',
                    '51 - 100' => '51 - 100 People',
                    '101 - 200' => '101 - 200 People',
                    '201 - 300' => '201 - 300 People',
                    '301 - 400' => '301 - 400 People',
                    '401 - 500' => '401 - 500 People',
                    '500+' => '500+ People',
                    );

                  ?>


                    {!! Form::select('capacity_id', $capicities, $item->capacity_id,['class' => 'form-control req-formcontrol','id'=>'capacity_id','placeholder'=> trans('custom.eforms.please-select')
                    ]) !!}

                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('enquire_date', trans('custom.eforms.booking-date') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>

                    <input type="text" name="req_booking_date" value="{{ $item->enquire_date ?? '' }}" class="datepicker" id="req_booking_date" placeholder="@lang('custom.eforms.booking-date')" />

                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('enquire_month', trans('custom.eforms.booking-months') ) !!}
                  <div class="input_field">
                    <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="number" name="req_booking_months" value="{{ $item->enquire_month ?? '' }}" id="req_booking_months" placeholder="@lang('custom.eforms.booking-months')" min="0">
                  </div>
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