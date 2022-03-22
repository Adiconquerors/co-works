   <style>
   .sty-mt{
    margin-top:27px;
   }
  </style>
   <form class="row sty-mt">
            <!-- Dealstatus start -->
             <?php
                $deal_status = array(
                  'Deal Lost' => 'Deal Lost', 
                  'Junk Lead' => 'Junk Lead',
                  'Deal Completed' => 'Deal Completed',
                );

              ?>
                <div class="col-sm-6 col-md-2">
                    <label for="deal_status">@lang('custom.eforms.deal-status')</label>
                <div class="form-group">
                    <select class="selectpicker" data-style="btn-secondary" name="deal_status" id="deal_status">

                      <option value="">
                          @lang('custom.eforms.please-select')
                      </option>

                      <?php
                      foreach ($deal_status as $status)
                      {
                      ?>

                      <option value="{{ $status }}">{{ $status }}</option>

                      <?php } ?>

                    </select>

                </div>
            </div>
            <!-- end Status -->
            <button id="DealStatusSearch" class="btn btn-purple waves-effect waves-light">
            <i class="mdi mdi-magnify m-r-5">
            </i>
              @lang('custom.eforms.search')
            </button>
         
      </form>