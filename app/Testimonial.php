<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Testimonial extends Model
{
	use HasSlug;

	protected $table = "testimonials";

    protected $fillable = ['name','image','description'];

    public static $searchable = [ 'name', 'description'];
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
        return Testimonial::where('slug', '=', $slug)->first();
    } 
    
}
