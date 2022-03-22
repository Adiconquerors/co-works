<?php

namespace App\Observers;

use App\Property;
use App\Notifications\WL_EmailNotification;
use Illuminate\Support\Facades\Notification;

class PropertyObserver
{
     public function created(Property $model)
    {

        $emails = ['ravitejacstpl@gmail.com'];

         $logo = $model->cover_image;
         $property_agent = \App\User::find($model->agent_id);
       
        $templatedata = array(
            // 'to_email' => 'adiyya@gmail.com',
            'property_name' => $model->name,
            'content' => 'Property has been created',
            'property_url' => route( 'properties.show', [ 'slug' => $model->slug ] ),
            'agent_id' => $property_agent ? $property_agent->name : '-',
            'property_address'=> $model->property_address,
             'logo' => $logo,  
           
        );
       
        $data = [
            "action" => "Created",
            "crud_name" => "Properties",
            'template' => 'property-created',
            'model' => 'App\Property',
            'data' => $templatedata,
        ];

        $users = \App\User::where("email", $emails)->get();

        Notification::send($users, new WL_EmailNotification($data));
       

    }

}
