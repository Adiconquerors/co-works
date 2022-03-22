<style>
.table-collapse{
   border-collapse: collapse; border-spacing: 0; width: 100%;
}
</style>
<div class="">
  <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable">
    <thead>
      <tr class="empty-background">
        <th><?php echo app('translator')->getFromJson('custom.providers.property-id'); ?></th>
        <th><?php echo app('translator')->getFromJson('custom.providers.provider-details'); ?></th>
        <th><?php echo app('translator')->getFromJson('custom.providers.gstin-details'); ?></th>
        <th><?php echo app('translator')->getFromJson('custom.providers.bank-details'); ?></th>
        <th><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
      $provider_details = \App\User::find( $item->customer_id )
      ?>
      <tr class="gradeX" id="gradex">
        <td>
          <?php echo e($item->id); ?>

        </td>
        <!-- provider details -->
        <td>
          <ul>
            <li>
              <p class="text-dark text-left"><?php echo e($provider_details ? $provider_details->name : '-'); ?></p>
            </li>
            <li><a href="javascript:void(0);"><?php echo e($provider_details ? $provider_details->email : '-'); ?></a>
            </li>
            <li>
              <p class="text-dark text-left"><?php echo e($provider_details ? $provider_details->mobile : '-'); ?></p>
            </li>
            <li>
              <label>
                <?php echo e($item->company ?? 'x'); ?>

              </label>
            </li>

          </ul>
        </td>
        <!-- end provider details -->
        <td>
          
            <?php echo e($item->gst  ?? ''); ?>  
        </td>
        <!-- bank details -->
        <td>
          <ul>

            <li>
              <p class="text-dark text-left"><?php echo e($item->bank_name ?? '-'); ?></p>
            </li>

            <li>
              <p class="text-dark text-left"><?php echo e($item->account_holder_name ?? '-'); ?></p>
            </li>

            <li>
              <p class="text-dark text-left"><?php echo e($item->account_number ?? '-'); ?></p>
            </li>

            <li>
              <p class="text-dark text-left"><?php echo e($item->ifsc_code ?? '-'); ?></p>
            </li>
          </ul>
        </td>
        <!-- end details -->
        <td class="actions">
          <br />
          <br />
          <!-- test -->
          <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu">

              <li><a href="<?php echo e(route('prop.edit',$item->slug)); ?>" class="dropdown-item"><?php echo app('translator')->getFromJson('custom.providers.edit-property'); ?></a></li>

            </ul>
          </div>
          <!-- end test -->
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>