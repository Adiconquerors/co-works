<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="modal-header">
  <h4 class="modal-title">( <?php echo app('translator')->getFromJson('custom.inquiries.inquiry-id'); ?> : <?php echo e($item->id); ?> )</h4>
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
                  <?php echo Form::label('visit_details',trans('custom.eforms.visit-details') ); ?>

                  <div class="input_field">
                    <?php
                      $enquire_visit_details = $item->visit_details;
                      if($enquire_visit_details){
                      $enquire_visit_value = $enquire_visit_details; 
                      }else{
                      $enquire_visit_value = null;
                      }
                    ?>

                    <?php echo Form::textarea('visit_details', $enquire_visit_value , ['class' => 'form-control', 'id'=>'visit_details', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.visit-details')]); ?>



                  </div>
                </div>

              </div>


              <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>