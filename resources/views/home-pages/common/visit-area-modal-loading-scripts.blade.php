<!-- Modal HTML -->
<div class="modal fade" id="VisitsModal" tabindex="-1" role="dialog" >
   <div class="modal-dialog modal-dialog-select" role="document">
      <div class="modal-content" id="loadingModalContent">
        
         <div id="loading_icon"><img src="{{url(PREFIX1 . 'assets/loader/loader.svg')}}"></div>
         <div id="content"></div>
         

         <div class="modal-footer">
          <button id="propertyVisitSend" class="btn btn-primary">@lang('custom.eforms.raise')</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('custom.eforms.close')</button>
          <div id="visit_loading"></div>
         </div>
         

      </div>
     </div>
  
</div>

