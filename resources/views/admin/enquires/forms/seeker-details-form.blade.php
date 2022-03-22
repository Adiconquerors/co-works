@include('partials.newadmin.common.add-edit.formfields-headlinks')

<div class="modal-header">
  <h4 class="modal-title">( @lang('custom.inquiries.inquiry-id') : {{$item->id}} )</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">
            <form class="" role="form" id="seeker_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('name',trans('custom.eforms.name') ) !!}
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="seeker_name" name="seeker_name" placeholder="@lang('custom.eforms.name')" value="{{ $item->name }}" />
                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('email',trans('custom.eforms.email') ) !!}
                  <div class="input_field">
                    <span>
                      <i aria-hidden="true" class="fa fa-envelope"></i>
                    </span>
                    <input type="email" name="seeker_email" id="seeker_email" value="{{ $item->email }}" placeholder="@lang('custom.eforms.email')" />
                  </div>
                </div>
                <div class="col_half">
                  {!! Form::label('phone_number',trans('custom.eforms.mobile')) !!}
                  <div class="input_field">
                    <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="seeker_phone_number" value="{{ $item->phone_number }}" id="seeker_phone_number" placeholder="@lang('custom.eforms.mobile')" />
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