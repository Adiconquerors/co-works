<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style>
  .req-formcontrol {
    padding: 6px 46px !important;
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

            <form class="" role="form" id="update_status_form" method="post">
              <div class="row clearfix">
                <div class="col_half">
                  <?php echo Form::label('update_status',trans('custom.eforms.update-status') ); ?>


              <?php
                $update_status = array(
                  trans('others.rr') => trans('others.rr'),
                  trans('others.os') =>  trans('others.os'),
                  trans('others.vs') => trans('others.vs'),
                 
                );
              ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>

                    <select name="update_status" id="update_status" class="req-formcontrol">
                      <?php
                   foreach ($update_status as $id=>$assign)
                  {
                ?>

                      <option value="<?php echo e($assign); ?>" <?php echo e(( $item->update_status == $assign ) ? ' selected' : ''); ?>><?php echo e($assign); ?></option>

                      <?php } ?>
                    </select>



                  </div>
                </div>

              </div>

            <?php
              $update_status_user = Auth::user()->name;
              $created_at = $item->created_at;
              $updated_at = $item->updated_at;
            ?>
              <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="update_status_user" name="update_status_user" value="<?php echo e($update_status_user); ?>">
              <input type="hidden" id="update_status_created" name="update_status_created" value="<?php echo e($created_at); ?>">
              <input type="hidden" id="update_status_updated" name="update_status_updated" value="<?php echo e($updated_at); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>