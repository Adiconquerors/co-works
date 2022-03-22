    <style>
      .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
      }
      .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
      }
      .table.dataTable{
        width:100% !important;
      }
      .actions-seeker a, .table-collapse a {
       color: #ADADAD;
       padding: 0px!important;
      }
      .actions-seeker{
        padding-right: 6px;
      }
    </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="">
          <thead>
            <tr class="empty-background">
              <th><?php echo app('translator')->getFromJson('custom.inquiries.sno'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.status'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.seeker-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.provider-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.booking-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.inquiries.visit-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.inquiries.comments'); ?></th>
              <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
              
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $booking_initiated = json_decode( $item->booking_initiated , true );
                $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');
                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? '' ); 
              ?>
            <tr class="gradeX" id="gradex_<?php echo e($item->id); ?>">

               <td>
                <ul>                  
                 
                  <li><label><?php echo e($item->id); ?></label></li>
              </td>

              <td>
                <ul>                  
                 
                  <li><label><?php echo e($booking_initiated["action"] ?? ''); ?></label></li>

                  <li>
                    <p>
                      <span class="updated-date">
                        <?php echo app('translator')->getFromJson('custom.dealtracker.updated-on'); ?> <?php echo e($item->updated_at->format('M d , Y')); ?>

                      </span>
                    </p>
                  </li>
                 
              </td>
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
                      <?php echo app('translator')->getFromJson('custom.dealtracker.created-on'); ?> <?php echo e($item->created_at->format('M d , Y')); ?>

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
              <td>
                <li class="text-left">
                  <p class="text-dark "><?php echo app('translator')->getFromJson('custom.dealtracker.booking-for'); ?></p>
                  <div class="address-part"><?php echo e($booking_property_details ? $booking_property_details->property_address : '-'); ?></div>
                </li>
                <li>
                  <label>
                    <span class="greeen"><?php echo app('translator')->getFromJson('custom.dealtracker.seats'); ?> </span>
                  </label>
                  <?php echo e($booking_initiated["no_of_seats"] ?? ''); ?>

                </li>
                 <li>
                  <label>
                    <span class="greeen"><?php echo app('translator')->getFromJson('custom.dealtracker.booking-amount'); ?> </span>
                  </label>
                  <?php echo e($booking_initiated["booking_amount"] ?? ''); ?>

                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="#" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark"><?php echo app('translator')->getFromJson('custom.dealtracker.booking-date'); ?></p>
                  <div class="address-part"><?php echo e($booking_initiated["booking_date"] ?? ''); ?></div>
                </li>
                <li>
                  <span class="actions-seeker">
                    <a href="javascript:void(0);" class="on-editing edit-row"></a>
                  </span>
                  <p class="text-dark"><?php echo app('translator')->getFromJson('custom.dealtracker.booking-months'); ?></p>
                  <div class="address-part"><?php echo e($booking_initiated["booking_months"] ?? ''); ?></div>
                </li>

              </td>
              <td>
                <?php echo e($item->visit_details ?? ''); ?>

              </td>
             <td>
              <?php echo e($item->comments ?? '-'); ?>

             </td>

                <!--end assigned to -->
              <td class="actions">

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="deal-lost-del" data-enquiry_id="<?php echo e($item->id); ?>"><?php echo app('translator')->getFromJson('custom.inquiries.deal-lost'); ?></a>
                    </li>

                    <li>
                       <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['enquiries.dealcompleted','id' => $item->id]

                        ]); ?>


                       <button type="submit" class="dropdown-item cursor-pointer-hand">
                        <?php echo app('translator')->getFromJson('custom.dealtracker.deal-completed'); ?>
                       </button>

                        <?php echo Form::close(); ?>

                    </li>


                  </ul>
                </div>

                <!-- end test -->

              </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </tbody>

        </table>

      </div>