       

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                      <div class="form-group m-b-20">
                       {!! Form::label('image',trans('custom.articles.image')) !!}

                       <?php
                          if( $record )
                          {
                              $image_url = $record->image;
                            
                          }else{
                              $image_url = null;
                          }
                       ?>
                     
                      

                        <input type="file" class="dropify" name="image"  data-height="120" value="{{ $image_url }}"  accept=".jpeg, .png, .jpg, .gif, .svg">
                        <br/>

                          <img src="{{getDefaultimgagepath($image_url,'ourclients','')}}" height="100" width="100"> 
                         
                     </div>


                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
              
            </div>
            <!-- end row -->
            <div class="text-center">
               <button type="submit" class="btn btn-success waves-effect waves-light">{{ $button_name }}</button>
            </div>