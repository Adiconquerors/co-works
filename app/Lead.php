<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnquireCustomerScope;

class Lead extends Model
{
    
    protected $table = "leads";

    protected $fillable = ['name', 'email', 'phone_number', 'address',  'company', 'sub_space_type_id', 'capacity_id', 'property_id','description', 'enquire_date' , 'enquire_time_from', 'enquire_time_to', 'enquire_month','otp','enquire_from','agent_id','enquiry_id','deal_lost_no','assigned_to','is_phone_verified','flag_color','comments','update_status','progress','comments','deal_lost','deal_comments','customer_id'];

        public static function boot()
        {
            parent::boot();

            if ( isCustomer() ) {
            static::addGlobalScope(new EnquireCustomerScope);
            }

        }

    public static function getRecordWithId($id)
    {
        return Lead::where('id', '=', $id)->first();
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
