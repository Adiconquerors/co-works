<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;


class TestimonialsController extends Controller
{

     public function __construct()
    { 
     $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items  = Testimonial::get();

    	 if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $data = 
      [
        'title'         => trans('others.add-new-testimonial'), 
        'items'         => Testimonial::get(),
        'active_class'  => trans('others.testimonials')
      ]; 
      
      return view('admin.testimonials.list',$data);
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
        $data = 
      [
        'record'        => FALSE, 
        'title'         => trans('others.add-new-testimonial'),
        'active_class'  => trans('others.testimonials')
      ];
        
        return view('admin.testimonials.add-edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
        'name'           => 'required',
        'description'    => 'required',
        'image'          => 'mimes:jpeg,png,jpg,gif,svg',
        
        ];

       $request->validate( $rules );

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $record = Testimonial::create($request->all())->toSql();
    

        $this->processUpload($request,$record,"image");

        flashMessage( 'success', 'create' );
        return redirect()->route('testimonials.index');
    }


public function processUpload(Request $request,$record,$file_name)
    {
        if( $request->hasFile( $file_name ) )
        {
            $path = public_path("uploads/testimonials/");

            $fileName = $record->id.'-'.$request->$file_name->getClientOriginalName();

            $request->file($file_name)->move($path,$fileName);

            $record->image = $fileName;

            $record->save();
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show( $slug )
    {
    	 if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $record  = Testimonial::getRecordWithSlug($slug);
            
        $title        = trans('others.view-testimonial');
        $active_class = trans('others.testimonials');

        return view('admin.testimonials.show', compact('record','active_class','title'));            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug )
    {


    	 if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $record  = Testimonial::getRecordWithSlug($slug);

         $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.testimonials'),
        'title'         => trans('others.edit-testimonial'),
      ];
   
        return view('admin.testimonials.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        

    	 if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     
    
      $rules = [
        'name'           => 'required',
        'description'    => 'required',
        'image'          => 'mimes:jpeg,png,jpg,gif,svg',
        
        ];

       $request->validate( $rules );

        $record  = Testimonial::getRecordWithSlug($slug);
        $record->update($request->all());

        $this->processUpload($request,$record,"image"); 

        flashMessage( 'success', 'update' );
        return redirect()->route('testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy( $slug )
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }       

         $record = Testimonial::getRecordWithSlug($slug);
         $record->delete(); 

         flashMessage( 'success', 'delete' );
         return redirect()->route('testimonials.index');
    }
}
