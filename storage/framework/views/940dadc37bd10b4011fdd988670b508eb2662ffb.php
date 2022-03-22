<?php $__env->startSection( 'new_admin_head_links' ); ?>
<?php echo $__env->make( 'partials.newadmin.common.datatables.datatables-head-links' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<style>
.pymesucess ul {
    padding: 0;
    margin: 25px 0 0;
}
.pymesucess li {
    list-style: none;
    float: left;
    width: 50%;
    text-align: left;
    padding: 5px;
}
.pymesucess li span {
    color: #333;
    font-weight: bold;
    padding-left: 10px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('global.orders.payments.title'); ?></h3>
    
    <div class="panel-body packages">
        <div class="row">
         
          <div class="col-xl-10 col-12 offset-xl-1"> 
          <div class="card pymesucess">
          <div class="card-body">
            <i class="fa fa-thumbs-up fa-5x" aria-hidden="true"></i>
            
            <h1> <?php echo app('translator')->getFromJson('custom.payments.success'); ?> </h1>

            <?php
                $invoices = \App\Invoice::find( $item->invoice_id );        
            ?>

            <ul>
                <li>
                     <i class="fa fa-check" aria-hidden="true"></i>   <?php echo app('translator')->getFromJson('global.eforms.transactionid'); ?> <span> <?php echo e($item->transaction_id); ?></span>
                </li>
                <li>
                       <i class="fa fa-check" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('global.eforms.invoice-number'); ?> <span> <?php echo e($invoices ? $invoices->invoice_id : ''); ?></span>
                </li>
                   
                  <li>
                      <i class="fa fa-check" aria-hidden="true"></i>  <?php echo app('translator')->getFromJson('global.eforms.currency'); ?> <span> <?php echo e(digiCurrency( $item->amount )); ?></span>
                </li>
                
                <li>
                      <i class="fa fa-check" aria-hidden="true"></i>  <?php echo app('translator')->getFromJson('global.eforms.payment-method'); ?> <span> <?php echo e($item->paymentmethod ?? ''); ?></span>
                </li>

                <li>
                       <i class="fa fa-check" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('global.eforms.payment-status'); ?><span> <?php echo e($item->paymentstatus); ?></span>
                </li>   

            </ul>

           
</div></div>
          </div>

        

        </div>
   
               
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>