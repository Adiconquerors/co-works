       

            <div class="row">
               <div class="col-md-6">
                  <div class="p-20">

                     <div class="form-group m-b-20">
                        <label for="author_id">@lang('custom.articles.select-authors')</label>

                         {!! Form::select('author_id', $authors, old('author_id'), ['class' => 'form-control', 'id' => 'author_id','placeholder'=>trans('custom.postrequirement.please_select') ]) !!}

                        
                     </div>

                     <div class="form-group m-b-20">
                        <label for="sub_space_type_id">@lang('custom.articles.select-category')</label>

                        <?php
                         $space_types = \App\SpaceType::getSpaceTypes(0);
                        ?>  
                        <select class="form-control" id="article_sub_space_type" name="sub_space_type_id" >
                        <option value="" disabled selected>@lang('custom.articles.select-your-option')</option>  
                        @foreach( $space_types as $space_type )

                        <?php
                         $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);
                        ?> 

                         @foreach($subtypes as $sub )
                            <?php
                             if($article){
                              if($article->sub_space_type_id == $sub->id){
                                 $sub_space_type_id =  'selected';
                                 }
                              else
                                $sub_space_type_id = null;
                             }
                            ?>
                         @if($article)    
                         <option value="{{ $sub->id}}"  {{ $sub_space_type_id }}>{{$sub->name}}</option>
                         @else
                         <option value="{{ $sub->id}}" >{{$sub->name}}</option>
                         @endif
                           @endforeach

                         @endforeach  

                        </select>
                                           

                        
                     </div>


                     <div class="form-group m-b-20">
                        {!! Form::label('name',trans('custom.articles.name') ) !!}

                      {!! Form::text('name', old('name'), ['class' => 'form-control',
                          'id'=>'article-name','placeholder'=>trans('custom.articles.name'),
                          'required'=> 'true'
                        ]) !!}

                     </div>

                    <div class="form-group m-b-20">
                     {!! Form::label('article_heading',trans('custom.articles.article-main-heading') ) !!}
                         
                     {!! Form::text('article_heading', old('article_heading'), ['class' => 'form-control',
                       'id'=>'article-heading','placeholder'=>trans('custom.articles.article-main-heading'),
                       'required'=> 'true'
                     ]) !!}

                  </div>

                     <div class="form-group m-b-20">
                     {!! Form::label('article_quote',trans('custom.articles.article-quote') ) !!}
                         
                     {!! Form::text('article_quote', old('article_quote'), ['class' => 'form-control',
                       'id'=>'article-quote','placeholder'=>trans('custom.articles.article-quote'),
                       'required'=> 'true'
                     ]) !!}

                  </div>


                     <div class="form-group m-b-20">
                       {!! Form::label('description',trans('custom.articles.description')) !!}

                          {!! Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'article-description', 'rows'=>'5', 'placeholder' => trans('custom.articles.description')]) !!}
                     </div>
                

                  </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->
               <div class="col-md-6">
                  <div class="p-20">
                     <div class="form-group m-b-20">
                         {!! Form::label('description_one',trans('custom.articles.description-one'),['class' => 'mb-3']) !!}
                       
                        <div class="row">
                           <div class="col-12">

                              {!! Form::textarea('description_one', old('description_one'), ['class' => 'summernote' ,  'id'=>'article-description-one', 'placeholder' => trans('custom.articles.description-one')]) !!}  
                           </div>
                        </div>
                        <!-- end row -->
                     </div>

                     <div class="form-group m-b-20">
                           {!! Form::label('image',trans('custom.articles.image')) !!}

                           <?php
                              if( $article )
                              {
                                  $image_url = $article->image;
                                
                              }else{
                                  $image_url = null;
                              }
                           ?>
                         
                           

                     
                        <input type="file" class="dropify" name="image"  data-height="120" value="{{ $image_url }}"  accept=".jpeg, .png, .jpg, .gif, .svg">
                        <br/>

                           <img src="{{getDefaultimgagepath($image_url,'articles','')}}" height="100" width="100">
                        
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