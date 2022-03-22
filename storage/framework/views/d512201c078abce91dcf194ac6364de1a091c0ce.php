<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
 <style>
  .sty-dn{
    display:none;
  }
 </style> 

<div class="modal-header">
  <h4 class="modal-title"><?php echo e($template->title); ?> ( <?php echo app('translator')->getFromJson('custom.inquiries.inquiry-id'); ?> : <?php echo e($item->id); ?> )</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">

          <div class="">

            <form class="" role="form" id="mail_message_form" method="post">
              <div class="row clearfix">


                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="toemail" id="toemail" value="<?php echo e($item->email); ?>" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.email'); ?>" />
                  </div>
                </div>

                <div class="input_field">
                  <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.description'); ?>" />
                </div>


              </div>



              <div class="sty-dn">
                <textarea class="summernote" rows="3" name="message" id="message"><?php echo e($template->content); ?></textarea>
              </div>


              <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="customer_id" name="customer_id" value="<?php echo e($item->customer_id); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>