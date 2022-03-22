@extends( 'layouts.blog_layout' )
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
   <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
         <h2 class="osLight h-r">@lang('custom.articles.categories')</h2>
         <ul class="blog-r-nav">
         <?php
             $space_types = \App\SpaceType::getSpaceTypes(0);
         ?>

         @foreach( $space_types as $space_type)
         <?php
         $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);
         ?>
         @foreach($subtypes as $sub)  
         
            <li><a href="{{ route('blog.list', [ 'type' => 'category', 'type_slug' =>$sub->slug ]) }}">
             
             
               <?php
                  
                    $blog_article_sub_count = \App\Article::where('sub_space_type_id',$sub->id)->count(); 

               ?>
            
               {{$sub->name}} ({{$blog_article_sub_count}})</a></li>
            @endforeach
         @endforeach
         </ul>
      </div>
@section( 'blog_content' )
<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
   <h2 class="osLight">Latest Posts</h2>
   <div class="row">



    @if(count($records) > 0)  

      @foreach( $records as $article )
         
      @php
         $authors  = \App\User::find($article->author_id);
         $sub_space_types =  $article->sub_space_type;   
      @endphp
  

      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
         <div class="article">
            <a href="{{ route('each.article',[$article->id ]) }}" class="image">
               @if( $article->image )
               <img src="{{ IMAGE_PATH_UPLOAD_ARTICLES.$article->image }}" alt="image">
               @else
               <img src="{{ IMAGE_PATH_UPLOAD_SPACE_TYPES }}space-types/1.jpg" > 
               @endif
            </a>
            <div class="article-category"><a href="#" class="text-green isThemeText"></a>
               
                  {{$sub_space_types->name}}
               
            </div>
            <h3 class="osLight"><a href="{{ url('/') }}">{{ $article->name }}</a></h3>
            <p>{{ $article->description }}</p>

            <div class="footer"><a href="{{ route('each.article',[$article->id ]) }}">{{ $authors ? $authors->name : '-' }}</a>, <a href="{{ route('each.article',[$article->id ]) }}">{{ $article->created_at->format('M d , Y') }}</a></div>
         </div>
      </div>
      @endforeach

@else
<h4>@lang('custom.articles.no_article')</h4>
@endif
      
   </div>

   
   
   <div class="blog-pagination">
        {{$records->links()}}
      <div class="clearfix"></div>
   </div>

  

</div>

   
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <h2 class="osLight h-r">@lang('custom.eforms.popular-tags')</h2>
         <div class="blog-tags">
          
               <?php
               $tags = \App\ArticleTag::where('is_popular','Yes')->get();
               ?>
             @foreach( $tags as $tag )    
            <a href="{{ route('blog', [ 'type' => 'tag', 'type_slug' =>$tag->slug ]) }}" class="label label-default">{{$tag->name}}</a>
            @endforeach
         </div>
      </div>
   </div>
</div>
@include( 'partials.blog.signin-signup-modal' )

@stop