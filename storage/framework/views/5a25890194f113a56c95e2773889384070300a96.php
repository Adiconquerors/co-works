<?php
 $customer_name = request('customer_name');
 
 $customer_mobile = request('customer_mobile');
 $property_manager_name = request('property_manager_name');
 $property_manager_email = request('property_manager_email');
 $property_manager_mobile = request('property_manager_mobile');
 $transaction_id = request('transaction_id');
?>

  <?php echo Form::open(array('route' => $route, 'class'=>'row','method' => 'GET')); ?>

  
      <?php
          $users = \App\User::get()->where('role_id', 3)->pluck('name', 'id');

      ?>
        

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <select class="selectpicker" data-style="btn-secondary" name="customer_name" id="customer_name" value="">

                      <option value=""  >
                       <?php echo app('translator')->getFromJson('global.select_customer'); ?>
                      </option>

                      <?php
                      foreach ($users as $user_id=>$user_name)
                      {
                      ?>

                      <option value="<?php echo e($user_id); ?>" <?php echo e($user_id == $customer_name ? "selected" : ""); ?> > <?php echo e($user_name); ?></option>

                      <?php } ?>

                    </select>

                </div>
            </div>

       

     <div class="col-sm-6 col-md-2">
      <div class="control-group">
         <div class="controls">
             <input type="number" name="customer_mobile" placeholder="<?php echo e(trans('global.customer_mobile')); ?>" class="form-control" id="customer_mobile" value="<?php echo e($customer_mobile ?  $customer_mobile : old('customer_mobile')); ?>">
         </div>
      </div>
   </div>


  
     <div class="col-12 m-b-30 text-center m-t-10">
      <button id="unpaidSearch" class="btn btn-purple">
      <i class="mdi mdi-magnify m-r-5"></i>
      <?php echo app('translator')->getFromJson('global.app_search'); ?>
    </button>

   </div>
<?php echo Form::close(); ?>

<!-- row2 -->
