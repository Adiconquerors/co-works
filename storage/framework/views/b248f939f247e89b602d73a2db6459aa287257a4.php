<?php
$drop_down_display = false;
if( ! empty( $links ) ) {
   foreach( $links as $dlink ) {
      if ( ! empty( $dlink['permission_key'] ) && Gate::allows( $dlink['permission_key'] ) ) {
         $drop_down_display = true;
      }
   }
}
?>
<?php if( $drop_down_display ): ?>
<div class="btn-group">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu dropdown-menu-right dropdown-menu-contact">
      <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dlink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if( 'delete' === $dlink['type'] && ! empty( $dlink['permission_key'] ) && Gate::allows( $dlink['permission_key'] ) ): ?>
            <li>
            <?php echo Form::open(array(
            'style' => 'display: inline-block;',
            'method' => 'DELETE',
            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
            'id' => 'form_' . $record->id,
            'route' => [ $dlink['route'], $record->id ])); ?>

            <?php echo $dlink['icon']; ?>&nbsp;<?php echo Form::submit(trans('global.app_delete'), array('class' => 'btn btn-link',)); ?>

            <input type="hidden" name="redirect_url" value="<?php echo e($dlink['redirect_url'] ?? ''); ?>">
            <?php echo Form::close(); ?>

            </li>
         <?php elseif( ! empty( $dlink['permission_key'] ) && Gate::allows( $dlink['permission_key'] ) ): ?>
         <li>
         <a href="<?php echo e(route($dlink['route'], $record->id)); ?>" target="_blank">
         <?php echo $dlink['icon']; ?><?php echo e($dlink['title']); ?></a>
         </li>
         <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </ul>
</div>
<?php endif; ?>