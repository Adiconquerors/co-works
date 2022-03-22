<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleSubSpaceType extends Model
{
    
    protected $table = "article_sub_space_types";

    public function article() {
        return $this->belongsTo(Article::class, 'article_id')->withDefault();
    }

    public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }

}
