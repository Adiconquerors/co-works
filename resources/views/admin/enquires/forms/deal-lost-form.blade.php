@include('partials.newadmin.common.add-edit.formfields-headlinks')

<style>
  .req-formcontrol {
    padding: 4px 36px !important;
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

            <form class="" role="form" id="deal_lost_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('deal_lost', trans('custom.eforms.deal-lost') ) !!}

              <?php
                $deal_lost = array(
                  '' => trans('custom.eforms.please-select'),
                  trans('custom.eforms.required-location') => trans('custom.eforms.required-location'),
                  trans('custom.eforms.required-budget') => trans('custom.eforms.required-budget'),
                  trans('custom.eforms.like-venue') => trans('custom.eforms.like-venue'),
                  trans('custom.eforms.required-rates') => trans('custom.eforms.required-rates'),
                  trans('custom.eforms.other') => trans('custom.eforms.other'),  
                );
              ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>

                    <select name="deal_lost" id="deal_lost" class="req-formcontrol" placeholder="@lang('custom.eforms.please-select')">
                      <?php
                   foreach ($deal_lost as $id=>$assign)
                  {
                ?>

                      <option value="{{ $id }}" {{ ( $item->deal_lost == $id ) ? ' selected' : '' }}>{{ $assign }}</option>

                      <?php } ?>
                    </select>

                  </div>
                </div>

                <div class="col_half">
                  {!! Form::label('deal_comments',trans('custom.eforms.comments') ) !!}
                  <div class="input_field">
                    <?php
                    $deal_comments = $item->deal_comments;
                    if($deal_comments){
                      $deal_comments_value = $deal_comments; 
                    }else{
                      $deal_comments_value = null;
                    }
                  ?>

                    {!! Form::textarea('deal_comments', $deal_comments_value , ['class' => 'form-control', 'id'=>'deal_comments', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.enter-comments')]) !!}


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