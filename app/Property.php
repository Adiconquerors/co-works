<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\PropertyCustomerScope;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Auth;


class Property extends Model 
{
    use HasSlug;
    

    protected $table = "properties";

     protected $fillable = [
        'space_type_id', 'name', 'cotact_person_name', 'phone_number', 'email', 'alter_email', 'property_manager_name', 'property_manager_email', 'property_manager_number', 'account_number', 'pan_no'
    ];

    public static $searchable = ['name', 'property_address', 'description','company'];

     
	public function setAmenitiesIdAttribute($input)
    {
        $this->attributes['amenity_id'] = $input ? json_encode( $input ) : null;
         
    }

    public function setDaysIdAttribute($input)
    {
        $this->attributes['day_id'] = $input ? json_encode( $input ) : null;
         
    }

     public function setSpaceTypesIdAttribute($input)
    {
        $this->attributes['space_type_id'] = $input ? json_encode( $input ) : null;
    }

    public function setSubSpaceTypesIdAttribute($input)
    {
        $this->attributes['sub_space_type_id'] = $input ? json_encode( $input ) : null;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

  
    public function getCoverImageAttribute($input) {
        return $input ? PREFIX1 . 'thumb/coverimages/' . $input : null;
    }

    public function getPropertyAddressLatitudeAttribute($input) {
        return $input ? $input : get_google_location( $this->attributes['property_address'], 'property_address', 'latitude' );
    }

    public function getPropertyAddressLongitudeAttribute($input) {
        return $input ? $input : get_google_location( $this->attributes['property_address'], 'property_address', 'longitude' );
    }

   public static function getRecordWithSlug($slug)
    {
        return Property::with(['property_amenities'])->where('slug', '=', $slug)->first();
    }

    public function property_sub_space_types()
    {
        return $this->belongsToMany( Property::class, 'property_sub_space_types' )->orderBy('space_type_id')->select('property_sub_space_types.*');
        
    }

  
     public function property_enquires()
    {
        return $this->belongsToMany( Property::class, 'property_sub_space_types' );
    }
   

    public function property_amenities()
    {
    	return $this->belongsToMany( Amenity::class, 'property_amenities', 'property_id', 'amenity_id' );
    }


    public function property_timings()
    {
        return $this->belongsToMany( Property::class, 'property_timings')->select('property_timings.*');
    }

     public function property_space_types()
    {
        return $this->belongsTo(SpaceType::class, 'space_type_id');
    }

        public function getListingSpaceTypeAmount()
    {
        $data = [];


        $data['coworking_space']   = PropertySubSpaceType::where('space_type_id',1)->count();

       $data['meeting_space']      = PropertySubSpaceType::where('space_type_id',2)->count();

       $data['virtual_office']      = PropertySubSpaceType::where('space_type_id',3)->count();
       
        return $data;
    } 

    
}
