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

            <form class="" role="form" id="visit_details_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  {!! Form::label('visit_details',trans('custom.eforms.visit-details') ) !!}
                  <div class="input_field">
                    <?php
                      $enquire_visit_details = $item->visit_details;
                      if($enquire_visit_details){
                      $enquire_visit_value = $enquire_visit_details; 
                      }else{
                      $enquire_visit_value = null;
                      }
                    ?>

                    {!! Form::textarea('visit_details', $enquire_visit_value , ['class' => 'form-control', 'id'=>'visit_details', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.visit-details')]) !!}


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