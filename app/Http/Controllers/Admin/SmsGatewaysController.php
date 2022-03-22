<?php

namespace App\Http\Controllers\Admin;

use App\SmsGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSmsGatewaysRequest;
use App\Http\Requests\Admin\UpdateSmsGatewaysRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SmsGatewaysController extends Controller
{
    /**
     * Display a listing of SmsGateway.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  


        $query = SmsGateway::get();
        
        return view('admin.sms_gateways.index', compact('query'));
    }

    /**
     * Show the form for creating new SmsGateway.
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
        'sms_gateway'        => FALSE,
        'active_class'  => 'sms_gateways',
        'title'         => ucfirst('Add sms gateway '),
      ];

        return view('admin.sms_gateways.add-edit',$data);
    }

    /**
     * Store a newly created SmsGateway in storage.
     *
     * @param  \App\Http\Requests\StoreSmsGatewaysRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSmsGatewaysRequest $request)
    {
       
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }  
       
        $sms_gateway = SmsGateway::create($request->all());


        flashMessage( 'success', 'create' );

        return redirect()->route('admin.sms_gateways.index');
    }


    /**
     * Show the form for editing SmsGateway.
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
        $sms_gateway = SmsGateway::getRecordWithId($id);
        $data = 
          [
            'sms_gateway'   => $sms_gateway,
            'active_class'  => 'sms_gateways',
            'title'         => ucfirst('edit sms gateway '),
          ];
        
        return view('admin.sms_gateways.add-edit', $data);
    }

    /**
     * Update SmsGateway in storage.
     *
     * @param  \App\Http\Requests\UpdateSmsGatewaysRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSmsGatewaysRequest $request, $id)
    {
        
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  
        $sms_gateway = SmsGateway::findOrFail($id);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
       
        $sms_gateway->update($request->all());


        flashMessage( 'success', 'update' );
        return redirect()->route('admin.sms_gateways.index');
    }


    /**
     * Display SmsGateway.
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

        $sms_gateway = SmsGateway::findOrFail($id);

        return view('admin.sms_gateways.show', compact('sms_gateway'));
    }


    /**
     * Remove SmsGateway from storage.
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

        $record = SmsGateway::getRecordWithId($id);
         $record->delete(); 

         return redirect()->route('admin.sms_gateways.index');
    }

    /**
     * Delete all selected SmsGateway at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }  

        flashMessage( 'success', 'deletes' );

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        if ($request->input('ids')) {
            $entries = SmsGateway::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            flashMessage( 'success', 'deletes' );
        }
    }


    /**
     * Restore SmsGateway from storage.
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

        $sms_gateway = SmsGateway::onlyTrashed()->findOrFail($id);
        $sms_gateway->restore();

        flashMessage( 'success', 'restore' );
        return back();
    }

    /**
     * Permanently delete SmsGateway from storage.
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

        $sms_gateway = SmsGateway::onlyTrashed()->findOrFail($id);
        $sms_gateway->forceDelete();

        return back();
    }
}
