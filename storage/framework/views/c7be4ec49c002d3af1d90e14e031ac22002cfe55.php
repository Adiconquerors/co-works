       

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                     <div class="form-group m-b-20">

                      <?php echo Form::label('people',trans('custom.membershipfees.people') ); ?>


                      <?php echo Form::number('people', old('people'), ['class' => 'form-control',
                      'id'=>'people','placeholder'=>trans('custom.membershipfees.people'),'min'=>'0',
                      'required'=> 'true'
                      ]); ?>

                      
                     </div>

                      <div class="form-group m-b-20">

                      <?php
                        $durations = [
                        'day'   => 'Day',
                        'month' => 'Month',
                        'year'  => 'Year',
                        ];
                      ?>

                        <label for="duration"><?php echo e(trans('custom.membershipfees.duration')); ?></label>

                          <?php echo Form::select('duration', $durations , old('duration') , $attributes = array('class'=>'form-control', 'placeholder'=>trans('custom.eforms.please-select'), 

                          'id'=>'duration', 

                          )); ?>


                        
                     </div>


                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                      <div class="form-group m-b-20">
                          <?php echo Form::label('price',trans('custom.membershipfees.price') ); ?>


                          <?php echo Form::number('price', old('price'), ['class' => 'form-control',
                          'id'=>'price','placeholder'=>trans('custom.membershipfees.price'),'min'=>'0',
                          'required'=> 'true',
                          ]); ?>

                      </div>
                      
                       <div class="form-group m-b-20">

                        <?php echo Form::label('title',trans('custom.membershipfees.title') ); ?>


                        <?php echo Form::text('title', old('title'), ['class' => 'form-control',
                        'id'=>'title','placeholder'=>trans('custom.membershipfees.title'),
                        'required'=> 'true'
                        ]); ?>

                        
                       </div>

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
            <div class="text-center">
               <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo e($button_name); ?></button>
            </div>