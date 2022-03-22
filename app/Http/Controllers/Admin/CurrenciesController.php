<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrenciesRequest;
use App\Http\Requests\Admin\UpdateCurrenciesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CurrenciesController extends Controller
{

    public function __construct()
    { 
     $this->middleware('auth');
    }
    /**
     * Display a listing of Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

            $title = 'Currencies' ;
            $active_class = 'currencies';
            $route = 'currencies.create';  
        
        if (request()->ajax()) {
            $query = Currency::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
     
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'currencies.id',
                'currencies.name',
                'currencies.symbol',
                'currencies.code',
                'currencies.rate',
                'currencies.status',
                'currencies.is_default',
            ]);
            
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'currency_';
                $routeKey = 'currencies';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->editColumn('rate', function ($row) {
                return $row->rate ? number_format($row->rate,2) : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.currencies.index',compact('title','active_class','route'));
    }

    /**
     * Show the form for creating new Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }
        $title = 'Currencies' ;
        $active_class = 'currencies';
       

        $enum_status = Currency::$enum_status;
        $enum_is_default = Currency::$enum_is_default;
            
        return view('admin.currencies.create', compact('enum_status', 'enum_is_default','title','active_class'));
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param  \App\Http\Requests\StoreCurrenciesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrenciesRequest $request)
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  
        $is_default = $request->is_default;
        if ( 'yes' === $is_default ) {
            $currencies = Currency::all();
            foreach ($currencies as $currency) {
               $currency->update(array( 'is_default' => 'no'));
            }

            $addtional = array(
                'rate' => 1,
            );
            $request->request->add( $addtional ); //add additonal / Changed values to the request object.
        }

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
       
        $currency = Currency::create($request->all());

        updateLocalSettings();

        flashMessage( 'success', 'create' );

        return redirect()->route('currencies.index');
    }


    /**
     * Show the form for editing Currency.
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

        $title = 'Edit Currency';
        $active_class = 'Currencies';     

        $enum_status = Currency::$enum_status;
        $enum_is_default = Currency::$enum_is_default;
            
        $currency = Currency::findOrFail($id);

        return view('admin.currencies.edit', compact('currency', 'enum_status', 'enum_is_default','title','active_class'));
    }

    /**
     * Update Currency in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrenciesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrenciesRequest $request, $id)
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  
        $is_default = $request->is_default;
        if ( 'yes' === $is_default ) {
            $currencies = Currency::all();
            foreach ($currencies as $currency) {
               $currency->update(array( 'is_default' => 'no'));
            }

            $addtional = array(
                'rate' => 1,
            );
            $request->request->add( $addtional ); //add additonal / Changed values to the request object.
        }

        $currency = Currency::findOrFail($id);
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $currency->update($request->all());

       
        if ( 'yes' === $request->update_currency_online ) {
            $this->updateCurrencyRates();
        }

        updateLocalSettings();

        flashMessage( 'success', 'update' );

        return redirect()->route('currencies.index');
    }


    /**
     * Display Currency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $list = '')
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }       

        $currency = Currency::findOrFail($id);

        return view('admin.currencies.show', compact('currency', 'list'));
    }


    /**
     * Remove Currency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  
        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        $currency = Currency::findOrFail($id);
        $currency->delete();

        flashMessage( 'success', 'delete' );

        updateLocalSettings();

       
       return redirect()->route('currencies.index');
        

    }

    /**
     * Delete all selected Currency at once.
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
            $entries = Currency::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
            flashMessage( 'success', 'deletes' );

            updateLocalSettings();
        }
    }


    /**
     * Restore Currency from storage.
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
        $currency = Currency::onlyTrashed()->findOrFail($id);
        $currency->restore();

        flashMessage( 'success', 'restore' );

        updateLocalSettings();

        return back();
    }

    /**
     * Permanently delete Currency from storage.
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
        $currency = Currency::onlyTrashed()->findOrFail($id);
        $currency->forceDelete();

        updateLocalSettings();

        return back();
    }

    public function makeDefault( $id ) {
        
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  

        $currency = Currency::findOrFail($id);

        $currencies = Currency::all();
        foreach ($currencies as $othercurrency) {
           $othercurrency->update(array( 'is_default' => 'no'));
        }

        $currency->rate = 1;
        $currency->is_default = 'yes';
        $currency->save();

        $this->updateCurrencyRates();

        updateLocalSettings();

        flashMessage( 'success', 'restore', trans('global.make_default') );
        return redirect()->route('currencies.index');
    }

    public function updateRates() {

        $this->updateCurrencyRates();

        flashMessage( 'success', 'update' );
        return redirect()->route('currencies.index');
    }

    public function updateCurrencyRates() {
        $apikey = getSetting('currencylayer_api_key', 'currency_settings');
        $currencies = Currency::all();

        $list = array();
        foreach ($currencies as $currency) {
            $list[] = $currency->code;
        }

        if ( ! empty( $apikey ) && ! empty( $list ) ) {
            $basecurrency = Currency::where( 'is_default', '=', 'yes')->first();
            if ( ! empty( $basecurrency ) && ! empty( $basecurrency->code ) ) {
                
                $request = json_decode(file_get_contents('http://www.apilayer.net/api/live?currencies='.implode(',', $list).'&source='.$basecurrency->code.'&access_key='.$apikey), true);
               
                if ( $request && 'true' == $request['success'] ) {
                    foreach ($currencies as $currency) {                       
                       if ( ! empty( $request['quotes'][ $basecurrency->code . $currency->code ] ) ) {
                            $data = array();
                            $data['rate'] = $request['quotes'][ $basecurrency->code . $currency->code ];
                            $currency->update( $data );
                       }
                       
                    }
                }
            }
        }
    }
}
