@extends( 'layouts.blog_layout' )
<!-- Content -->
@section( 'blog_content' )
 <style>
    .b-img-height{
      height:100% !important;
    }

    .img-responsive{
        width: 70% !important;
        max-width: 100%;
        height: 350px;
    }
 </style>  
<div class="home-content">
<div class="home-wrapper">
<div class="row">
   
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
<li class="list-group-item"><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{ route('blog', [ 'id' => $sub->id ]) }}">
     <?php
         

           $blog_article_sub_count = \App\Article::where('sub_space_type_id',$sub->id)->count(); 

      ?>
      {{$sub->name}} ({{$blog_article_sub_count}})</a></li>
   @endforeach
@endforeach

       </ul>




 <!-- End Popular Tags -->
 </div>
</div>
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 blolit">
    <div class="panel panel-default blogli">
    <div class="panel-body">

         @php
              $authors  = \App\User::find($records->author_id);
              $sub_space_types =  $records->sub_space_type;   
          @endphp
           

        <div class="post-top">
            <div class="post-author">

              
                <img src="{{getDefaultimgagepath($authors->image,'users','')}}" alt="avatar">

                <div class="pa-user">
                    <div class="pa-name">{{$authors ?  $authors->name : '-'}} @lang('custom.eforms.on') {{$records->created_at->format('M d , Y') }}</div>
                    <div class="pa-title">{{$authors ?  $authors->job_role : '-'}}</div>
                </div>
                <div class="clearfix"></div>
            </div>
           
            <div class="clearfix"></div>
        </div>

        <div class="post-content">
          <p><a href="javascript:void(0);" class="text-green isThemeText">{{ $sub_space_types ? $sub_space_types->name : '-' }}</a></p>
            <h2 class="osLight">{{ $records->name }}</h2>
            <p>{!! $records->description !!} </p>
             <blockquote>{{ $records->article_quote }}</blockquote>
            <div class="col-lg-12 col-xs-12">
               <img src="{{ getDefaultimgagepath($records->image,'articles','') }}" alt="image" class="img-responsive">
               <div class="ib-title"><span class="osLight">{{ $records->name }}</span></div>  
            </div>
            <h2 class="osLight post-content">{{ $records->article_heading }}</h2>
            <p>{!! $records->description_one !!}</p>
            
        </div>
        </div>


<div class="clearfix"></div>
<div class='col-md-12'>
<div class="row">
  <br/>
        <h2 class="osLight align-left"><b>@lang('custom.articles.related-articles')</b></h2>

		<?php
		  $author_related_articles = \App\Article::where('author_id',$records->author_id)->paginate(4);
		?>
		@if( count($author_related_articles) > 0 )
        <div class="row pb20">
        	  @foreach( $author_related_articles as $author_related_article )
        	  @php
		         $authors = \App\User::find($author_related_article->author_id);
             $sub_space_types =  $author_related_article->sub_space_type;   
		       @endphp  
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="article bg-w">
                   <a href="{{ route('each.article',[$author_related_article->id ]) }}" class="image">
					
          <img src="{{ getDefaultimgagepath($author_related_article->image,'articles','') }}" alt="image" class="b-img-height">
          
                  </a>
                    <div class="article-category"><a href="{{ route('each.article',[$author_related_article->id ]) }}" class="text-green isThemeText">{{ $sub_space_types ? $sub_space_types->name : '-' }}</a></div>
                    <h3 class="osLight">
                    	<a href="{{ route('each.article',[$author_related_article->id ]) }}">{{ $author_related_article->name }}
                    	</a>
                    </h3>
                    <div class="footer"><a href="{{ route('each.article',[$author_related_article->id ]) }}">{{ $authors ? $authors->name : '-' }}</a>, <a href="{{ route('each.article',[$author_related_article->id ]) }}">{{ $author_related_article->created_at->format('M d , Y') }}</a></div>
                </div>
            </div>
            @endforeach
      
         
			@else
			<h4 >@lang('global.app_no_records_are_avaliable')</h4>
			@endif        

        </div>

    <div class="pagination">
            {{$author_related_articles->links()}}
        </div> 
  

    <?php
				$tags = \App\ArticleTag::where('is_popular','Yes')->get();
				?>
				@foreach( $tags as $tag )    
				<a href="{{ route('blog', [ 'records' => $records->id, 'type_slug' =>$tag->slug ]) }}" class="label label-default">{{$tag->name}}</a>
				@endforeach
                
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end content -->

@include( 'partials.blog.signin-signup-modal' )
@stop