<?php

namespace App\Exports;

use App\Property;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromQuery, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {	
    	  $records =  Property::select('id','property_address','name','property_manager_name','property_manager_email','property_manager_number');						
    	  return $records;
    }

        public function headings(): array
    {
        return [
            '#',
            'Property Address',
            'Property Name',
            'Property Manager Name',
            'Property Manager Email',
            'Property Manager Number',
        ];
    }
}
