<?php if(Session::has('message')): ?>
    <div class="alert alert-<?php echo e(Session::get('status', 'info')); ?>">
        &nbsp;&nbsp;&nbsp;<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo Session::get('message'); ?>

    </div>
<?php endif; ?>