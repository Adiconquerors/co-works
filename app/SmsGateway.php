<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SmsGateway
 *
 * @package App
 * @property string $name
 * @property string $key
 * @property text $description
*/
class SmsGateway extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'key', 'description'];
    protected $hidden = [];
    public static $searchable = [
    ];

    public static function boot()
    {
        parent::boot();

        SmsGateway::observe(new \App\Observers\UserActionsObserver);
    }
    public static function getRecordWithId($id)
    {
        return SmsGateway::where('id', '=', $id)->first();
    } 

    public static function storeValidation($request)
    {
        if( $request->name ){
            $rules = [
            'name' => 'max:191|required|unique:sms_gateways',
            'description' => 'max:65535|nullable',
            'logo' => 'max:191|nullable',
            'status' => 'max:191|nullable'
            ];
        }else{
            $rules = [
            'payments' => 'array|nullable',
            'payments' => 'required|exists:payment_gateways,id|max:4294967295|nullable',
            ];
        }
        return $rules;
    }

    public static function updateValidation($request)
    {
        $rules = [
            'name' => 'max:191|required',
            'description' => 'max:65535|nullable',
            'logo' => 'max:191|nullable',
            'status' => 'max:191|nullable'
        ];
        return $rules;
    }

}
