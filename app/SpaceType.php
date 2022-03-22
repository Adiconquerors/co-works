<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SpaceType extends Model
{
	use HasSlug;
    
    protected $table = "space_types";

    protected $fillable = ['name','des_one','image','des_two','des_three','des_four','parent_id'];


    public static $searchable = [ 'name', 'des_one','des_two','des_three','des_four'];
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
        return SpaceType::where('slug', '=', $slug)->first();
    }

   public static function getSpaceTypes($parentId = 0)
    {
    return SpaceType::with(['space_type_membership_fees'])->where('parent_id','=', $parentId)->get();

    }   

    public function space_type_membership_fees()
    {
        return $this->belongsToMany( MembershipFee::class, 'space_type_membership_fees', 'space_type_id', 'membership_fee_id')->select('space_type_membership_fees.*');
    } 

}

