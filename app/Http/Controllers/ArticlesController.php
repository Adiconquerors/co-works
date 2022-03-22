<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\ArticleTag;
use App\SpaceType;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    { 
     $this->middleware('auth');
    }

    
    public function index()
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


      $article = \App\Article::with(['sub_space_type'])->orderBy('created_at', 'desc')->get();

      $title = trans('others.add-article');
      $route = 'articles.create';
      $active_class = trans('others.articles');

      if( isAgent() )
      {
        $article = \App\Article::with(['sub_space_type'])->where('author_id',getContactId())->orderBy('created_at', 'desc')->paginate(10);

      $title = trans('others.add-article');
      $route = '';
      $active_class = trans('others.articles');

      }

      return view( 'admin.articles.list',compact('article','title','active_class','route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $article        = FALSE; 
        $tags            = \App\ArticleTag::get()->where('is_popular','Yes')->pluck('name', 'id');
       
        $title          = trans('others.add-article');
        $active_class   = trans('others.articles');
        

        $authors        = \App\User::whereHas("roles",
        function ($query) {
            $query->whereIn('id', [ADMIN_ROLE_ID,AGENT_ROLE_ID]);
        })->get()->pluck('name', 'id');


        return view('admin.articles.add-edit', compact('title','article','tags','authors','active_class'));
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }     


        $rules = [
        'name'           => 'required',
        'author_id'      => 'required',
        'image'          => 'required|mimes:jpeg,png,jpg,gif,svg',
        
        ];

        $custom_messages = [
            'author_id.required' => trans('others.sel-dropdown'),
        ];

      $request->validate( $rules , $custom_messages );

    $article = new Article();

    $article->name = $request->name;
    $article->author_id = $request->author_id;
    $article->sub_space_type_id = $request->sub_space_type_id;
    $article->description = $request->description;
    $article->description_one = $request->description_one;
    $article->article_heading = $request->article_heading;
    $article->article_quote = $request->article_quote;

    $article->save();

     $this->processUpload($request,$article,"image");
     
    $article->article_tags()->sync( array_filter((array)$request->input('tag_id')) );

        flashMessage( 'success', 'create' );
        return redirect()->route('articles.index');

        
    }

      public function processUpload(Request $request,$article,$file_name)
{
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/articles/");

            $fileName = $article->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $article->image = $fileName;

            $article->save();
        }
    } 

    


    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


         $article = Article::findOrFail($id);
         $title   = trans('others.view-article');
         $active_class = trans('others.articles');
        return view('admin.articles.show', compact('article','active_class','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     


        $article  = Article::where('id', '=', $id)->first();

         $data = 
      [
        'article'        => $article,
        'tags'           => \App\ArticleTag::get()->where('is_popular','Yes')->pluck('name', 'id')->prepend('Please select', ''),
        'active_class'  => trans('others.articles'),
        'title'         => trans('others.edit-article'),
      ];

     

      $authors = \App\User::whereHas("roles",
            function ($query) {
            $query->whereIn('role_id', [1,4]);
            })->get()->pluck('name', 'id'); 
   
        return view('admin.articles.add-edit',$data,compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       } 

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }    


        $rules = [
        'name'           => 'required',
        'author_id'      => 'required',
        'image'          => 'mimes:jpeg,png,jpg,gif,svg',
        
        ];

        $custom_messages = [
            'author_id.required' => trans('others.sel-dropdown'),
        ];

      $request->validate( $rules , $custom_messages );

       $article  = Article::where('id', '=', $id)->first();
        
        $article->name = $request->name;
        $article->author_id = $request->author_id;
        $article->sub_space_type_id = $request->sub_space_type_id;
        $article->description = $request->description;
        $article->description_one = $request->description_one;
        $article->article_heading = $request->article_heading;
        $article->article_quote = $request->article_quote;

        $article->save();
        
        $this->processUpload($request,$article,"image");

        $article->article_tags()->sync( array_filter((array)$request->input('tag_id')) );

        flashMessage( 'success', 'update' );
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {

         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }     


        $article = Article::where('id', '=', $id)->first();
        $article->delete(); 

         flashMessage( 'success', 'delete' );   
         return redirect()->route('articles.index');
    }
}
