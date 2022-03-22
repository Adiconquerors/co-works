<?php

namespace App\Exports;
	
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {	
      $records = \App\User::
      join('roles', 'users.role_id','roles.id')
      ->select('users.id','users.name','roles.title','users.email','users.phone')
      ;   
      return $records;
    }

      public function headings(): array
    {
        return [
            '#',
            'Name',
            'Type',
            'Email',
            'Phone'
        ];
    }
}
