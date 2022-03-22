    <style>
        .phmt{
            margin-top:-30px;
        }
        .sty-bsp{
        border:1px solid #dcdcdc; padding: 10px;
        }
        .sty-tc{
        text-align: center;
        }
    </style>
   <div class="row">
       <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $invoices = \App\Invoice::find( $item->invoice_id );
            $customers = \App\User::find( $invoices->customer_id );
            $inquiries = \App\Enquire::find( $invoices->property_id );
            $booking_initiated = json_decode($inquiries->booking_initiated, true);
            
            $properties = \App\Property::find( $booking_initiated["booking_initiated_property_id"] );

            $image = $properties ? $properties->cover_image : url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' );
          ?>
                <div class="col-lg-12 sty-bsp">
                    <div class="row">
                  
                         <div class="col-sm-3">
                            <label> <b><?php echo app('translator')->getFromJson('custom.paymenthistory.customer-name'); ?>:</b> <?php echo e($customers ? $customers->name : ''); ?></label> 
                         </div>
                          <div class="col-sm-3">
                              <label> <b><?php echo app('translator')->getFromJson('custom.paymenthistory.customer-number'); ?>:</b>  <?php echo e($customers ? $customers->mobile : ''); ?></label>
                          </div>
                            <div class="col-sm-3">
                                <label> <b><?php echo app('translator')->getFromJson('custom.paymenthistory.no-of-seats'); ?>:</b> <?php echo e($invoices ? $invoices->no_of_seats : ''); ?></label>
                            </div>
                           <div class="col-sm-3">
                                <label> <b><?php echo app('translator')->getFromJson('custom.paymenthistory.booking-months'); ?>:</b> <?php echo e($booking_initiated['booking_months'] ?? ''); ?></label>
                            </div>
                              
                          </div>
                    </div>
                   
                    
                     <div class="col-lg-12 sty-bsp">

                        <div class="property-card property-horizontal bg-white sty-bsp">
                            <div class="row">

                                <div class="col-sm-3 sty-tc">
                                    <div class="property-image" style="background: url('<?php echo e($image); ?>') center center / cover no-repeat; height:100%;">
                                         
                                    </div>
                                    <!-- <label> Virtual Office</label> --> 
                                </div>
                                <!-- /col 4 -->
                                <div class="col-sm-5 phmt">
                                    <div class="property">
                                        <div class="listingInfo">
                                            <ul>
                                             <li>  
                                               
                                             <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                   <?php echo app('translator')->getFromJson('custom.eforms.invoiceid'); ?> :  <span> <?php echo e($invoices->invoice_id); ?> </span>
                                              </li>
                                              

                                              <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                <?php echo app('translator')->getFromJson('custom.eforms.transactionid'); ?> :  <span> <?php echo e($item->transaction_id ?? ''); ?></span>
                                                </li>

                                                <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                                <?php if($properties->property_address): ?>
                                                  <?php echo app('translator')->getFromJson('custom.leads.address'); ?>: <b> <?php echo e($booking_initiated['description'] ?? ''); ?> in <?php echo e($properties ? $properties->property_address : ''); ?></b> 
                                                <?php endif; ?>  </li>

                                                <li>  
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        <?php echo app('translator')->getFromJson('custom.eforms.company'); ?> :   <b><?php echo e($properties ?  $properties->company : '-'); ?></b>
                                                 </li>

                                                  <li>  
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        <?php echo app('translator')->getFromJson('custom.eforms.currency'); ?> :  <b><?php echo e($item->customer ? $item->customer->currency->name : ''); ?></b>
                                                 </li>
                                   
                                                 <li>  

                                           <?php if($inquiries->booking_start_date): ?>
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>    
                                            <?php echo app('translator')->getFromJson('custom.eforms.startdate'); ?> :  <span> <?php echo e($inquiries->booking_start_date ?? ''); ?></span>
                                            <?php endif; ?>
                                            </li>

                                            <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                            <?php echo app('translator')->getFromJson('custom.eforms.payment-method'); ?> :  <span> <?php echo e($item->paymentmethod); ?></span>
                                            </li>

                                            <li>  <i class="fa fa-angle-right" aria-hidden="true"></i>

                                            <?php echo app('translator')->getFromJson('custom.eforms.payment-status'); ?> : <span> <?php echo e($item->paymentstatus); ?></span>
                                            </li>

                                            </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                                 
                                <!-- /col 8 -->
                               
                                <!-- /col 4 -->
                                <div class="col-sm-4">
                                    <div class="property-content">
                                   

                                  <?php
                                    $amount = $item->amount;
                                  ?>

                                        <a href="javascript:void(0);" class="btn btn-medium-dark group-width mmt-10">
                                            <?php echo e(digiCurrency($amount , $item->currency_id)); ?>

                                        </a>
                                         <a href="<?php echo e(route('invoices.invoicepdf', $item->id)); ?>" class="btn invo-btn group-width mmt-10">
                                            <i class="fa fa-download" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('custom.paymenthistory.download-invoice'); ?>
                                        </a>
                                        
                                    </div>
                                </div>

                                <!-- /col 8 -->
                            </div>

                            </div>
                            <!-- /inner row -->
                        </div>
                        <!-- End property item -->


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                       
                    </div>
               
                <!-- end row -->