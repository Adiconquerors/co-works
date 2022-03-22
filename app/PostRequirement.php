<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRequirement extends Model
{

	protected $table = "post_requirements";

    protected $fillable = ['pr_name','pr_email','pr_number','pr_persons','pr_startdate','pr_city','pr_code','pr_company','pr_prefferedtime','pr_prefferedconnect','pr_information','pr_spacetypes','pr_message'];
 
    
}
