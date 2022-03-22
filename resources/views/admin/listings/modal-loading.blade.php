<!-- Modal HTML -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-select" role="document">
    <div class="modal-content" id="loadingModalContent">
     
      <div id="loading_icon"><img src="{{url(PREFIX1 . 'assets/loader/loader.svg')}}"></div>
      <div id="content"></div>


      <div class="modal-footer">
        <button id="propertySend" class="btn btn-primary">@lang('global.raise') </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('global.close')</button>
        <div id="loading"></div>
      </div>


    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal