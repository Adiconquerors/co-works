  @include('partials.newadmin.common.add-edit.formfields-headlinks')
<style>
  .sty-dn{
    display: none;
  }
</style>

  <div class="modal-header">
    <h4 class="modal-title">{{ $template->title }} ( @lang('custom.listings.fields.property-id') : {{$item->id}} )</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>

  <div class="modal-body">
    <div class="form_wrapper">
      <div class="form_container">
        <div class="row clearfix">
          <div class="">

            <div class="">

              <form class="" role="form" id="email_form" method="post">
                @csrf
                <div class="row clearfix">
                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <input type="text" id="toname" name="toname" placeholder="@lang('custom.eforms.name')" value="" />
                    </div>
                  </div>

                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                      <input type="email" name="toemail" id="toemail" value="" placeholder="@lang('custom.eforms.email')" />
                    </div>
                  </div>
                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                      <input type="text" name="mail_mobile" value="" id="mail_mobile" placeholder="@lang('custom.eforms.mobile')" />
                    </div>
                  </div>

                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                      <input type="email" id="ccemail" name="ccemail" value="" placeholder="@lang('custom.eforms.ccemail')">
                    </div>
                  </div>

                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fas fa-chair"></i></span>
                      <input type="text" name="no_of_seats" id="no_of_seats" placeholder="@lang('custom.eforms.no-of-seats')" />
                    </div>
                  </div>

                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-inr"></i></span>
                      <input type="text" id="invoice_amount" name="invoice_amount" placeholder="@lang('custom.eforms.amount')" value="" />
                    </div>
                  </div>

                </div>

                <div class="input_field">
                  <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="@lang('custom.eforms.description')" />
                </div>

                <div class="sty-dn">
                  <textarea class="summernote" rows="3" name="message" id="message">{{ $template->content }}</textarea>
                </div>


             
                <label>@lang('custom.eforms.company-details')</label>
                <div class="row clearfix">

                  <div class="col_quarter">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                      <input type="text" value="" name="company_address" placeholder="@lang('custom.eforms.company-address')" id="company_address" />
                    </div>
                  </div>
                </div>



                <input type="hidden" id="property_id" name="property_id" value="{{$item->id}}">
                <input type="hidden" id="action" name="action" value="{{$action}}">
                <input type="hidden" id="sub" name="sub" value="{{$sub}}">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')