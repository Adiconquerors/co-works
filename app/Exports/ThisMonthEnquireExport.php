<?php

namespace App\Exports;

use App\Enquire;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon;

class ThisMonthEnquireExport implements FromQuery, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $this_month_inquiries =  date('m');
        $records = Enquire::whereRaw('MONTH(created_at) = ?',[$this_month_inquiries])
                            ->select('company','name','capacity_id','address','created_at');
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
