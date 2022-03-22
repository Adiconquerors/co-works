<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLanguagesRequest;
use App\Http\Requests\Admin\UpdateLanguagesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LanguagesController extends Controller
{   
    public function __construct() {
       $this->middleware('auth');
    }
    /**
     * Display a listing of Language.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       } 

        $locals = config('app.languages');
        if ( ! empty( $locals ) ) {
            foreach ($locals as $key => $value) {
                $local = Language::firstOrNew([
                    'code' => $key,
                ]);
                if ( empty( $local->language ) ) {
                    $local->language = $value;
                }
                $local->save();
            }            
        }

        $title = 'Languages' ;
        $active_class = '';
        $route = 'admin.languages.create'; 
                
        if (request()->ajax()) {
            $query = Language::query();
            $template = 'actionsTemplate';
          
            $query->select([
                'languages.id',
                'languages.language',
                'languages.code',
                'languages.is_rtl',
                'languages.is_default',
            ]);
            
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'language_';
                $routeKey = 'admin.languages';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.languages.index',compact('active_class','title','route'));
    }

    /**
     * Show the form for creating new Language.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }
        $title = 'Add Language';
        $active_class = 'Languages';
        $route = 'admin.languages.index';

        $enum_is_rtl = Language::$enum_is_rtl;
            
        return view('admin.languages.create', compact('enum_is_rtl','title','active_class','route'));
    }

    /**
     * Store a newly created Language in storage.
     *
     * @param  \App\Http\Requests\StoreLanguagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguagesRequest $request)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        } 
        
        $language = Language::create($request->all());


        updateLanguages();

        flashMessage( 'success', 'create' );
        return redirect()->route('admin.languages.index');
    }


    /**
     * Show the form for editing Language.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }
        $title = 'Edit Language';
        $active_class = 'Languages';

        $enum_is_rtl = Language::$enum_is_rtl;
            
        $language = Language::findOrFail($id);

        return view('admin.languages.edit', compact('language', 'enum_is_rtl','title','active_class'));
    }

    /**
     * Update Language in storage.
     *
     * @param  \App\Http\Requests\UpdateLanguagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguagesRequest $request, $id)
    {
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       } 
        $language = Language::findOrFail($id);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
       
        $language->update($request->all());

        updateLanguages();

        flashMessage( 'success', 'update' );
        return redirect()->route('admin.languages.index');
    }


    /**
     * Display Language.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       } 

        $language = Language::findOrFail($id);
        $title = 'languages';

        return view('admin.languages.show', compact('language','title'));
    }


    /**
     * Remove Language from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        } 
        
        $language = Language::findOrFail($id);
        $language->delete();

        updateLanguages();

        flashMessage( 'success', 'delete' );
      
            return redirect()->route('admin.languages.index');
    }



    /**
     * Permanently delete Language from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeDirection($id)
    {
         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }    
        $language = Language::findOrFail($id);
        if ( 'Yes' === $language->is_rtl ) {
            $language->is_rtl = 'No';
        } else {
            $language->is_rtl = 'Yes';
        }
        $language->save();

        updateLanguages();
        
        flashMessage( 'success', 'update' );

        return redirect()->route('admin.languages.index');
    }


    /**
     * Permanently delete Language from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function makeDefaultLanguage($id)
    {
         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }    
        
        Language::whereRaw('1=1')->update(['is_default' => 'No']);

        $language = Language::findOrFail($id);
        $language->is_default = 'Yes';
        $language->save();        
        
        flashMessage( 'success', 'update' );

        return redirect()->route('admin.languages.index');
    }

    

}
