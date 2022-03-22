<?php $__env->startSection( 'new_content' ); ?>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">  <?php echo app('translator')->getFromJson('custom.leads.lead-details'); ?></h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="<?php echo e(route('leads.index')); ?>"><?php echo e(ucwords( $active_class )); ?></a>
            </li>
            <li class="breadcrumb-item">
               <?php echo e($title); ?>

            </li>
         </ol>
         <div class="clearfix"></div>  
      </div>
   </div>
</div>
<!-- end row -->
<?php
            $cities =  \App\City::find( $record->city_id);
            $properties =  \App\Property::find( $record->property_id);

            $property_sub_space_types = $properties->property_sub_space_types;
         ?>
<div class="card led-view">
 
 
      <ul class="list-group list-group-flush">
 
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.name'); ?> <span> <?php echo e($record->name ?? '-'); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.email'); ?> <span> <?php echo e($record->email ?? '-'); ?> </span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.users.phone'); ?><span><?php echo e($record->phone_number ?? '-'); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.address'); ?> <span><?php echo e($record->address ?? '-'); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.company'); ?> <span><?php echo e($record->company ?? '-'); ?> </span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.spacetypes.space-types'); ?> <span>   <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <?php 
      $spacetypes = \App\SpaceType::find($property_type->space_type_id);
    ?> 
      <?php echo e($spacetypes ? $spacetypes->name : ''); ?><br/>    
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </span> </li>
<li class="list-group-item"> <?php echo app('translator')->getFromJson('custom.leads.capacity'); ?> <span><?php echo e($record->capacity_id ?? '-'); ?> </span> </li>
<li class="list-group-item"> <?php echo app('translator')->getFromJson('custom.leads.description'); ?> <span><?php echo e($record->description ?? '-'); ?> </span></li>
<?php if( $record->enquire_date == 'undefined' ): ?>
    <?php
      $enquire_date = '-';
    ?>
  <li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.inquiry-date'); ?><span><?php echo e($record->enquire_date ? $record->enquire_date : $enquire_date); ?> </span> </li>
  <?php else: ?>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.inquiry-date'); ?><span><?php echo e($record->enquire_date ?? '-'); ?> </span> </li>  
<?php endif; ?> 
<li class="list-group-item"> <?php echo app('translator')->getFromJson('custom.leads.property'); ?><span> <?php echo e($properties ? $properties->name : '-'); ?> </span></li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.inquiry-from'); ?><span><?php echo e($record->enquire_from ?? '-'); ?> </span> </li>

               
               <li class="list-group-item">
               <?php
               $assigned_to_users = \App\User::find($record->assigned_to);
               ?>
               <?php echo app('translator')->getFromJson('custom.inquiries.assigned-to'); ?> <span> <?php if( $record->assigned_to == 0 ): ?>
                    <?php
                    $not_assigned = trans('custom.inquiries.not-assigned');
                    ?>
                    <?php echo e($not_assigned); ?>

                  <?php else: ?>
                    <?php echo e($assigned_to_users ? $assigned_to_users->name : $not_assigned); ?>

                  <?php endif; ?> </span> 
            
            </li>


            <?php if( isAdmin() || isAgent() ): ?>

<?php if( ! empty( $record->deal_lost ) ): ?>
<li class="list-group-item"> <?php echo app('translator')->getFromJson('custom.leads.deal-lost-reason'); ?> <span><?php echo e($record->deal_lost ?? '-'); ?> </span> </li>
<?php endif; ?>
<?php if( ! empty( $record->deal_comments ) ): ?>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.leads.deal-lost-comments'); ?><span><?php echo e($record->deal_comments ?? '-'); ?> </span> </li>
<?php endif; ?>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.eforms.deal-lost'); ?><span><?php echo e($record->deal_lost_no ?? '-'); ?> </span> </li>
<li class="list-group-item"><?php echo app('translator')->getFromJson('custom.inquiries.junk-lead'); ?><span><?php echo e($record->junk_lead ?? '-'); ?> </span> </li>
<?php endif; ?>
</ul>
 
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.new_admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>