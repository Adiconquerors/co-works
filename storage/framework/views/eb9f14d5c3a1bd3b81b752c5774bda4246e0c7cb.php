<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="modal-header">
  <h4 class="modal-title">  <?php echo app('translator')->getFromJson('custom.bookings.payment-for-invoice-id'); ?> : <?php echo e($item->invoice_id); ?> </h4>
  <?php
    $customers = \App\User::find( $item->customer_id );
  ?>

  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">
          <div class="">
            <form class="" role="form" id="payment_form" method="POST">
              <div class="row clearfix">
                <div class="col_half"> <?php echo Form::label('customer_name',trans('custom.bookings.customer-name') ); ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="customer_name" id="customer_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.name'); ?>" value="<?php echo e($customers ? $customers->name : ''); ?>" disabled> </div>
                </div>
                <input type="hidden" id="customer_name" name="customer_name" value="<?php echo e($customers ? $customers->name : ''); ?>">
                <div class="col_half"> <?php echo Form::label('customer_email',trans('custom.bookings.customer-email') ); ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="customer_email" id="customer_email" value="<?php echo e($customers ? $customers->email : ''); ?>" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.email'); ?>" disabled> </div>
                </div>
                <input type="hidden" id="customer_email" name="customer_email" value="<?php echo e($customers ? $customers->email : ''); ?>">
                <div class="col_half"> <?php echo Form::label('customer_mobile',trans('custom.bookings.customer-mobile') ); ?>

                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="customer_mobile" value="<?php echo e($customers ? $customers->mobile : ''); ?>" id="customer_mobile" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.mobile'); ?>" disabled> </div>
                </div>
                <input type="hidden" id="customer_mobile" name="customer_mobile" value="<?php echo e($customers ? $customers->name : ''); ?>">
                  <?php
                    $inquiries = \App\Enquire::find($item->property_id);
                    $booking_initiated = json_decode($inquiries->booking_initiated, true);
                  ?>
                  <div class="col_half"> 
                    <?php echo Form::label('company_name',trans('custom.bookings.company-name') ); ?>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                      <input type="text" name="company_name" id="company_name" value="<?php echo e($inquiries ? $inquiries->company : ''); ?>" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.mobile'); ?>" disabled> </div>
                  </div>
                  <input type="hidden" id="company_name" name="company_name" value="<?php echo e($inquiries ? $inquiries->company : ''); ?>">
                  <div class="col_half"> 
                    <?php echo Form::label('no_of_seats',trans('custom.bookings.no-of-seats') ); ?>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                      <input type="text" name="no_of_seats" value="<?php echo e($item->no_of_seats ?? ''); ?>" id="no_of_seats" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.no-of-seats'); ?>" disabled> </div>
                  </div>
                   <div class="col_half"> 
                    <?php echo Form::label('transaction_id',trans('custom.bookings.transaction-id') ); ?>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-money"></i></span>
                      <input type="text" name="transaction_id" value="" id="transaction_id" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.payment-transactionid'); ?>"> </div>
                  </div>

                  <input type="hidden" id="no_of_seats" name="no_of_seats" value="<?php echo e($item->no_of_seats); ?>">
                  <div class="col_half"> 
                    <?php echo Form::label('total_amount',trans('custom.bookings.total-amount') ); ?>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-money"></i></span>
                      <input type="text" name="total_amount" value="<?php echo e($item->total_amount ?? ''); ?>" id="total_amount" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.amount'); ?>" disabled> </div>
                  </div>
                  <input type="hidden" id="total_amount" name="total_amount" value="<?php echo e($item->total_amount); ?>">
                  <input type="hidden" id="invoice_action" name="invoice_action" value="<?php echo e($item->action); ?>">
                  <input type="hidden" id="property_id" name="property_id" value="<?php echo e($item->property_id); ?>">
                  <input type="hidden" id="amount" name="amount" value="<?php echo e($item->amount ?? ''); ?>">
                  <input type="hidden" id="gstin" name="gstin" value="<?php echo e($item->gstin ?? ''); ?>">
                  <br/> </div>
              <div class="input_field"> </div>
              <br/>
              <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>"> </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>