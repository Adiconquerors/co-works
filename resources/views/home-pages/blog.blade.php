@extends( 'layouts.blog_layout' )

@section( 'blog_content' )
 
 <style>
    .b-img-height{
      height:100% !important;
    }

 </style>  

<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
<div class="panel panel-default blogli">
<h4 class="panel-heading">@lang('custom.articles.categories')</h4>
        
         <ul class="list-group">
         <li class="list-group-item"><i class="fa fa-angle-right" aria-hidden="true"></i>
            <?php
               $records_count = \App\Article::with(['sub_space_type'])->orderBy('created_at', 'desc')->get();
            ?>
            <a href="{{ route( 'blog' ) }}">
              All ({{ $records_count->count() }})
            </a>
         </li> 
         <?php
             $space_types = \App\SpaceType::getSpaceTypes(0);
             
         ?>

         @foreach( $space_types as $space_type)
         <?php
           $subtypes = \App\SpaceType::getSpaceTypes($space_type->id);

         ?>
        

         @foreach($subtypes as $sub)  
         
            <li class="list-group-item"> <i class="fa fa-angle-right" aria-hidden="true"></i>
<a href="{{ route('blog', [ 'id' =>$sub->id ]) }}">

                   
               <?php
                    $blog_article_sub_count = \App\Article::where('sub_space_type_id', $sub->id)->count(); 
               ?>
                   
               {{$sub->name}} ({{$blog_article_sub_count}})
            </a>
         </li>
            @endforeach
         @endforeach
         </ul>
      </div></div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 blolit">
   <h2 class="osLight">@lang('custom.articles.latest-posts')</h2>
   <div class="row">
    @if(count($records) > 0)  

      @foreach( $records as $article )

      @php
         $authors  = \App\User::find($article->author_id);
         $sub_space_types =  $article->sub_space_type;   
      @endphp
  

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
         <div class="article">
            <a href="{{ route('each.article',[$article->id ]) }}" class="image">
               <img src="{{getDefaultimgagepath($article->image,'articles','')}}" class="b-img-height">                
            </a>
            <div class="article-category">
               <a href="{{ route('each.article',[$article->id ]) }}" class="text-green isThemeText">
                  {{$sub_space_types->name}}
               </a>
               
            </div>
            <h3 class="osLight">
               <a href="{{ route('each.article',[$article->id ]) }}">
                  {{ $article->name }}
               </a>
            </h3>
            <a href="{{ route('each.article',[$article->id ]) }}">
            <p>{{ $article->description }}</p>
            </a>

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

@include( 'partials.blog.signin-signup-modal' )

@stop

