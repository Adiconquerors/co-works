<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipFee extends Model
{
 	
 	protected $table = "membership_fees";

    protected $fillable = ['people','duration','price','title'];

	 public static function getRecordWithId($id)
	{
	    return MembershipFee::where('id', '=', $id)->first();
	}

	
	
}
