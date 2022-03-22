<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Amenity extends Model
{
    use HasSlug;
    
    protected $table = "amenities";

    protected $fillable = ['name','description','icon_id'];

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
        return Amenity::where('slug', '=', $slug)->first();
    }

      public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id')->withDefault();
    }
    
    
}
