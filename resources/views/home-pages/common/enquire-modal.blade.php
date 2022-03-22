@if($record)
    @php
      $sub_space_type_id = $record->sub_space_type_id;
    @endphp
    @else
   @php
     $sub_space_type_id     = null;
   @endphp
@endif

<?php
  
  $auth_user = Auth::user();

  if(! empty( $auth_user ) ){
    $user_mobile = Auth::user()->mobile;
    $user_name = Auth::user()->name;
    $user_email = Auth::user()->email;
    }
    else{
      $user_mobile = null;
      $user_name = null;
      $user_email = null;
    }

?>
<style>
  
    .sty-dn{
      display: none;
    }.sty-cfs18{
      color:#c1ab77; font-size: 18px;
    }.sty-tc{
      text-align: center;
    }
    .sty-fr{
      float:right;
    }

</style>
<!-- enquire -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content sty-w700">
         <div class="modal-header">
            <button type="submit" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
               @lang('custom.eforms.inq-space')
            </h4>
         </div>
         <div class="modal-body">
      {!! Form::open(['method' => 'POST', 'route' => ['enquire.otp' , $record->slug], 'class'=>'well form-horizontal' ,'id'=>'contact_form','files' => true,'name'=>'formEnquireOtp']) !!}

               <fieldset>
                  <legend class="sty-tc">@lang('main.eforms.completeform')</legend>

                    @if ( isDemo() ) 
                    <div class="alert alert-info">
                    @lang('custom.messages.crud_disabled')
                    </div> 
                    @endif 
                  <!-- Text input-->
                  <div class="form-group">
                      {!! Form::label('name',trans('main.eforms.name'), ['class'=>'col-md-4 control-label']) !!}
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-user">
                           </i>
                           </span>
                           {!! Form::text('name', $user_name, ['class' => 'form-control',
                           'placeholder'=>trans('main.eforms.name'),'required'=>'true','id'=>'enquire-name'

                           ]) !!}
            
                        </div>
                     </div>
                  </div>
               
              
                  <!-- Text input-->
                  <div class="form-group">
                    {!! Form::label('email',trans('main.eforms.email'), ['class'=>'col-md-4 control-label']) !!}
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-envelope">
                           </i>
                           </span>
                  {!! Form::email('email', $user_email, ['class' => 'form-control',
                  'placeholder'=>trans('main.eforms.email'),'id'=>'enquire-email','required'=>'true'

                  ]) !!}

                        </div>
                     </div>
                  </div>
                  <!-- Text input-->
                  <div class="form-group">
                  {!! Form::label('phone_number',trans('main.eforms.mobile'), ['class'=>'col-md-4 control-label']) !!}
                    
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-earphone">
                           </i>
                           </span>
                           
                        {!! Form::number('phone_number', $user_mobile, ['class' => 'form-control',
                        'placeholder'=>trans('main.eforms.mobile-num'), 'min'=>'0','id'=>'enquire-phone_number','required'=>'true','title'=>'Ex:919951864590 (Countrycode & Phone number)'

                        ]) !!}
               
                        </div>
                     </div>
                  </div>


                  <!-- Text input-->
                  <div class="form-group">
                      {!! Form::label('address',trans('main.eforms.location'), ['class'=>'col-md-4 control-label']) !!}
               
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-home">
                           </i>
                           </span>

                           <input class="form-control" type="text" id="enquire_address" onClick="initialize_top(this.id);"  name="address" placeholder="@lang('main.eforms.location')" autocomplete="off" >
                           
                        </div>
                     </div>
                  </div>



        
                  <div class="form-group">
                     
                    {!! Form::label('company',trans('main.eforms.company'), ['class'=>'col-md-4 control-label']) !!}
                     
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-globe">
                           </i>
                           </span>
                           {!! Form::text('company', trans('main.eforms.company'), ['class' => 'form-control',
                           'placeholder'=>'Company','id'=>'enquire-company'

                           ]) !!}
                        </div>
                     </div>
                  </div>
                  <!-- space type -->
        
                  <!-- capacity -->
                  <div class="form-group">
                  <?php
                    $capicities = array(

                    '1 - 50' => trans('custom.eforms.one-fifty'),
                    '51 - 100' => trans('custom.eforms.fifty-one'),
                    '101 - 200' => trans('custom.eforms.hundred-one'),
                    '201 - 300' => trans('custom.eforms.twohundred-one'),
                    '301 - 400' => trans('custom.eforms.threehundred-one'),
                    '401 - 500' => trans('custom.eforms.fourhundred-one'),
                    '500+' => trans('custom.eforms.fivehundred-one'),
                    );

                  ?>

               
                     {!! Form::label('capacity_id',trans('main.eforms.capacity'), ['class'=>'col-md-4 control-label']) !!}
                     <div class="col-md-6 selectContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-list">
                           </i>
                           </span>

                           {!! Form::select('capacity_id', $capicities, old('capacity_id'), ['class' => 'form-control selectpicker',  'id' => 'capicity_id','placeholder'=>trans('main.eforms.please-select')]) !!}  

                        </div>

                     </div>
                  </div>
                  <!-- radio checks -->
              
                  <!-- Text area -->
                  <div class="form-group">
                     {!! Form::label('description',trans('main.eforms.description'), ['class'=>'col-md-4 control-label']) !!}
                     
                     <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-pencil">
                           </i>
                           </span>
                           {!! Form::textarea('description', old('description'), ['class' => 'form-control',
                           'placeholder'=>trans('main.eforms.description'),'rows'=>'3','columns'=>'30','id'=>'enquire-description'

                           ]) !!}
                          
                        </div>
                     </div>
                  </div>


                 <div class="alert alert-danger print-error-msg-error sty-dn">
                <ul></ul>
                </div>  

                <div class="form-group form-enquire-otp">
                <label class="col-md-4 control-label" for="enquire_otp">@lang('main.eforms.otp')</label>
                <div class="col-md-6 inputGroupContainer">
                <input class="form-control"  id="enquire-otp"  type="text" name="otp" placeholder="@lang('main.eforms.otp')" disabled>
                  <div id="enquire-resend-otp sty-dn">
                  <a href="javascript:void(0);"  onclick="resendEnquireOtp();">@lang('main.eforms.resend')</a> 
                  </div>
                </div>
                </div>
                  <!-- Button -->
                  <div class="form-group">
                     <label class="col-md-4 control-label">
                     </label>
                     <div class="col-md-4 sty-fr" id="sendEnquireOtp">
                        <button type="submit"  class="btn btn-enquire-solid" >
                       @lang('main.eforms.sendotp')
                        <span class="glyphicon glyphicon-send">
                        </span>
                        </button>

                     </div>
                  </div>

                <div class="submitValidateOtp sty-dn" >
                 <div class="form-group" >
                   <label class="col-md-4 control-label">
                   </label>
                   <div class="col-md-4 sty-fr">
                      <button type="submit" class="btn btn-enquire-solid" onclick="return submitValidate()" id="submitValidateOtp">
                     @lang('main.eforms.submitvalidate')
                      <span class="glyphicon glyphicon-send">
                      </span>
                      </button>

                   </div>
                </div>
                </div>



               </fieldset>
               <input type="hidden" name="enquire_from" id="enquire_from" value="">

               <input type="hidden" name="agent_name" id="agent_name" value="">

               <input type="hidden" name="enquiry_id" id="enquiry_id" value="">
               <input type="hidden" name="action" id="action" value="send">
               <input type="hidden" name="otp_used" id="otp_used" value="0">

            {!! Form::close() !!}



         </div>
      </div>
   </div>
</div>
<!-- /enquire -->

<!--Validate review -->
<script type="text/javascript">
  function resendEnquireOtp() {
    $('#action').val('resend');
    $('#submitValidateOtp').removeAttr('disabled');
     $('#contact_form').trigger('submit'); 

  }

  function submitValidate() {
    
    $('#action').val('confirm');
    $('#contact_form').submit(function( e ) {
       e.preventDefault();
       e.stopImmediatePropagation();
    });
  }

  

</script>

