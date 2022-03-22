<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MenusController extends Controller
{

     public function __construct()
    { 
     $this->middleware('auth');
    }
    /**
     * Display a listing of InternalNotification.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     

        $menus = Menu::all()->sortByDesc('id');

        $title = trans('others.add-menu');
        $active_class = trans('others.menus');
        $route ="menus.create";
    
        return view('admin.menus.index', compact('menus','title','active_class','route'));
    }

    /**
     * Show the form for creating new InternalNotification.
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
        'title'         => trans('others.add-menu'),
        'icons'         => Icon::pluck('name','id')->toArray(),
        'active_class'  => trans('others.menus')
      ];
        

        return view( 'admin.menus.add-edit', $data );
    }

    /**
     * Store a newly created InternalNotification in storage.
     *
     * @param  \App\Http\Requests\StoreInternalNotificationsRequest  $request
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
        

        $menu = Menu::create($request->all());

        flashMessage( 'success', 'create' );
        return redirect()->route('menus.index');
    }


    /**
     * Show the form for editing InternalNotification.
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

       $record  = Menu::getRecordWithId($id);

         $data = 
      [
        'record'        => $record,
        'active_class'  => trans('others.menus'),
        'title'         => trans('others.edit-menu'),
        'icons'         => Icon::pluck('name','id')->toArray(),
      ];


        return view('admin.menus.add-edit', $data );
    }

    /**
     * Update InternalNotification in storage.
     *
     * @param  \App\Http\Requests\UpdateInternalNotificationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if( ! ( isAdmin() ) )
       {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }     
        $record  = Menu::getRecordWithId($id);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record->update($request->all());

        flashMessage( 'success', 'update' );
        return redirect()->route('menus.index');
    }


    /**
     * Display InternalNotification.
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
        
        $record = Menu::findOrFail($id);
        $active_class  = trans('others.menus');
        $title         = ucwords('show menu');

        return view('admin.menus.show', compact('record','active_class','title'));
    }


    /**
     * Remove InternalNotification from storage.
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

        $record = Menu::findOrFail($id);
        $record->delete();

        flashMessage( 'success', 'delete' );
        return redirect()->route('menus.index');
    }

    /**
     * Delete all selected InternalNotification at once.
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
            $entries = Menu::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            flashMessage( 'success', 'deletes' );
        }
    }
  
}
