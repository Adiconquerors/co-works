<style>
.sty-dn{
  display:none;
}
</style>
<!-- Modal HTML -->
<div class="modal fade" id="ShortlistModal" tabindex="-1" role="dialog" >
   <div class="modal-dialog modal-dialog-select" role="document">
      <div class="modal-content" id="ShortlistModalContent">
         <div class="modal-header">
          <?php
              $template = \App\EmailTemplate::where('key', '=', 'shortlists-share')->first();
            ?>
            <h4 class="modal-title">{{ $template->title }}</h4>
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
            <label for="toname">@lang('custom.eforms.receivername')</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" id="toname" name="toname" placeholder="@lang('custom.eforms.name')" value="" />
             </div>
          </div>

           <div class="col_half">
            <label for="subject">@lang('custom.eforms.email')*</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input type="email" name="toemail" id="toemail" value=""placeholder="@lang('custom.eforms.email')" />
             </div>
          </div>
        <div class="col_half">
          <label for="mail_mobile">@lang('custom.eforms.mobile')*</label>
           <div class="input_field"> 
              <input type="number" name="mail_mobile" value="" id="mail_mobile" placeholder="@lang('custom.eforms.mobile')" />
           </div>
        </div> 

        <div class="col_half">
            <label for="no_of_seats">@lang('custom.eforms.no-of-seats')</label>
            <div class="input_field">
              <input type="number" name="no_of_seats" min="0" value="" id="no_of_seats" placeholder="@lang('custom.eforms.no-of-seats')" />
            </div>
          </div>

         <div class="col_half">
          <label for="ccemail">@lang('custom.eforms.ccemails')</label>
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
               <input type="email" id="ccemail" name="ccemail"  value="" placeholder="@lang('custom.eforms.ccemail')" >
             </div>
          </div>


              <div class="col_half">
                <label for="company_name">@lang('custom.eforms.company-name')</label>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                  <input type="text" name="company_name" value="" id="company_name" placeholder="@lang('custom.eforms.company')" />
                </div>
              </div>

          
          

      </div>

      

    <div class="input_field"> 
      <label for="subject">@lang('custom.eforms.subject')</label>
      <input type="text" name="subject" id="subject" value="" placeholder="@lang('custom.eforms.subject')" />
   </div>

   <label for="mail_description">Message(optional)</label>
   <div class="input_field">
    
      <textarea name="mail_description" id="mail_description" value="" rows="4" cols="105" placeholder="@lang('custom.eforms.description')" ></textarea> 
   </div> 

  <div class="sty-dn"> 
        
  <textarea class="summernote" rows="3" name="message" id="message" >{{$template->content}}</textarea>
    </div>

  <input type="hidden" id="action" name="action" value="shortlists-share">

</form>
        
      </div>
    </div>
  </div>
</div>
            
         </div>
  
         <div class="modal-footer">
          <button id="shortlist_properties_share" class="btn btn-primary">@lang('custom.eforms.share')</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('custom.eforms.close')</button>
           <div id="shortlist_loading"></div>
         </div>
         

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!-- /.modal-->