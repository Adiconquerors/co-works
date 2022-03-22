  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   <style>
  .sty-dn{
    display:none;
  }
</style>

  <?php
     $company = $item->company ?? '';
  ?>

  <div class="modal-header">
    <h4 class="modal-title"><?php echo e($template->title); ?> ( <?php echo app('translator')->getFromJson('custom.inquiries.inquiry-id'); ?> : <?php echo e($item->id); ?> )</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>

  <div class="modal-body">
    <div class="form_wrapper">
      <div class="form_container">
        <div class="row clearfix">
          <div class="">

            <form class="" role="form" id="tax_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  <?php echo Form::label('toname', ucwords(trans('custom.eforms.name')) ); ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="toname" name="toname" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.name'); ?>" value="" />
                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('toemail', ucwords(trans('custom.eforms.toemail')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="toemail" id="toemail" value="" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.email'); ?>" />
                  </div>
                </div>
                <div class="col_half">
                  <?php echo Form::label('mail_mobile', ucwords(trans('custom.eforms.mobile')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="mail_mobile" value="" id="mail_mobile" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.mobile'); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('ccname', ucwords(trans('custom.eforms.ccemail')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" id="ccemail" name="ccemail" value="" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.ccemail'); ?>">
                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('no_of_seats', ucwords(trans('custom.eforms.no-of-seats')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fas fa-chair"></i></span>
                    <input type="text" name="no_of_seats" id="no_of_seats" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.no-of-seats'); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <?php echo Form::label('invoice_amount', ucwords(trans('custom.eforms.amount')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-inr"></i></span>
                    <input type="text" id="invoice_amount" name="invoice_amount" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.amount'); ?>" value="" />
                  </div>
                </div>

              </div>

              <div class="input_field">
                <?php echo Form::label('mail_description', ucwords(trans('custom.eforms.description')) ); ?> 
                <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.description'); ?>" />
              </div>

              <div class="sty-dn">
                <textarea class="summernote" rows="3" name="message" id="message"><?php echo e($template->content); ?></textarea>
              </div>

              <label><?php echo app('translator')->getFromJson('custom.eforms.company-details'); ?></label>
              <div class="row clearfix">
               <div class="col_quarter">
                <?php echo Form::label('company_address', ucwords(trans('custom.eforms.company-address')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                    <input type="text" value="" name="company_address" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.company-address'); ?>" id="company_address" />
                  </div>
                </div>
                
                  <div class="col_quarter">
                     <?php echo Form::label('company_name', ucwords(trans('custom.eforms.company-name')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-building"></i></span>
                    <input type="text" value="" name="company_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.company-name'); ?>" id="company_name" />
                  </div>
                </div>

                <div class="col_quarter">
                  <?php echo Form::label('gstin_number', ucwords(trans('custom.eforms.gstin-num')) ); ?> 
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-globe"></i></span>
                    <input type="text" value="" name="gstin_number" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.gstin-num'); ?>" id="gstin_number"/>
                  </div>
                </div> 

                <div class="col_quarter">
                  <?php echo Form::label('invoice_gstin', ucwords(trans('custom.eforms.gst')) ); ?> 
                  <div class="input_field">
                    <input type="text" name="invoice_gstin" value="18" id="invoice_gstin" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.gst'); ?>" />
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