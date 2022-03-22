<?php

namespace App\Http\Controllers;

use App\InternalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InternalNotificationsController extends Controller
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

    $internal_notifications = InternalNotification::all()->sortByDesc('id');

        $title = trans('others.internal-notifications');
        $active_class = trans('others.internal-notifications');
        $route = 'internal_notifications.create';  
    
        return view('admin.internal_notifications.index', compact('internal_notifications','title','active_class','route'));
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
        'title'         => trans('others.add-notification'),
        'users'         => \App\User::get()->pluck('name' , 'id'),
        'active_class'  => trans('others.internal-notifications')
      ];
        

        return view( 'admin.internal_notifications.add-edit', $data );
    }

    /**
     * Store a newly created InternalNotification in storage.
     *
     * @param  \App\Http\Requests\StoreInternalNotificationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
       
        $internal_notification = InternalNotification::create($request->all());
        $internal_notification->users()->sync(array_filter((array)$request->input('users')));
        flashMessage( 'success', 'create' );
        return redirect()->route('internal_notifications.index');
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

       $record  = InternalNotification::getRecordWithId($id);

         $data = 
      [
        'record'        => $record,
        'active_class'  => 'Internal Notifications',
        'users'         => \App\User::get()->pluck( 'name', 'id' ),
        'title'         => trans('others.edit-notification'),
      ];


        return view('admin.internal_notifications.add-edit', $data );
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

        $record  = InternalNotification::getRecordWithId($id);

        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

        $record->update($request->all());
        $record->users()->sync(array_filter((array)$request->input('users')));


        flashMessage( 'success', 'update' );
        return redirect()->route('internal_notifications.index');
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
        
        $record = InternalNotification::findOrFail($id);

        return view('admin.internal_notifications.show', compact('record'));
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

        $record = InternalNotification::findOrFail($id);
        $record->delete();

        flashMessage( 'success', 'delete' );
        return redirect()->route('internal_notifications.index');
    }

    /**
     * Delete all selected InternalNotification at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('internal_notification_delete')) {
            return prepareBlockUserMessage( 'danger', 'not_allowed' );
        }

       
        if ($request->input('ids')) {
            $entries = InternalNotification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            flashMessage( 'success', 'deletes' );
        }
    }
    /**
     * Set all user notifications as read
     */
    public function read()
    {
        DB::table('internal_notification_user')
            ->where('user_id', Auth::id())
            ->update(['read_at' => Carbon::now()]);
    }
}
