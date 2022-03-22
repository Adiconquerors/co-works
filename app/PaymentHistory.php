<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnquireCustomerScope;


class PaymentHistory extends Model
{
    
    protected $table = "payment_history";

    protected $fillable = ['property_id', 'action', 'customer_id', 'no_of_seats', 'company_address','amount','gstin','total_amount','invoice_id','description','customer_name','customer_email','customer_mobile','invoice_action','paymentstatus','slug','paymentmethod','transaction_id','slug'];

        public static function boot()
        {
            parent::boot();

            if ( isCustomer() ) {
            static::addGlobalScope(new EnquireCustomerScope);
            }

        }

    public function property() {
        return $this->belongsTo(Property::class, 'property_id')->withDefault();
    }

    public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }

     public function customer()
    {
        return $this->belongsTo(\App\User::class, 'customer_id')->withDefault();
    }

      public function invoice()
    {
        return $this->belongsTo(\App\Invoice::class, 'invoice_id')->withTrashed();
    }
    

}
