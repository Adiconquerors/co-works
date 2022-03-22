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

            <form class="" role="form" id="comments_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  <?php echo Form::label('comments','Comments' ); ?>

                  <div class="input_field">
                    <?php
                      $enquire_comments = $item->comments;
                      if($enquire_comments){
                      $enquire_comments_value = $enquire_comments; 
                      }else{
                      $enquire_comments_value = null;
                      }
                    ?>

                    <?php echo Form::textarea('comments', $enquire_comments_value , ['class' => 'form-control', 'id'=>'comments', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.enter-comments')]); ?>



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