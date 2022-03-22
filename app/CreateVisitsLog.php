<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnquireCustomerScope;

class CreateVisitsLog extends Model
{
    
    protected $table = "visits";

    protected $fillable = [ 'property_id' ];

        public static function boot()
        {
            parent::boot();

            if ( isCustomer() ) {
            static::addGlobalScope(new EnquireCustomerScope);
            }

        }


    public static function getRecordWithId($id)
    {
        return Property::where('id', '=', $id)->first();
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
