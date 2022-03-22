   <form class="row">
         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_address" type="text" class="input-large form-control" id="lead_address" name="lead_address" placeholder="@lang('custom.eforms.enter-location')" value="" onfocus="initialize_autocomplete('lead_address')">
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_name" type="text" class="input-large form-control" id="lead_name" name="lead_name" placeholder="@lang('custom.eforms.lead-name')" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_email" type="text" class="input-large form-control" id="lead_email" name="lead_email" placeholder="@lang('custom.eforms.lead-email')" />
               </div>
            </div>
         </div>

         <div class="col-sm-6 col-md-2">
            <div class="control-group">
               <div class="controls">
                  <input id="lead_number" type="number" class="input-large form-control" id="lead_number" name="lead_number" placeholder="@lang('custom.eforms.lead-mobile')" />
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
                    <select class="selectpicker" data-style="btn-secondary" name="lead_assigned_to" id="lead_assigned_to" placeholder="@lang('custom.eforms.key-account-manager')">
                    <?php }elseif(isAgent()) { ?>
                      <select class="selectpicker" data-style="btn-secondary" name="lead_assigned_to" id="lead_assigned_to" placeholder="@lang('custom.eforms.key-account-manager')" disabled>
                    <?php } ?>

                      <option value="0">
                           @lang('custom.inquiries.not-assigned')
                      </option>

                      <?php
                      foreach ($assigned_to as $assigned_id=>$assigned_name)
                      {
                      ?>
                      @if(isAgent())

                         <option value="{{ $assigned_id }}" {{ ( \Auth::id() == $assigned_id ) ? ' selected' : '' }}>
                          {{ $assigned_name }}
                         </option>
                      @else
                        <option value="{{ $assigned_id }}">{{ $assigned_name }}</option>

                      @endif

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
                            @lang('custom.eforms.lead-status')
                      </option>

                      <?php
                      foreach ($lead_status as $lead_status=>$lead_status_name)
                      {
                      ?>

                      <option value="{{ $lead_status_name }}">{{ $lead_status_name }}</option>

                      <?php } ?>

                    </select>

                </div>
            </div>
            <!-- end Status -->


         <div class="col-12 m-b-30 text-center m-t-10">
            <button id="leadSearch" class="btn btn-purple waves-effect waves-light">
            <i class="mdi mdi-magnify m-r-5">
            </i>
            @lang('custom.inquiries.search')
            </button>
           
         </div>
      </form>