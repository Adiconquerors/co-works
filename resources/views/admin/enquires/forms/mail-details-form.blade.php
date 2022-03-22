@include('partials.newadmin.common.add-edit.formfields-headlinks')
 
 <style>
  .sty-dn{
    display:none;
  }
 </style> 

<div class="modal-header">
  <h4 class="modal-title">{{ $template->title }} ( @lang('custom.inquiries.inquiry-id') : {{$item->id}} )</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">

          <div class="">

            <form class="" role="form" id="mail_message_form" method="post">
              <div class="row clearfix">


                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="toemail" id="toemail" value="{{ $item->email }}" placeholder="@lang('custom.eforms.email')" />
                  </div>
                </div>

                <div class="input_field">
                  <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="@lang('custom.eforms.description')" />
                </div>


              </div>



              <div class="sty-dn">
                <textarea class="summernote" rows="3" name="message" id="message">{{ $template->content }}</textarea>
              </div>


              <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$item->id}}">
              <input type="hidden" id="customer_id" name="customer_id" value="{{$item->customer_id}}">
              <input type="hidden" id="action" name="action" value="{{$action}}">
              <input type="hidden" id="sub" name="sub" value="{{$sub}}">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')