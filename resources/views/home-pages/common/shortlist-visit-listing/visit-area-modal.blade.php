 <!-- Modal HTML -->
<div class="modal fade" id="VisitsModal" tabindex="-1" role="dialog" >
   <div class="modal-dialog modal-dialog-select" role="document">
      <div class="modal-content" id="VisitsModalContent">
         <div class="modal-header">
            <h4 class="modal-title">@lang('custom.eforms.schedule-visit')</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
               <div class="modal-body">

           <div class="form_wrapper">
     <div class="form_container">
        <div class="row clearfix">
          <div class="">

   <form class="" role="form"  method="post">
  
      <div class="row clearfix">
          <div class="col_half">
            <label for="visit_toname">@lang('custom.eforms.receivername')</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" id="visit_toname" name="visit_toname" placeholder="@lang('custom.eforms.name')" value="" />
             </div>
          </div>

           <div class="col_half">
            <label for="visit_toemail">@lang('custom.eforms.email')*</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input type="email" name="visit_toemail" id="visit_toemail" value=""placeholder="@lang('custom.eforms.email')" />
               
             </div>
          </div>
        

         <div class="col_half">
          <label for="visit_ccemail">@lang('custom.eforms.ccemail')</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
               <input type="email" id="visit_ccemail" name="visit_ccemail"  value="" placeholder="@lang('custom.eforms.ccemail')" >
             </div>
          </div>

          <div class="col_half">
          <label for="visit_mail_mobile">@lang('custom.invoicepdf.phone')*</label>
           <div class="input_field"> 
              <input type="number" name="visit_mail_mobile" value="" id="visit_mail_mobile" placeholder="@lang('custom.eforms.mobile')" />
           </div>
        </div> 

           <div class="col_half">
                <label for="visit_no_of_seats">@lang('custom.eforms.no-of-seats')</label>
                <div class="input_field"> 
                  <input type="number" min="0" name="visit_no_of_seats" value="" id="visit_no_of_seats" placeholder="@lang('custom.eforms.no-of-seats')" />
                </div>
              </div>


              <div class="col_half">
                <label for="visit_company_name">@lang('custom.eforms.company-name')</label>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                  <input type="text" name="visit_company_name" value="" id="visit_company_name" placeholder="@lang('custom.eforms.company')" />
                </div>
              </div>

             
          

      </div>


   <label for="visit_mail_description">@lang('custom.eforms.comments')</label>
   <div class="input_field">
    
      <textarea name="visit_mail_description" id="visit_mail_description" value="" rows="4" cols="105" placeholder="@lang('custom.eforms.description')" ></textarea> 
   </div> 


  <input type="hidden" id="visit_action" name="visit_action" value="schedule-now">

</form>
        
      </div>
    </div>
  </div>
</div>
            
         </div>
  
         <div class="modal-footer">
          <button id="visit_properties_share" class="btn btn-primary">@lang('custom.eforms.schedule-now')</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('custom.eforms.close')</button>
           <div id="visit_loading"></div>
         </div>
         

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!-- /.modal-->
