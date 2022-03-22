<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style>
  .req-formcontrol {
    padding: 9px 46px !important;
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

            <form class="" role="form" id="paymentstatus-totalamount-form" method="post">
              <div class="row clearfix">
                 <div class="input_field">  
                 <?php echo Form::label('amount_paid', ucwords(trans('custom.eforms.amount-paid')) ); ?>

                  <input type="number" id="amount_paid" min="0" name="amount_paid" class="form-control" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.amount-paid'); ?>" value="<?php echo e($item->amount_paid ?? '0'); ?>">
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