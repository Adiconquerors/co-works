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
            <form class="" role="form" id="seeker_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  <?php echo Form::label('name',trans('custom.eforms.name') ); ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="seeker_name" name="seeker_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.name'); ?>" value="<?php echo e($item->name); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('email',trans('custom.eforms.email') ); ?>

                  <div class="input_field">
                    <span>
                      <i aria-hidden="true" class="fa fa-envelope"></i>
                    </span>
                    <input type="email" name="seeker_email" id="seeker_email" value="<?php echo e($item->email); ?>" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.email'); ?>" />
                  </div>
                </div>
                <div class="col_half">
                  <?php echo Form::label('phone_number',trans('custom.eforms.mobile')); ?>

                  <div class="input_field">
                    <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="seeker_phone_number" value="<?php echo e($item->phone_number); ?>" id="seeker_phone_number" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.mobile'); ?>" />
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