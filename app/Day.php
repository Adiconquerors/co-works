<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Day extends Model
{
	use HasSlug;
    
    protected $table = "days";

    protected $fillable = ['name','description'];

     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

      public static function getRecordWithSlug($slug)
    {
        return Day::where('slug', '=', $slug)->first();
    } 

   
}
