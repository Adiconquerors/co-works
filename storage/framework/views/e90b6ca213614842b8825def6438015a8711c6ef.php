      <style>
        .table-collapse {
        border-collapse: collapse; border-spacing: 0; width: 100%;
        }
        .cursor-pointer-hand{
        cursor: pointer;padding-left: 20px;
        }
        .modal-margin-sty{
        margin-top:200px;
        }
        .md-sty-inline{
        display: inline;
        }
        .form-enquiry-margin{
        margin-left: 60px;
        }
        .maintainht { 
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .junkleadsty{
          padding: 6px 20px !important;
          color: #333 !important;
          border: none !important;
        }
      </style>
    

    <div class="">
        <table class="table double table-striped table-bordered dt-responsive nowrap td_m table-collapse table-scroller table-responsive" id="" >
          <thead>
            <tr class="empty-background">
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.sno'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.status'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.seeker-details'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.requirement-details'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.updated-status'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.visit-details'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.remarks-comments'); ?></th>
              <th> <?php echo app('translator')->getFromJson('custom.inquiries.assigned-to'); ?></th>
              <th> <?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
               $item_flag_color = $item->flag_color;
               $property_id = $item->property_id ?? '';
                $property = \App\Property::find( $property_id );
                $property_sub_space_types = $property->property_sub_space_types ?? '';
                $assigned_to_users = \App\User::find($item->assigned_to);
                $agents = \App\User::find($property->agent_id);
              ?>
            <tr class="gradeX" id="gradex_<?php echo e($item->id); ?>" style="background: <?php if($item_flag_color == 'lightgreen' ): ?> lightgreen <?php else: ?> '' <?php endif; ?>">
              <td><?php echo e($item->id); ?><br>
                <a href="javascript:void(0)" id="checkered_<?php echo e($item->id); ?>" class="flag-select-sno">
                  <i class="far fa-flag"></i>
                 
                </a>
              </td>
              <td>
                <ul>

                  <?php
                        $update_status = $item->update_status;
                        $progress      = $item->progress;

                        if( $progress == 25 )
                        {
                           $bar_color = 'danger';
                           $bar_value = 25;

                        }elseif($progress == 35){
                           $bar_color = 'success';
                           $bar_value = 35;
                        }elseif($progress == 50){
                           $bar_color = 'orange';
                           $bar_value = 50;
                        }elseif($progress == 90){
                           $bar_color = 'primary';
                           $bar_value = 90;
                        }elseif($progress == 100){
                           $bar_color = 'success';
                           $bar_value = 100;
                        }

                     ?>

                  <li>
                    <div class="progress progress-md">
                      <div class="progress-bar bg-<?php echo e($bar_color); ?>-bars" role="progressbar" aria-valuenow="<?php echo e($bar_value); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($bar_value); ?>%;">
                        <?php echo e($bar_value); ?>%
                      </div>
                    </div>
                  </li>
                  <li><label><?php echo e($update_status); ?></label></li>

                  <li>
                    <p>
                      <span class="updated-date">
                         <?php echo app('translator')->getFromJson('custom.inquiries.updated-on'); ?>: <?php echo e($item->created_at->format('M d , Y')); ?>

                      </span>
                    </p>
                  </li>
                 
              </td>
             <td>
                <ul>
                  <li>
                    <span class="actions-seeker">

                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing send-row sendBill" data-action="mail-message-mai" data-enquiry_id="<?php echo e($item->id); ?>">
                        <i class="fa fa-envelope"></i>
                      </a>

                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="seeker-details-ema" data-enquiry_id="<?php echo e($item->id); ?>">
                        <i class="fas fa-pencil-alt"></i>
                      </a>


                      <?php if($item->shortlisted_properties): ?>
                      <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing send-row sendBill" data-action="properties-shared-sha" data-enquiry_id="<?php echo e($item->id); ?>">
                        <i class="fa fa-share-alt"></i>
                      </a>
                      <?php endif; ?>

                    </span>
                    <p class="text-dark text-left"><?php echo e($item->name); ?></p>
                  </li>

                  <li><a href="javascript:void(0);"><?php echo e($item->email); ?></a></li>
                  <li>
                    <label>
                      <?php echo e($item->company ? $item->company : trans('custom.cross_mark')); ?>

                    </label>
                  </li>
                  <li>
                    <p class="font-13 text-muted m-b-0">
                      <span>
                        <i class="fas fa-mobile-alt"></i> <?php echo e($item->phone_number); ?>

                      </span>
                      <span class="actions-seeker">
                        <i class="fab fa-whatsapp greeen"></i>
                      </span>
                    </p>
                  </li>
                  <li>
                    <span class="Added on">
                      <?php echo app('translator')->getFromJson('custom.inquiries.created-on'); ?>: <?php echo e($item->created_at->format('M d , Y')); ?>

                    </span>
                  </li>

                </ul>
              </td>
                <td>
                  <ul>
                <li>
                  <span class="actions-seeker">
                    <a href="#loadingModal" data-toggle="modal" data-remote="false" class="on-editing edit-row sendBill" data-action="requirement-details-req" data-enquiry_id="<?php echo e($item->id); ?>">
                      <i class="fas fa-pencil-alt"></i></a>
                  </span>
            
                  
                
                <li class="maintainht" title="<?php echo e($item->address ?? '-'); ?>">
                  <b class="text-dark"> <?php echo app('translator')->getFromJson('custom.inquiries.inquired-for'); ?>:</b>
                  <span><?php echo e($item->address ?? '-'); ?></span>
                </li>
               
                  
                  <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.inquired-property-name'); ?>:</b> <?php echo e($property ? $property->name : '-'); ?>

                    </span>
                  </li>

                   <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.property-company'); ?>:</b> <?php echo e($property ? $property->company : '-'); ?>

                    </span>
                  </li>

                   <?php if( $property_sub_space_types ): ?>
                   <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.spacetypes.space-types'); ?>:</b> <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $property_space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                        ?>
                           <span class="badge"><?php echo e($property_space_types ? $property_space_types->name : ''); ?></span>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                  </li> 
                  <?php endif; ?>

                    <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.seats'); ?>:</b> <?php echo e($item->capacity_id ?? '-'); ?>

                    </span>
                  </li>  

                   <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.listings.fields.agent'); ?>:</b> <?php echo e($agents ? $agents->name : '-'); ?>

                    </span>
                  </li> 

                    <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.booking-date'); ?>:</b> <?php echo e($item->enquire_date ?? '-'); ?>

                    </span>
                  </li> 

                    <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.booking-months'); ?>:</b> <?php echo e($item->enquire_month ?? '-'); ?>

                    </span>
                  </li>     

                  <li>
                    <span class="Added on">
                     <b class="text-dark"><?php echo app('translator')->getFromJson('custom.inquiries.inquiry-from'); ?>: </b><?php echo e($item->enquire_from ?? '-'); ?>

                    </span>
                  </li>     
                  <!-- End -->
                </li>

              </ul>
              </td>

           <td>
                <ul>
                  <?php
                  $status_update_log = \App\UpdateStatusLog::where('enquiry_id',$item->id)->get();
                  ?>

                  <?php $__currentLoopData = $status_update_log->slice(0,3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="show-line"><?php echo e($log->update_status_user); ?> on <?php echo e($log->updated_at->format('M d , Y h:i:s A')); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
                <br>

                <button href="javascript:void(0);" data-toggle="modal" data-target="#modalContactForm_<?php echo e($item->id); ?>" id="view_all"> <?php echo app('translator')->getFromJson('custom.inquiries.view-all'); ?></button>


              </td>
              <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="visit-details-sit" data-enquiry_id="<?php echo e($item->id); ?>">
                  <button id="add">
                    <?php echo app('translator')->getFromJson('custom.inquiries.add'); ?>
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br>
                <li class="maintainht" title="<?php echo e($item->visit_details ?? '-'); ?>">
                  <div class="show-line address-part"><?php echo e($item->visit_details ?? '-'); ?></div>
                </li>
              </td>
               <td>
                <a href="#loadingModal" data-toggle="modal" data-remote="false" class="sendBill" data-action="comments-details-com" data-enquiry_id="<?php echo e($item->id); ?>">
                  <button id="add">
                    <?php echo app('translator')->getFromJson('custom.inquiries.add'); ?>
                    <i class="mdi mdi-plus-circle-outline"></i>
                  </button>
                </a>
                <br>
                <li  class="maintainht" title="<?php echo e($item->comments ?? '-'); ?>">
                  <div class="show-line address-part"><?php echo e($item->comments ?? '-'); ?></div>
                </li>
              </td>

              <!-- assigned to -->
            <td>
                <?php if( $item->assigned_to == 0 ): ?>
                    <?php
                    $not_assigned = trans('custom.not-assigned');
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
              <!--end assigned to -->
                <td class="actions">
                
                <?php if( isAdmin() ): ?>
                <a href="javascript:void(0);">
                  <?php echo Form::open([
                  'method'=>'delete',
                  'route' =>['enquire.destroy',$item->id],
                  'onclick'=>'return checkDelete();'
                  ]); ?>


                  <button type="submit" class="on-default remove-row">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <?php echo Form::close(); ?>

                </a>
                <?php endif; ?>
                <br />
                <br />
                <!-- test -->

                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle-1"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <ul class="dropdown-menu">

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="deal-lost-del" data-enquiry_id="<?php echo e($item->id); ?>"><?php echo app('translator')->getFromJson('custom.inquiries.deal-lost'); ?></a>
                    </li>


                    <li>
                      
                         <?php echo Form::open([
                        'method'=>'post',
                        'route' =>['enquiries.junklead','id' => $item->id,'junk_lead'=>'yes']

                        ]); ?>


                     <button type="submit" class="dropdown-item cursor-pointer-hand junkleadsty" >
                        <?php echo app('translator')->getFromJson('custom.inquiries.junk-lead'); ?>
                    </button>
                        
                        <?php echo Form::close(); ?>

                      
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="booking-initiated-boo" data-enquiry_id="<?php echo e($item->id); ?>"> <?php echo app('translator')->getFromJson('custom.inquiries.initiate-booking'); ?></a>
                    </li>

                    <li><a href="#loadingModal" data-toggle="modal" data-remote="false" class="dropdown-item sendBill" data-action="update-status-sta" data-enquiry_id="<?php echo e($item->id); ?>"> <?php echo app('translator')->getFromJson('custom.inquiries.update-status'); ?></a>
                    </li>


                  </ul>
                </div>

                <!-- end test -->

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



          </tbody>



        </table>
        <?php echo $__env->make('admin.common.delete-script',['enquire.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>


    
      <?php if( ! empty( $items ) ): ?>
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <!-- Option Sent/Shortlisted -->
      <div class="modal fade" id="modalContactForm_<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-margin-sty">
            <div class="modal-header text-center">
              <h4 class="modal-alternative-title w-100 font-weight-bold">
                <?php echo app('translator')->getFromJson('custom.inquiries.updated-status'); ?>
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                  &times;
                </span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form md-sty-inline">
                <?php
                 $status_update_log = \App\UpdateStatusLog::where('enquiry_id',$item->id)->get();
              ?>

                <?php $__currentLoopData = $status_update_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <label data-error="wrong" data-success="right" for="form34" class="form-enquiry-margin">
	                  <?php echo e($log->update_status_user); ?> <?php echo app('translator')->getFromJson('custom.inquiries.on'); ?> <?php echo e($log->updated_at->format('M d , Y h:i:s A')); ?>

	                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

          </div>
        </div>
      </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php endif; ?>

     
  

