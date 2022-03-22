<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SubSpaceType extends Model
{
    use HasSlug;
    
    protected $table = "sub_space_types";

    protected $fillable = ['name','image_one','image_two','image_three','image_four','description','spacetypes_id','address','capacity','is_verified','area','price'];

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
        return SubSpaceType::where('slug', '=', $slug)->first();
    } 

}
