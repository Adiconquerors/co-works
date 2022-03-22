<form class="row">
<div class="col-sm-6 col-md-4 col-lg-4">
      <div class="form-group">
         <div class="controls">
             <input type="text" name="property_address" placeholder="@lang('custom.eforms.address')" class="form-control" id="property_address" value="" onfocus="initialize_autocomplete('property_address')">
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="form-group">
         <div class="controls">
             <input type="number" name="property_id" placeholder="@lang('custom.eforms.property-id')" class="form-control" id="property_id" value="">
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="form-group">
         <div class="controls">
             <input type="text" name="property_manager_name" placeholder="@lang('custom.eforms.property-manager')" class="form-control" id="property_manager_name" value="">
         </div>
      </div>
   </div>

   <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="form-group">
         <div class="controls">
             <input type="text" name="property_manager_email" placeholder="@lang('custom.eforms.property-manager-email')" class="form-control" id="property_manager_email" value="">
         </div>
      </div>
   </div>

   <?php
    $space_types = \App\SpaceType::getSpaceTypes(0);
   ?>


<div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
              <select class="selectpicker" data-style="btn-secondary" name="space_type" id="space_type">
                  <option value="">
                      @lang('custom.eforms.please-select')
                  </option>

                <?php
                foreach ($space_types as $space_type)
                {
                ?>

                <option value="{{ $space_type->id }}">{{ $space_type->name }}</option>

                <?php } ?>

              </select>

          </div>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-4">
      <button id="listingSearch" class="btn btn-purple">
      <i class="mdi mdi-magnify m-r-5"></i>
      @lang('custom.eforms.search')
    </button>

   </div>
</form>
<!-- row2 -->




