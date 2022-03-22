  @include('partials.newadmin.common.add-edit.formfields-headlinks')

   <style>
  .sty-dn{
    display:none;
  }
</style>

  <?php
     $company = $item->company ?? '';
  ?>

  <div class="modal-header">
    <h4 class="modal-title">{{ $template->title }} ( @lang('custom.inquiries.inquiry-id') : {{$item->id}} )</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>

  <div class="modal-body">
    <div class="form_wrapper">
      <div class="form_container">
        <div class="row clearfix">
          <div class="">

            <form class="" role="form" id="tax_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('toname', ucwords(trans('custom.eforms.name')) ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="toname" name="toname" placeholder="@lang('custom.eforms.name')" value="" />
                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('toemail', ucwords(trans('custom.eforms.toemail')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="toemail" id="toemail" value="" placeholder="@lang('custom.eforms.email')" />
                  </div>
                </div>
                <div class="col_half">
                  {!! Form::label('mail_mobile', ucwords(trans('custom.eforms.mobile')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="mail_mobile" value="" id="mail_mobile" placeholder="@lang('custom.eforms.mobile')" />
                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('ccname', ucwords(trans('custom.eforms.ccemail')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" id="ccemail" name="ccemail" value="" placeholder="@lang('custom.eforms.ccemail')">
                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('no_of_seats', ucwords(trans('custom.eforms.no-of-seats')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fas fa-chair"></i></span>
                    <input type="text" name="no_of_seats" id="no_of_seats" placeholder="@lang('custom.eforms.no-of-seats')" />
                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('invoice_amount', ucwords(trans('custom.eforms.amount')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-inr"></i></span>
                    <input type="text" id="invoice_amount" name="invoice_amount" placeholder="@lang('custom.eforms.amount')" value="" />
                  </div>
                </div>

              </div>

              <div class="input_field">
                {!! Form::label('mail_description', ucwords(trans('custom.eforms.description')) ) !!} 
                <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="@lang('custom.eforms.description')" />
              </div>

              <div class="sty-dn">
                <textarea class="summernote" rows="3" name="message" id="message">{{ $template->content }}</textarea>
              </div>

              <label>@lang('custom.eforms.company-details')</label>
              <div class="row clearfix">
               <div class="col_quarter">
                {!! Form::label('company_address', ucwords(trans('custom.eforms.company-address')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                    <input type="text" value="" name="company_address" placeholder="@lang('custom.eforms.company-address')" id="company_address" />
                  </div>
                </div>
                
                  <div class="col_quarter">
                     {!! Form::label('company_name', ucwords(trans('custom.eforms.company-name')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                    <input type="text" value="" name="company_name" placeholder="@lang('custom.eforms.company-name')" id="company_name" />
                  </div>
                </div>

                <div class="col_quarter">
                  {!! Form::label('gstin_number', ucwords(trans('custom.eforms.gstin-num')) ) !!} 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-globe"></i></span>
                    <input type="text" value="" name="gstin_number" placeholder="@lang('custom.eforms.gstin-num')" id="gstin_number"/>
                  </div>
                </div> 

                <div class="col_quarter">
                  {!! Form::label('invoice_gstin', ucwords(trans('custom.eforms.gst')) ) !!} 
                  <div class="input_field">
                    <input type="text" name="invoice_gstin" value="18" id="invoice_gstin" placeholder="@lang('custom.eforms.gst')" />
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