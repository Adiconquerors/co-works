<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\InvoiceCustomerScope;


class Invoice extends Model
{
    
    protected $table = "invoices";

    protected $fillable = ['property_id', 'action', 'customer_id', 'no_of_seats', 'company_address','amount','gstin','total_amount','invoice_id','description','customer_name','customer_email','customer_mobile','paymentstatus','booking_months','currency_id'];

        public static function boot()
        {
            parent::boot();

            if ( isCustomer() ) {
            static::addGlobalScope(new InvoiceCustomerScope);
            }

        }

    public function property() {
        return $this->belongsTo(Property::class, 'property_id')->withDefault();
    }

    public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }

     public static function getRecordWithId($id)
    {
        return Invoice::where('id', '=', $id)->first();
    }

       public function getPaidUnpaidCount()
    {
        $data = [];
        $data['paid_amount']      = Invoice::where('paymentstatus','=','paid')->sum('total_amount');
        $data['unpaid_amount']    = Invoice::where('paymentstatus','=','unpaid')->sum('total_amount');
        
        return $data;
    }

    public function customer()
    {
        return $this->belongsTo(\App\User::class, 'customer_id')->withDefault();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withDefault()->withTrashed();
    } 

  


}
