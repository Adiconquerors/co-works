<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
	 protected $table = "sub_types";

	 protected $fillable = ['name','spacetypes_id','subspacetypes_id'];

	 public static function getRecordWithId($id)
    {
        return SubType::where('id', '=', $id)->first();
    } 
}
