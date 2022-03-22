<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertySubSpaceType extends Model
{
    
    protected $table = "property_sub_space_types";

    public function property() {
        return $this->belongsTo(Property::class, 'property_id')->withDefault();
    }

    public function sub_space_type() {
        return $this->belongsTo(SpaceType::class, 'sub_space_type_id')->withDefault();
    }

}
