   <form class="row">
    
        <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="property_address" type="text" class="input-large form-control" id="property_address" name="property_address" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.property-address'); ?>" value="" onfocus="initialize_autocomplete('property_address')">
               </div>
            </div>
         </div>

          <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="property_name" type="text" class="input-large form-control" id="property_name" name="property_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.property-name'); ?>" />
               </div>
            </div>
         </div>  

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="manager_name" type="text" class="input-large form-control" id="manager_name" name="manager_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.property-manager'); ?>" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="manager_email" type="text" class="input-large form-control" id="manager_email" name="manager_email" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.property-manager-email'); ?>" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="manager_phone" type="number" class="input-large form-control" id="manager_phone" name="manager_phone" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.property-manager-number'); ?>" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
        <button id="venueSearch" class="btn btn-purple waves-effect waves-light">
        <i class="mdi mdi-magnify m-r-5">
        </i>
         <?php echo app('translator')->getFromJson('custom.eforms.search'); ?>
        </button>
      </div>
    </div>
      </form>