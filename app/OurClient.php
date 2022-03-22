<?php

namespace App;

use App\OurClient;
use Illuminate\Database\Eloquent\Model;

class OurClient extends Model
{
	protected $table = "our_clients";

    protected $fillable = ['image'];

     public static function getRecordWithId($id)
    {
        return OurClient::where('id', '=', $id)->first();
    } 
}
