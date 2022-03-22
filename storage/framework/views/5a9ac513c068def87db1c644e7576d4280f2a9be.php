<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style>
  .req-formcontrol {
    padding: 4px 36px !important;
  }
</style>

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

            <form class="" role="form" id="deal_lost_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  <?php echo Form::label('deal_lost', trans('custom.eforms.deal-lost') ); ?>


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

                    <select name="deal_lost" id="deal_lost" class="req-formcontrol" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.please-select'); ?>">
                      <?php
                   foreach ($deal_lost as $id=>$assign)
                  {
                ?>

                      <option value="<?php echo e($id); ?>" <?php echo e(( $item->deal_lost == $id ) ? ' selected' : ''); ?>><?php echo e($assign); ?></option>

                      <?php } ?>
                    </select>

                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('deal_comments',trans('custom.eforms.comments') ); ?>

                  <div class="input_field">
                    <?php
                    $deal_comments = $item->deal_comments;
                    if($deal_comments){
                      $deal_comments_value = $deal_comments; 
                    }else{
                      $deal_comments_value = null;
                    }
                  ?>

                    <?php echo Form::textarea('deal_comments', $deal_comments_value , ['class' => 'form-control', 'id'=>'deal_comments', 'rows'=>'4', 'cols'=>'100', 'placeholder' => trans('custom.eforms.enter-comments')]); ?>



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