    <style>
      .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
      }
      .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
      }
      .bbc{
        cursor: pointer;
         border:0px;
         background: #3ac9d6 !important;
      }
       .maintainht { 
            width: 430px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dtr-title{
          text-decoration: underline !important;
        }
    table.dataTable>tbody>tr.child ul li {
    border-bottom: 1px solid #efefef;
    padding: 0.5em 0;
    overflow: auto;
    text-align: left!important;
   }
   .greeen {
    color: green;
    padding-right: 5px!important;
    }
    .gradeX button {
    border: none!important;
    background: no-repeat;
    color: #000!important;
}
.actions-seeker a, .table-collapse a {
    color: #ADADAD;
    padding: 0px!important;
}
li.maintainht.text-center {
    text-align: left!important;
}
    </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse table-scroller" id="">
          <thead>
            <tr class="empty-background">
              <?php if( isAdmin() || isAgent() ): ?>
              <th><?php echo app('translator')->getFromJson('custom.inquiries.sno'); ?></th>
              <?php endif; ?>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.status'); ?></th>
              <?php if( isAdmin() || isAgent() ): ?>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.assigned-to'); ?></th>
              <?php endif; ?>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.seeker-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.provider-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.booking-details'); ?></th>
             <?php if( isAdmin() ): ?>
              <th>
                <?php echo app('translator')->getFromJson('custom.dealtracker.st-revenue-generated-payment-mode'); ?> 
              </th>
              <th>
              	<?php echo app('translator')->getFromJson('custom.dealtracker.payment-status-total-amount'); ?>
              </th>
              
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.proforma-and-tax'); ?></th>
              
              <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
            <?php endif; ?>
             
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $booking_initiated = json_decode( $item->booking_initiated , true );

                 $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');

                $property_owner   = \App\User::find($booking_property_details["customer_id"] ?? '');

                 $assigned_to_users = \App\User::find($item->assigned_to);

                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? ''); 
              ?>
            <tr class="gradeX" id="gradex_<?php echo e($item->id); ?>">
             <?php if( isAdmin() || isAgent() ): ?> 
              <td>
                <ul>                  
                 
                  <li><label><?php echo e($item->id); ?></label></li>
               </td>
              <?php endif; ?>   
               <td>
                  <li>

                    <li><label><?php echo e($booking_initiated["action"] ?? ''); ?></label></li>
                    <p>
                      <span class="updated-date">
                        <?php echo app('translator')->getFromJson('custom.dealtracker.updated-on'); ?>: <?php echo e($item->updated_at->format('M d , Y')); ?>

                      </span>
                    </p>
                  </li>
              </td>
               <?php if( isAdmin() || isAgent() ): ?>
               <td>
                 <?php if( $item->assigned_to == 0 ): ?>
                    <?php
                    $not_assigned = "Not Assigned";
                    ?>
                    <?php echo e($not_assigned); ?>

                  <?php else: ?>
                    <?php echo e($assigned_to_users ? $assigned_to_users->name : $not_assigned); ?>

                  <?php endif; ?>

                <?php if( isAdmin() ): ?>   
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="assigned-details-ign" data-enquiry_id="<?php echo e($item->id); ?>">
                  <i class="fas fa-pencil-alt"></i>
                </a>
               <?php endif; ?> 

              </td>
             <?php endif; ?> 
              <td>
                <ul>
                  <li>

                    <p class="text-dark text-left"><?php echo e($booking_user_details ? $booking_user_details->name : '-'); ?></p>
                  </li>

                  <li><a href="javascript:void(0);"><?php echo e($booking_user_details ? $booking_user_details->email : '-'); ?></a></li>
                  <li>
                    <label>
                      <?php echo e($booking_user_details ? $booking_user_details->company : 'x'); ?>

                      
                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> <?php echo e($booking_user_details ? $booking_user_details->mobile : '-'); ?>

                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      <?php echo app('translator')->getFromJson('custom.dealtracker.created-on'); ?>: <?php echo e($item->created_at->format('M d , Y')); ?>

                    </span>
                  </li>

                </ul>
              </td>
              <!-- provider details -->

              <td>
                <ul>
                  <li>
                    <p class="text-dark text-left"><?php echo e($booking_property_details ? $booking_property_details->property_manager_name : '-'); ?></p>
                  </li>
                  <li><a href="javascript:void(0);"><?php echo e($booking_property_details ? $booking_property_details->property_manager_email : '-'); ?></a></li>

                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> <?php echo e($booking_property_details ? $booking_property_details->property_manager_number : '-'); ?>

                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>


                </ul>
              </td>

              <!-- end provider details -->
             <!-- booking details --> 
              <td>

                <li class="maintainht text-center" title="<?php echo e($booking_property_details ? $booking_property_details->property_address : '-'); ?>">
                  <b class="text-dark"> <?php echo app('translator')->getFromJson('custom.dealtracker.booking-for'); ?>:</b>
                  <span><?php echo e($booking_property_details ? $booking_property_details->property_address : '-'); ?></span>
                </li>

                
                <li>
                  <label>
                    <span class="greeen"><?php echo app('translator')->getFromJson('custom.dealtracker.seats'); ?>: </span>
                  </label>
                  <?php echo e($booking_initiated["no_of_seats"] ?? ''); ?>

                </li>
                <li>
                  <label>
                    <span class="greeen"><?php echo app('translator')->getFromJson('custom.inquiries.booking-amount'); ?>: </span>
                  </label>
                  <?php echo e($booking_initiated["booking_amount"] ?? ''); ?>

                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="#" class="on-editing edit-row"></a>
                  </span>  
                </li>
              

                <li>
                  <b class="text-dark"><?php echo app('translator')->getFromJson('custom.dealtracker.booking-months'); ?>:</b>
                  <span><?php echo e($booking_initiated["booking_months"] ?? ''); ?></span>
                </li>
              </td>
              <!-- End booking details -->

             <?php if( isAdmin() ): ?> 
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="bookingstart-date-dat" data-enquiry_id="<?php echo e($item->id); ?>">
                  <button id="start-date-add" class="bbc">
                     <?php echo app('translator')->getFromJson('custom.dealtracker.add'); ?>
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br/>
                <li>
                  <div class="show-line address-part">
                   <b class="text-dark"> <?php echo app('translator')->getFromJson('custom.dealtracker.start-date'); ?> :</b>
                    <?php echo e($item->booking_start_date ? $item->booking_start_date.'(Y-M-D)' : '-'); ?></div>
                </li>
                <li>
                  <div class="show-line address-part"><b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.revenue-generated'); ?> :</b> <?php echo e($item->revenue_generated ?? '-'); ?></div>
                </li>
             
                <li>
                  <div class="show-line address-part"><b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.payment-mode'); ?> :</b> <?php echo e($item->payment_mode ?? '-'); ?></div>
                </li>
              </td>

              <?php
                if( $item->payment_status == "unpaid"){
                  $payment_status_color = "red";
                }else{
                  $payment_status_color = "greeen";
                } 
              ?>
             <!-- Payment Status --> 
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="paymentstatus-totalamount-psa" data-enquiry_id="<?php echo e($item->id); ?>">
                  <button id="start-date-add" class="bbc">
                     <?php echo app('translator')->getFromJson('custom.dealtracker.add'); ?>
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                
                <li>
                   <label>
                    <b class="text-dark"><?php echo app('translator')->getFromJson('custom.dealtracker.payment-status'); ?> :</b>
                  <?php
                    $ap = $item->amount_paid;
                    $revenue = $item->revenue_generated;
                  ?>
                   <?php if( $ap > 0 ): ?>
                       <?php
                          $difference = $item->revenue_generated - $item->amount_paid;
                       ?>
                       <?php if($difference == 0 || $difference < 0): ?>
                          <?php
                            $payment_status = $item->payment_status = 'paid';
                            $payment_status_color = 'greeen';
                          ?>

                           <span class="<?php echo e($payment_status_color); ?>"> 
                            <?php echo e(ucfirst($payment_status)); ?>

                          </span>
                          <br/>
                          <b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.unpaid-amount'); ?> :</b> <?php echo e($item->revenue_generated - $item->amount_paid); ?>

                           <?php else: ?>

                            <?php
                            $payment_status = $item->payment_status = 'unpaid';
                            $payment_status_color = 'red';
                           ?>

                             <span class="<?php echo e($payment_status_color); ?>"> 
                            <?php echo e(ucfirst($payment_status)); ?>

                          </span>
                          <br/>
                          <b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.unpaid-amount'); ?> :</b> <?php echo e($item->revenue_generated - $item->amount_paid); ?> 

                      <?php endif; ?>
                   <?php else: ?>

                    <span class="<?php echo e($payment_status_color); ?>"> 
                      <?php echo e(ucfirst($item->payment_status)); ?>

                    </span>
                    <br/>
                    <b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.unpaid-amount'); ?> :</b> <?php echo e($item->revenue_generated - $item->amount_paid); ?>

                   <?php endif; ?>  
                  </label>
                </li>
               

               <li>
                   <label>
                    <b class="text-dark"><?php echo app('translator')->getFromJson('custom.eforms.revenue-generated'); ?> / <?php echo app('translator')->getFromJson('custom.dealtracker.amount-paid'); ?> :</b>
                     <span class="red"> <?php echo e($item->revenue_generated ?? '0'); ?>

                     </span> / 
                     <span class="greeen"> 
                     <?php echo e($item->amount_paid ?? '0'); ?> 
                   </span>
                    
                  </label>
                </li>
               
              </td>
              <!-- End Payment Status -->

              
              <td>
                  <b class="text-dark"><br/><?php echo app('translator')->getFromJson('custom.dealtracker.proforma-sent'); ?> :</b> <?php echo e(ucfirst($item->raise_proforma_sent)); ?><br/>
                  <b class="text-dark"><?php echo app('translator')->getFromJson('custom.dealtracker.tax-invoice-sent'); ?> :</b> <?php echo e(ucfirst($item->tax_invoice_sent)); ?>

              </td>
              
                 <td class="actions">

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="raise-proforma-invoice-per" data-enquiry_id="<?php echo e($item->id); ?>"><?php echo app('translator')->getFromJson('custom.dealtracker.raise-proforma-invoice'); ?></a>
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="raise-tax-invoice-tax" data-enquiry_id="<?php echo e($item->id); ?>"><?php echo app('translator')->getFromJson('custom.dealtracker.raise-tax-invoice'); ?></a>
                    </li>

                    <li>
                       <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['dealtracker.dealspaid','id' => $item->id]

                        ]); ?>


                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                          <?php echo app('translator')->getFromJson('custom.dealtracker.paid'); ?>
                       </button>

                        <?php echo Form::close(); ?>

                    </li>

                        <li>
                       <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['dealtracker.dealsunpaid','id' => $item->id]

                        ]); ?>


                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                          <?php echo app('translator')->getFromJson('custom.dealtracker.unpaid'); ?>
                       </button>

                        <?php echo Form::close(); ?>

                    </li>
                  </ul>
                </div>
                <!-- end test -->
              </td>
             <?php endif; ?> 
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </tbody>

        </table>

      </div>
