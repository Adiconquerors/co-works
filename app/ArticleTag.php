<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ArticleTag extends Model
{
   

    protected $table = "tags";
    protected $fillable = ['name','is_popular'];

   

   public static function getRecordWithSlug($id)
    {
        return ArticleTag::where('id', '=', $id)->first();
    } 

     public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }
}
