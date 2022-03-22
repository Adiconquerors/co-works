<style>
  .sty-dn{
    display:none;
  }
</style>
  @include('partials.newadmin.common.add-edit.formfields-headlinks')
  
 <div class="modal-header">
    <h4 class="modal-title">{{ $template->title }} ( {{ trans('custom.listings.fields.property-id') }} : {{$item->id}} )</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 </div>  

<div class="modal-body">
  <div class="form_wrapper">
     <div class="form_container">
        <div class="row clearfix">
          <div class="">

   <form class="" role="form" id="property_visit_form" method="POST">
      <div class="row clearfix">
          <div class="col_half">
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" id="visit_toname" name="visit_toname" placeholder="@lang('custom.eforms.name')*" value="" />
             </div>
          </div>

           <div class="col_half">
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input type="email" name="visit_toemail" id="visit_toemail" value=""placeholder="@lang('custom.eforms.email')*" />
             </div>
          </div>
        <div class="col_half">
           <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
              <input type="text" name="visit_mail_mobile" value="" id="visit_mail_mobile" placeholder="@lang('custom.eforms.mobile')*" />
           </div>
        </div> 

         <div class="col_half">
             <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
               <input type="email" id="visit_ccemail" name="visit_ccemail"  value="" placeholder="@lang('custom.eforms.ccemail')" >
             </div>
          </div>
          
      </div>

   <div class="input_field"> 
      <input type="textarea" name="visit_mail_description" id="visit_mail_description" value="" rows="4" cols="50" placeholder="@lang('custom.eforms.description')" />
   </div> 

   <div class="sty-dn"> 
    <textarea class="summernote" rows="3" name="visit_message" id="visit_message" >{{ $template->content }}</textarea>
  </div>


  <input type="hidden" id="visit_property_id" name="visit_property_id" value="{{$item->id}}">
  <input type="hidden" id="action" name="action" value="{{$action}}">
  <input type="hidden" id="sub" name="sub" value="{{$sub}}">

</form>
       
      </div>
    </div>
  </div>
</div>
</div>
  
  @include('partials.newadmin.common.add-edit.formfields-scriptsrcs')
