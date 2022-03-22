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

            <form class="" role="form" id="paymentstatus-totalamount-form" method="post">
              <div class="row clearfix">
                 <div class="input_field">  
                 {!! Form::label('amount_paid', ucwords(trans('custom.eforms.amount-paid')) ) !!}
                  <input type="number" id="amount_paid" min="0" name="amount_paid" class="form-control" placeholder="@lang('custom.eforms.amount-paid')" value="{{$item->amount_paid ?? '0'}}">
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