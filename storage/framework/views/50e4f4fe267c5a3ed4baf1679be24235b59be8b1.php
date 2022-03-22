<!-- Modal HTML -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-select" role="document">
    <div class="modal-content" id="loadingModalContent">

      <div id="loading_icon"><img src="<?php echo e(url(PREFIX1 . 'assets/loader/loader.svg')); ?>"></div>
      <div id="content"></div>

      <div class="modal-footer">
        <button id="enquirySend" class="btn btn-primary"><?php echo app('translator')->getFromJson('global.app_save'); ?></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo app('translator')->getFromJson('global.app_close'); ?></button>
        <div id="loading"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal