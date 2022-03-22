<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnquireCustomerScope;


class UpdateStatusLog extends Model
{
    
    protected $table = "update_status_logs";

    protected $fillable = ['enquiry_id', 'action', 'update_status_user', 'update_status_created',  'update_status_updated'];

        public static function boot()
        {
            parent::boot();

            if ( isCustomer() ) {
            static::addGlobalScope(new EnquireCustomerScope);
            }

        }


    public static function getRecordWithId($id)
    {
        return Enquire::where('id', '=', $id)->first();
    } 

    public function property() {
        return $this->belongsTo(Property::class, 'property_id')->withDefault();
    }

    public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }

     public function city() {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }

}
