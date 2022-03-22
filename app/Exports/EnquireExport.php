<?php

namespace App\Exports;

use App\Enquire;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnquireExport implements FromQuery, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
    	$records = Enquire::select('company','name','capacity_id','address','created_at');
        return $records;
    }

         public function headings(): array
    {
        return [
            'Company',
            'Client Name',
            'Capacity',
            'Location',
            'Created At'
        ];
    }
}
