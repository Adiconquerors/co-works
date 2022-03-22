@include('partials.newadmin.common.add-edit.formfields-headlinks')

<style>
  .req-formcontrol {
    padding: 6px 46px !important;
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

            <form class="" role="form" id="assigned_to_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('assigned_to', trans('custom.inquiries.who') ) !!}

                  <?php
                  $assigned_to = \App\User::get()->whereIn('role_id', [1, 4])
                  ->pluck('name', 'id');
                   $assigned_value = $item->assigned_to;
                  ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>

                    <select name="assigned_to" id="assigned_to" class="req-formcontrol">

                    <option value="0">@lang('custom.inquiries.not-assigned')</option>

                      <?php
                   foreach ($assigned_to as $id=>$assign)
                  {
                ?>
                      <option value="{{ $id }}" {{ ( $item->assigned_to == $id ) ? ' selected' : '' }}>{{ $assign }}</option>

                      <?php } ?>
                    </select>
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