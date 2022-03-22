      <style>
        .table-collapse{
          border-collapse: collapse; border-spacing: 0; width: 100%;
        }
      </style>
      <div class="">
        <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable">
          <thead>
            <tr class="empty-background">
              <th><?php echo app('translator')->getFromJson('custom.invoicepdf.company-name'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.clients.occupant-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.dealtracker.provider-details'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.invoicepdf.no-of-seats'); ?></th>
              <th><?php echo app('translator')->getFromJson('custom.clients.duration-months-booking-amount'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $booking_initiated = json_decode( $item->booking_initiated , true );

                 $booking_property_details = \App\Property::find($booking_initiated["booking_initiated_property_id"] ?? '');

                $property_owner   = \App\User::find($booking_property_details["customer_id"] ?? '');

                $booking_user_details = \App\User::find( $booking_initiated["customer_id"] ?? ''); 
              ?>
            <tr class="gradeX" id="gradex">
              <td>
                <?php echo e($item->company ?? ''); ?>

              </td>

              <!-- occupant details -->
          <td>
                <ul>
                  <li>

                    <p class="text-dark text-left"><?php echo e($booking_user_details ? $booking_user_details->name : '-'); ?></p>
                  </li>

                  <li><a href="javascript:void(0);"><?php echo e($booking_user_details ? $booking_user_details->email : '-'); ?></a></li>
                  <li>
                    <label>
                      <?php echo e($booking_user_details ? $booking_user_details->company : trans('custom.cross_mark')); ?>

                      
                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fa fa-mobile-alt"></i> <?php echo e($booking_user_details ? $booking_user_details->mobile : '-'); ?>

                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      <?php echo app('translator')->getFromJson('custom.clients.created-on'); ?> <?php echo e($item->created_at->format('M d , Y')); ?>

                    </span>
                  </li>

                </ul>
              </td>
              <!-- end occupant details -->
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
                        <i class="fa fa-mobile-alt"></i> <?php echo e($booking_property_details ? $booking_property_details->property_manager_number : '-'); ?>

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
                  <?php echo e($booking_initiated["no_of_seats"] ?? ''); ?>

              </td>
              <!-- end details -->
              <td>
                  <?php echo app('translator')->getFromJson('custom.clients.start-date'); ?> <?php echo e($item->booking_start_date ?? ''); ?><br/>
                   <?php echo app('translator')->getFromJson('custom.clients.booking-months'); ?>
                  <?php echo e($booking_initiated["booking_months"] ?? ''); ?><br/>
                  <?php echo app('translator')->getFromJson('custom.clients.booking-amt'); ?> <?php echo e($booking_initiated["booking_amount"] ?? ''); ?>

              </td>

         
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>