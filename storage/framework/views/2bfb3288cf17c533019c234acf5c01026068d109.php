       

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                     <div class="form-group m-b-20">
                        <label for="author_id"><?php echo app('translator')->getFromJson('custom.articles.select-authors'); ?></label>

                         <?php echo Form::select('author_id', $authors, old('author_id'), ['class' => 'form-control', 'id' => 'author_id','placeholder'=>trans('custom.postrequirement.please_select') ]); ?>


                        
                     </div>

                     <div class="form-group m-b-20">
                        <label for="sub_space_type_id"><?php echo app('translator')->getFromJson('custom.articles.select-category'); ?></label>

                        <?php
                         $space_types = \App\SpaceType::getSpaceTypes(0);
                        ?>  
                        <select class="form-control" id="article_sub_space_type" name="sub_space_type_id" >
                        <option value="" disabled selected><?php echo app('translator')->getFromJson('custom.articles.select-your-option'); ?></option>  
                        <?php $__currentLoopData = $space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                         $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);
                        ?> 

                         <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                             if($article){
                              if($article->sub_space_type_id == $sub->id){
                                 $sub_space_type_id =  'selected';
                                 }
                              else
                                $sub_space_type_id = null;
                             }
                            ?>
                         <?php if($article): ?>    
                         <option value="<?php echo e($sub->id); ?>"  <?php echo e($sub_space_type_id); ?>><?php echo e($sub->name); ?></option>
                         <?php else: ?>
                         <option value="<?php echo e($sub->id); ?>" ><?php echo e($sub->name); ?></option>
                         <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                        </select>
                                           

                        
                     </div>


                     <div class="form-group m-b-20">
                        <?php echo Form::label('name',trans('custom.articles.name') ); ?>


                      <?php echo Form::text('name', old('name'), ['class' => 'form-control',
                          'id'=>'article-name','placeholder'=>trans('custom.articles.name'),
                          'required'=> 'true'
                        ]); ?>


                     </div>

                    <div class="form-group m-b-20">
                     <?php echo Form::label('article_heading',trans('custom.articles.article-main-heading') ); ?>

                         
                     <?php echo Form::text('article_heading', old('article_heading'), ['class' => 'form-control',
                       'id'=>'article-heading','placeholder'=>trans('custom.articles.article-main-heading'),
                       'required'=> 'true'
                     ]); ?>


                  </div>

                     <div class="form-group m-b-20">
                     <?php echo Form::label('article_quote',trans('custom.articles.article-quote') ); ?>

                         
                     <?php echo Form::text('article_quote', old('article_quote'), ['class' => 'form-control',
                       'id'=>'article-quote','placeholder'=>trans('custom.articles.article-quote'),
                       'required'=> 'true'
                     ]); ?>


                  </div>


                     <div class="form-group m-b-20">
                       <?php echo Form::label('description',trans('custom.articles.description')); ?>


                          <?php echo Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'article-description', 'rows'=>'5', 'placeholder' => trans('custom.articles.description')]); ?>

                     </div>
                

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                     <div class="form-group m-b-20">
                         <?php echo Form::label('description_one',trans('custom.articles.description-one'),['class' => 'mb-3']); ?>

                       
                        <div class="row">
                           <div class="col-12">

                              <?php echo Form::textarea('description_one', old('description_one'), ['class' => 'summernote' ,  'id'=>'article-description-one', 'placeholder' => trans('custom.articles.description-one')]); ?>  
                           </div>
                        </div>
                        <!-- end row -->
                     </div>

                     <div class="form-group m-b-20">
                           <?php echo Form::label('image',trans('custom.articles.image')); ?>


                           <?php
                              if( $article )
                              {
                                  $image_url = $article->image;
                                
                              }else{
                                  $image_url = null;
                              }
                           ?>
                         
                           

                     
                        <input type="file" class="dropify" name="image"  data-height="120" value="<?php echo e($image_url); ?>"  accept=".jpeg, .png, .jpg, .gif, .svg">
                        <br/>

                           <img src="<?php echo e(getDefaultimgagepath($image_url,'articles','')); ?>" height="100" width="100">
                        
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