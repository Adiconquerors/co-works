<?php

namespace App\Http\Controllers;

use App\EmailTemplate;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EmailTemplateController extends Controller
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
         $data = 
      [
        'title'        =>  trans('others.add-new-template'), 
        'items'         => EmailTemplate::get(),
        'active_class'  => trans('others.templates')
      ]; 


      return view('admin.templates.list',$data);
     
    }


   /**
     * Show the form for creating new Template.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $template        = FALSE;

        $enum_type = EmailTemplate::$enum_type;
        $title    = trans('others.add-email-template');
        $active_class    = trans('others.templates');
                   
        return view('admin.templates.add-edit', compact('enum_type','title','active_class','template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

         $request->validate([
            'title' => 'required',
            'key' => 'required|unique:email_templates,key',
            'type' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);
        
        $template = EmailTemplate::create($request->all());

        
        flashMessage( 'success', 'create' );
        return redirect()->route('templates.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\EmailTemplate  $template
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $template = EmailTemplate::findOrFail($id);
        $title        =  trans('others.view-template');
        $active_class = trans('others.templates');

        return view('admin.templates.show', compact('template','title','active_class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $template
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

      $template = EmailTemplate::findOrFail($id);

      $data = 
      [ 
      'template'        => $template,
      ];
      
      $enum_type = EmailTemplate::$enum_type;
      $title    = trans('others.edit-template');
      $active_class    = trans('others.templates');
            

        return view('admin.templates.add-edit',$data,compact('template', 'enum_type','title','active_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id )
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
       $rules = [
            'title' => 'required',
            'type' => 'required',
            'subject' => 'required',
            'content' => 'required',

            ];

        if ( $request->isMethod('put') ) {
            
            $template  = EmailTemplate::where('id','=',$id)->first();

           $rules['key'] = 'required|unique:email_templates,key,' . $template->id;
        } 
 
    $request->validate( $rules );
    
    $template = EmailTemplate::findOrFail($id);
    $template->update($request->all());

    flashMessage( 'success', 'update' );
    return redirect()->route('templates.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailTemplate  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        $template = EmailTemplate::findOrFail($id);
        $template->delete();

        flashMessage( 'success', 'delete' );
        return redirect()->route('templates.index');
       
    }


    public function duplicate( $id ) {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
    
        $template = EmailTemplate::find( $id );

        $newtemplate = $template->replicate();

        $newtemplate->key = $template->key . '(duplicate)';

        $newtemplate->save();

        flashMessage( 'success', 'create', trans('others.duplicated'));
        return redirect()->route('templates.index');
    }
}
