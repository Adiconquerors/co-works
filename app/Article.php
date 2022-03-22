<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

   public static $searchable = [ 'name', 'description'];

	 public function setSubSpaceTypesIdAttribute($input)
    {
        $this->attributes['sub_space_type_id'] = $input ? json_encode( $input ) : null;
    }

   public function article_sub_space_types()
    {
        return $this->belongsToMany( Article::class, 'article_sub_space_types','article_id','sub_space_type_id');
    }

    public function article_carousals()
    {
        return $this->belongsToMany( Article::class, 'article_carousals' );
    }
 
    public function article_tags()
    {
        return $this->belongsToMany( Article::class, 'article_tags', 'article_id', 'tag_id' );
    }


     public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }
 	

}

	