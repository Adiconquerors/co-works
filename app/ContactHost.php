<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ContactHost extends Model
{
    
    protected $table = "host_emails";

    protected $fillable = ['name','email','subject','message','property_id']; 


      public function property() {
        return $this->belongsTo(Property::class, 'property_id')->withDefault();
    }
}
