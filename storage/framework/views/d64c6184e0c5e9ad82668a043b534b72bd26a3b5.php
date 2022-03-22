<style>
  .sty-p{
    padding: 0px 150px 0px 150px;
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

      $inquiries = \App\Enquire::find( $item->property_id );
      $booking_initiated = json_decode($inquiries->booking_initiated, true);
      
      
      $customer = \App\User::find( $booking_initiated['customer_id'] ?? '');

      $property = \App\Property::find( $booking_initiated['booking_initiated_property_id'] ?? '' );

      $property_sub_space_types = $property->property_sub_space_types;

     $image = $property ? $property->cover_image : url( PUBLIC_ASSETS . 'images/default-imgs/1.jpg' );
    ?>

    <div class="col-lg-12 btongrid" >
        <div class="row">
             <div class="col-sm-3">
                <p>  <?php echo app('translator')->getFromJson('custom.paymenthistory.customer-name'); ?> <text> <?php echo e($customer ? $customer->name : ''); ?> </text> </p> 
             </div>
              <div class="col-sm-3">
                  <p>  <?php echo app('translator')->getFromJson('custom.paymenthistory.customer-number'); ?> <text>  <?php echo e($customer ? $customer->mobile : ''); ?> </text> </p>
              </div>
                <div class="col-sm-2">
                    <p>  <?php echo app('translator')->getFromJson('custom.paymenthistory.no-of-seats'); ?> <text> <?php echo e($booking_initiated['no_of_seats'] ?? ''); ?> </text> </p>
                </div>
                  <div class="col-sm-4">
                    <p>  <?php echo app('translator')->getFromJson('custom.paymenthistory.booking-months'); ?> <text> <?php echo e($booking_initiated['booking_months'] ?? ''); ?> </text> </p>
                </div>
                  
              </div>
    </div>
    <br><br>
    
     <div class="col-lg-12 " >
        <div class="property-card property-horizontal bg-white sty-bsp">
            <div class="row">
                <div class="col-sm-3 sty-tc" >
                    <div class="property-image" style="background: url('<?php echo e($image); ?>') center center / cover no-repeat;">
                         
                    </div>
                
                </div>
                <!-- /col 4 -->
                <div class="col-sm-5">
                    <div class="property-content">
                        <div class="listingInfo">
                            <div class="">
                             
                               <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                      <?php if($property->property_address): ?>
                                        <?php echo e($booking_initiated['description'] ?? ''); ?> in <?php echo e($property ? $property->property_address : ''); ?> 
                                        <?php endif; ?>
                                    </a>


                                </h4>
                                <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                         <?php echo e($property ?  $property->company : '-'); ?>

                                    </a>


                                </h4>
                                  <h4>
                                    <a href="javascript:void(0);" class="text-dark property-lab">
                                         <?php echo e($property ?  $property->property_manager_name : '-'); ?>

                                    </a>


                                </h4>
                                <p class="font-13 text-muted">
                                  <?php if($inquiries->booking_start_date): ?>  
                                   <?php echo app('translator')->getFromJson('custom.postrequirement.start_date'); ?> <?php echo e($inquiries->booking_start_date ?? ''); ?>

                                  <?php endif; ?>
                                </p>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /col 8 -->
               
                <!-- /col 4 -->
                <div class="col-sm-4">
                    <div class="property-content">
                    
                      <?php if( isAdmin() ): ?>

                        <a href="#loadingModal" data-toggle="modal" data-remote="false"  data-action="invoice-payment-pay" data-invoice_id="<?php echo e($item->id); ?>" class="btn btn-medium-dark mmt-10 sendBill">
                            <?php echo e(digiCurrency($item->total_amount , $item->currency_id)); ?> (<?php echo app('translator')->getFromJson('custom.paymenthistory.tax-incl'); ?>.)
                        </a>
                        <?php elseif( isCustomer() ): ?>
                            <a href="<?php echo e(route('unpaidinvoice.show',$item->id)); ?>" class="btn btn-medium-dark mmt-10">
                            <?php echo e(digiCurrency($item->total_amount , $item->currency_id)); ?> (<?php echo app('translator')->getFromJson('custom.paymenthistory.tax-incl'); ?>.)
                        </a>
                        <?php endif; ?>
                       

                        <?php if( isAdmin() ): ?>
                         <a href="javascript:void(0);" class="mmt-10">
                            <?php echo Form::open([
                            'method'=>'delete',
                            'route' =>['unpaid-invoices.destroy', $item->id],
                            'onclick'=>'return checkDelete();'
                            ]); ?>

                            <button type="submit" class="btn btn-medium-dark">
                            <?php echo app('translator')->getFromJson('custom.paymenthistory.remove-invoice'); ?>
                            </button>
                             <?php echo Form::close(); ?>

                        </a>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <!-- /col 8 -->
            </div>
            <!-- /inner row -->
        </div>
        <!-- End property item -->


       
       
    </div>
    <!--END MAIN COL-8 -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- end row -->

<?php echo $__env->make('admin.common.delete-script',['unpaid-invoices.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

        <div>
            <ul class="pagination pagination-split justify-content-end">
               <?php echo e($items->links()); ?>

            </ul>
        </div>