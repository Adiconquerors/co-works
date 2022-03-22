<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Listing extends Model
{
	use HasSlug;
    
    protected $table = "listings";

    protected $fillable = ['property_name','description','micromarket_id','propertystatus_id','spacetypes_id','landmark','address','capacity','image','country_id','city_id','venue_id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('property_name')
            ->saveSlugsTo('slug');
    }

   public static function getRecordWithSlug($slug)
    {
        return Listing::where('slug', '=', $slug)->first();
    } 

    
}
