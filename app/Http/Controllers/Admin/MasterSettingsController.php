<?php

namespace App\Http\Controllers\Admin;

use App\MasterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMasterSettingsRequest;
use App\Http\Requests\Admin\UpdateMasterSettingsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Barryvdh\TranslationManager\Models\Translation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;



class MasterSettingsController extends Controller
{
    var $config;
    var $app;
    protected $files;

    public function __construct( Application $app, Filesystem $files ) {
        $this->app            = $app;
        $this->files          = $files;

        $this->middleware('auth');
    }
    /**
     * Display a listing of MasterSetting.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

       $master_setting = MasterSetting::all()->sortByDesc('id');

        $title = "Add Master Settings";
        $active_class = "master settings";
        $route ="admin.master_settings.create";

        if( env('APP_DEV') ) {
             return view('admin.master_settings.index', compact('master_setting','title','active_class','route')); 
        }else{
            return view('admin.master_settings.index', compact('master_setting','title','active_class','route'));
        }

       
    }
    

    /**
     * Show the form for creating new MasterSetting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        $enum_moduletype = MasterSetting::$enum_moduletype;
        return view('admin.master_settings.create', compact('enum_moduletype'));
    }

    /**
     * Store a newly created MasterSetting in storage.
     *
     * @param  \App\Http\Requests\StoreMasterSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMasterSettingsRequest $request)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $master_setting = MasterSetting::create($request->all());

		if( 'payment' === $request->moduletype) {
			app('App\Http\Controllers\Admin\GeneralSettingsController')->savePaymentGateway();
		}

        flashMessage( 'success', 'create' );
        return redirect()->route('admin.master_settings.index');
    }


    /**
     * Show the form for editing MasterSetting.
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

        $master_setting = MasterSetting::findOrFail($id);
        $enum_moduletype = MasterSetting::$enum_moduletype;

        return view('admin.master_settings.edit', compact('master_setting', 'enum_moduletype'));
    }

    /**
     * Update MasterSetting in storage.
     *
     * @param  \App\Http\Requests\UpdateMasterSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMasterSettingsRequest $request, $id)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        $master_setting = MasterSetting::findOrFail($id);
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $master_setting->update($request->all());

		if( 'payment' === $request->moduletype) {
			app('App\Http\Controllers\Admin\GeneralSettingsController')->savePaymentGateway();
		}



        flashMessage( 'success', 'update' );
        return redirect()->route('admin.master_settings.index');
    }


    /**
     * Display MasterSetting.
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

        $master_setting = MasterSetting::findOrFail($id);

        return view('admin.master_settings.show', compact('master_setting'));
    }


    /**
     * Remove MasterSetting from storage.
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
        $master_setting = MasterSetting::findOrFail($id);
        $master_setting->delete();



        flashMessage( 'success', 'delete' );
        if ( ! empty( $request->redirect_url ) ) {
           return redirect( $request->redirect_url );
        } else {
           return back();
        }
    }

    /**
     * Delete all selected MasterSetting at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        if ($request->input('ids')) {
            $entries = MasterSetting::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }



            flashMessage( 'success', 'deletes' );
        }
    }


    /**
     * Restore MasterSetting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $master_setting = MasterSetting::onlyTrashed()->findOrFail($id);
        $master_setting->restore();



        flashMessage( 'success', 'restore' );

        return back();
    }

    /**
     * Permanently delete MasterSetting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {

        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }      

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }



        $master_setting = MasterSetting::onlyTrashed()->findOrFail($id);
        $master_setting->forceDelete();



        return back();
    }

    // Translation Manager.
    protected function makeTree( $translations, $json = false )
    {

        $array = [];
        foreach ( $translations as $translation ) {
            if ( $json ) {
                $this->jsonSet( $array[ $translation->locale ][ $translation->group ], $translation->key,
                    $translation->value );
            } else {
                array_set( $array[ $translation->locale ][ $translation->group ], $translation->key,
                    $translation->value );
            }
        }

        return $array;
    }
    public function jsonSet( &$array, $key, $value )
    {
        if ( is_null( $key ) ) {
            return $array = $value;
        }
        $array[ $key ] = $value;

        return $array;
    }

    public function translate( Request $request ) {
        $group = $request->group;

        $this->config         = config('translation-manager');

        $vendor = false;
        if ( starts_with( $group, "vendor" ) ) {
            $vendor = true;
        }
        if ( '_json' === $group ) {
            $tree = $this->makeTree( Translation::ofTranslatedGroup( $group )
                                                    ->orderByGroupKeys( array_get( $this->config, 'sort_keys', false ) )
                                                    ->get(), true );
        } else {
            $tree = $this->makeTree( Translation::ofTranslatedGroup( $group )
                                                    ->orderByGroupKeys( array_get( $this->config, 'sort_keys', false ) )
                                                    ->get() );
        }

        $source = $request->source;
        $target = $request->target;

        foreach ( $tree as $locale => $groups ) {
            if ( isset( $groups[ $group ] ) ) {
                $translations = $groups[ $group ];
                $translations = Arr::dot( $translations );

                foreach ($translations as $key => $value) {
                    $translation = Translation::firstOrNew([
                        'locale' => $target,
                        'group' => $group,
                        'key' => $key,
                    ]);
                    if ( empty( $translation->value ) ) {
                        $translated = translate( $source, $target, $value ); // Let us translate new strings only.
                        $translation->value = (string) $translated ?: null;
                        $translation->status = Translation::STATUS_CHANGED;
                        $translation->save();
                    }
                }
            }
        }

        flashMessage( 'success', 'create', trans('custom.translations.translate-success') );

        return redirect( 'admin/translations/view/' . $group );
    }

    public function vueTranslate( Request $request ) {

        \Artisan::call("vue-i18n:generate");

        \Artisan::call("lang:js resources/client/assets/js/vue-translations.js --json");

        flashMessage( 'success', 'create', trans('custom.translations.translate-success') );
        return redirect( 'admin/translations');
    }
}
