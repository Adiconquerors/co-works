   <form class="row">
         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_address" type="text" class="input-large form-control" id="lead_address" name="lead_address" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.enter-location'); ?>" value="" onfocus="initialize_autocomplete('lead_address')">
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_name" type="text" class="input-large form-control" id="lead_name" name="lead_name" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.lead-name'); ?>" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_email" type="text" class="input-large form-control" id="lead_email" name="lead_email" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.lead-email'); ?>" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_number" type="number" class="input-large form-control" id="lead_number" name="lead_number" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.lead-mobile'); ?>" />
               </div>
            </div>
         </div>

      <?php
          $assigned_to = \App\User::get()->whereIn('role_id', [1,4])->pluck('name', 'id'); 
      ?>
        
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <?php
                      if(isAdmin()){
                    ?>
                    <select class="selectpicker" data-style="btn-secondary" name="lead_assigned_to" id="lead_assigned_to" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.key-account-manager'); ?>">
                    <?php }elseif(isAgent()) { ?>
                      <select class="selectpicker" data-style="btn-secondary" name="lead_assigned_to" id="lead_assigned_to" placeholder="<?php echo app('translator')->getFromJson('custom.eforms.key-account-manager'); ?>" disabled>
                    <?php } ?>

                      <option value="0">
                           <?php echo app('translator')->getFromJson('custom.inquiries.not-assigned'); ?>
                      </option>

                      <?php
                      foreach ($assigned_to as $assigned_id=>$assigned_name)
                      {
                      ?>
                      <?php if(isAgent()): ?>

                         <option value="<?php echo e($assigned_id); ?>" <?php echo e(( \Auth::id() == $assigned_id ) ? ' selected' : ''); ?>>
                          <?php echo e($assigned_name); ?>

                         </option>
                      <?php else: ?>
                        <option value="<?php echo e($assigned_id); ?>"><?php echo e($assigned_name); ?></option>

                      <?php endif; ?>

                      <?php } ?>

                    </select>

                </div>
            </div>

            <!-- Status -->
              <?php
                $lead_status = array(
                  trans('custom.eforms.req-rec') => trans('custom.eforms.req-rec'),
                  trans('custom.eforms.op-sent') => trans('custom.eforms.op-sent'),
                  trans('custom.eforms.visit-sec') => trans('custom.eforms.visit-sec'),
                  trans('custom.eforms.book-ini') => trans('custom.eforms.book-ini'),  
                );
              ?>

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <select class="selectpicker" data-style="btn-secondary" name="lead_status" id="lead_status">

                      <option value="">
                            <?php echo app('translator')->getFromJson('custom.eforms.lead-status'); ?>
                      </option>

                      <?php
                      foreach ($lead_status as $lead_status=>$lead_status_name)
                      {
                      ?>

                      <option value="<?php echo e($lead_status_name); ?>"><?php echo e($lead_status_name); ?></option>

                      <?php } ?>

                    </select>

                </div>
            </div>
            <!-- end Status -->


         <div class="col-12 m-b-30 text-center m-t-10">
            <button id="leadSearch" class="btn btn-purple waves-effect waves-light">
            <i class="mdi mdi-magnify m-r-5">
            </i>
            <?php echo app('translator')->getFromJson('custom.inquiries.search'); ?>
            </button>
           
         </div>
      </form>