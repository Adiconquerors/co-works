<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-headlinks', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style>
  .sty-dn{
    display:none;
  }
  #fawhatsappicon{
    color: green; font-size: 20px;
  }
  .styp5{
    padding:5px;
  }
  .sty-ofxy{
    height: 280px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>

<div class="modal-header">
  <h4 class="modal-title"><?php echo e($template->title); ?> ( <?php echo app('translator')->getFromJson('custom.inquiries.inquiry-id'); ?> : <?php echo e($item->id); ?> )</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
  <div class="form_wrapper">
    <div class="form_container">
      <div class="row clearfix">
        <div class="">

          <div class="">

            <form class="" role="form" id="booking_initiated_form" method="post" enctype="multipart/form-data">
              <div class="row clearfix">

                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="toname" name="toname" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.name'); ?>" value="<?php echo e($item->name ?? ''); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" name="toemail" id="toemail" value="<?php echo e($item->email ?? ''); ?>" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.email'); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                    <input type="text" name="phone_number" value="<?php echo e($item->phone_number ?? ''); ?>" id="phone_number" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.phone-no'); ?>" />
                  </div>
                </div>

                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                    <input type="email" id="ccemail" name="ccemail" value="" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.ccemail'); ?>">
                  </div>
                </div>

             

                <div class="col_half sty-dn" id="prop_id">
                  <div class="input_field">
                    <span>
                      <i aria-hidden="true" class="fa fa-envelope"></i>
                    </span>
                    <input type="hidden" id="booking_initiated_property_id" name="booking_initiated_property_id">
                  </div>
                </div>

                <div class="col_half sty-dn" id="enquiry_months">
                  <div class="input_field">
                    <span>
                      <i aria-hidden="true" class="fa fa-envelope"></i>
                    </span>
                    <input type="number" min="0" id="booking_months" name="booking_months" placeholder="<?php echo app('translator')->getFromJson('custom.dealtracker.booking-months'); ?>">
                  </div>
                </div>

                <div class="col_half sty-dn" id="enquiry_date" >
                  <div class="input_field">
                    <span>
                      <i aria-hidden="true" class="fa fa-envelope"></i>
                    </span>
                  
                    <input type="date" id="booking_date" name="booking_date" class="input-large form-control" placeholder="<?php echo app('translator')->getFromJson('custom.dealtracker.booking-date'); ?>">
                  </div>

                </div>
               <div class="col_half sty-dn" id="bi_enquiry_seats" > 
                  <div class="input_field">
                    <input type="number" id="no_of_seats" min="1" name="no_of_seats" class="input-large form-control" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.no-of-seats'); ?>">
                  </div>
                </div>

                 <div class="col_half sty-dn" id="bi_enquiry_amount" > 
                   <div class="input_field">
                    <input type="number" id="booking_amount" min="0" name="booking_amount" class="input-large form-control" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.booking-amount'); ?>">
                  </div>
                </div>


              
              </div>
              <div class="sty-dn">
                <textarea class="summernote" rows="3" name="message" id="message"><?php echo e($template->content); ?></textarea>
              </div>

              <!-- Start -->
               <div class="sty-dn" id="DisplayBookingInitiatedProperty">

                <div class=" " id="EnquiryBookingInitiatedProperty">
            
                        <div class="property-card property-horizontal bg-white">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="property-image" id="booking_property_image">
                                         
                                    </div>
                                </div>

                                <!-- /col 4 -->
                                <div class="col-sm-4">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                                <h4 id="booking_initiated_company_name">
                                                  
                                                </h4>
                                                <p class="font-13 text-muted" id="booking_initiated_property_address">
                                                </p>
                                            </div>
                                        </div>

                           
                                    </div>
                                   
                                </div>
                                <!-- /col 8 -->
                                <!-- /col 4 -->
                                <div class="col-sm-3">
                                    <div class="property-content">
                                        <div class="listingInfo">
                                            <div class="">
                                              
                                          
                                                <div class="detilphon">
                                                    <p >
                                                        <i class="fab fa-whatsapp" id="fawhatsappicon">
                                                        </i>
                                                        <span>
                                                            
                                                            <b id="booking_initiated_property_phone_number">
                                                               
                                                            </b>
                                                        </span>
                                                    </p> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- /col 4 -->
                                <div class="col-sm-2">
                                    <div class="property-content">
                                     
                                         <a href="javascript:void(0);" class="btn btn-medium-dark styp5">
                                            <?php echo app('translator')->getFromJson('custom.inquiries.selected'); ?>
                                        </a>
                                        
                                    </div>
                                </div>
                                <!-- /col 8 -->
                            </div>
                            <!-- /inner row -->
                        </div>
                        <!-- End property item -->
  

                <div class="input_field">
                  <input type="textarea" name="mail_description" id="mail_description" value="" rows="4" cols="50" placeholder="<?php echo app('translator')->getFromJson('custom.inquiries.space-typeex'); ?>" />
                </div>

            <input id="sortpicture" type="file" name="sortpic" accept="image/jpeg,image/jpg,image/png,application/pdf">
            <button id="upload"><?php echo app('translator')->getFromJson('custom.inquiries.upload'); ?></button>           

             <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo e($item->id); ?>">
              <input type="hidden" id="action" name="action" value="<?php echo e($action); ?>">
              <input type="hidden" id="sub" name="sub" value="<?php echo e($sub); ?>">


                </div>
              </div>
              <!--End Start -->

              <div class="input_field">

              </div>
 
               <?php echo $__env->make('admin.enquires.forms.booking-initiated-filters', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

          <?php
             if( isAdmin() ) { 
             $booking_properties = \App\Property::get(); 
             }elseif(isAgent()){
              $booking_properties = \App\Property::get()->where('is_approved','yes');
             }
          ?>
            
              <div classs="row modal-booking-scroll sty-ofxy autoroscrol" id="EnquiryBookingInitiatedSearchList">
               <div class=" " >
                 <?php echo $__env->make('admin.enquires.forms.booking-initiated-filters-list',compact($booking_properties), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               </div>
                <!-- end row -->
       
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php echo $__env->make('partials.newadmin.common.add-edit.formfields-scriptsrcs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
 $(document).ready(function() {  
    "use strict";
  <?php if(!empty($booking_properties)): ?>
  <?php $__currentLoopData = $booking_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    $(document).on('click', '#booking_property_select_<?php echo e($property->id); ?>', function(e) {
      e.preventDefault();
      $.ajax({
        url: "<?php echo e(route('bookinginitiated.selectproperty')); ?>",
        type: 'POST',
        data: {
          _token: _token,
          booking_property_id: '<?php echo e($property->id); ?>',
          booking_property_name: '<?php echo e($property->name); ?>',
          booking_property_company: '<?php echo e($property->company); ?>',
          enquiry_id: "<?php echo e($item->id); ?>"
        },
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            alert(data.success);
            $("#EnquiryBookingInitiatedProperty").css('dispay', 'none');
            $("#DisplayBookingInitiatedProperty").css('display', 'block');
            $("#booking_initiated_property_name").html(data.property_name);

            $("#DisplayBookingInitiatedPropertyId").css('display', 'block');


            $("#enquiry_months").css('display', 'block');

            $("#enquiry_date").css('display', 'block');
            $("#bi_enquiry_seats").css('display', 'block');
            $("#bi_enquiry_amount").css('display', 'block');

            $("#booking_initiated_property_id").val(data.property_id);

            var img = '<img src="'+data.property_cover_image+'" width="100" height="100" id="booking_property_image">';
             $("#booking_property_image").html(img);  

            $("#booking_initiated_company_name").html(data.company_name);

            $("#booking_initiated_property_address").html(data.property_address);
            $("#booking_initiated_property_space_type").html(data.property_space_type);
            $("#booking_initiated_property_phone_number").html(data.property_phone_number);

          }
        }
      });

    });

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
});
</script>

<script>
$(document).ready(function() {  
    "use strict";
  $('#upload').on('click', function(e) {
    e.preventDefault();
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('_token', _token);
    form_data.append('enquiry_id', '<?php echo e($item->id); ?>');
                              
    $.ajax({
        url: "<?php echo e(route('uploadimage.ajax')); ?>", // point to server-side PHP script 
        dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(data){
            alert(data.success); // display response from the PHP script, if any
        }
     });
});
});
</script>