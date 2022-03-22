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

          <div class="">

            <form class="" role="form" id="comments_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('comments','Comments' ) !!}
                  <div class="input_field">
                    <?php
                      $enquire_comments = $item->comments;
                      if($enquire_comments){
                      $enquire_comments_value = $enquire_comments; 
                      }else{
                      $enquire_comments_value = null;
                      }
                    ?>

                    {!! Form::textarea('comments', $enquire_comments_value , ['class' => 'form-control', 'id'=>'comments', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.enter-comments')]) !!}


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