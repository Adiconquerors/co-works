<form>
<div class="row clsdi">
 
<div class="col-lg-6 col-12">

       <div class="col_half">
          <div class="input_field">
             <input type="text" name="property_address" placeholder="@lang('custom.inquiries.property-address')" class="form-control" id="property_address" value="" onfocus="initialize_autocomplete('property_address')">
         </div>
      </div>
      </div>
      <div class="col-lg-6 col-12">
     <div class="col_half">
          <div class="input_field">
             <input type="number" name="property_id" placeholder="@lang('custom.inquiries.property-id')" class="form-control" id="property_id" value="">
         </div>
      </div>
      </div>

<div class="col-lg-4 col-12">
       <div class="col_half">
          <div class="input_field">
             <input type="text" name="property_company" placeholder="@lang('custom.inquiries.property-company')" class="form-control" id="property_company" value="">
         </div>
      </div>
</div>

   <?php
    $space_types = \App\SpaceType::getSpaceTypes(0);
   ?>
     <div class="col-lg-4 col-12">
         <div class="col_half ">
          <div class="input_field">
              <select class="form-control" data-style="btn-secondary" name="space_type" id="space_type">
                  <option value="">
                      @lang('custom.inquiries.office-type')
                  </option>

                <?php
                foreach ($space_types as $space_type)
                {
                ?>

                <option value="{{ $space_type->id }}">{{ $space_type->name }}</option>

                <?php } ?>

              </select>

          </div>
        </div></div>
        <div class="col-lg-4 col-12">
      <button id="bookingInitiatedSearch" class="btn btn-purple">
      <i class="mdi mdi-magnify m-r-5"></i>
      @lang('custom.inquiries.search')
    </button>
    </div>
               
</div>
   
</form>


<!-- row2 -->




