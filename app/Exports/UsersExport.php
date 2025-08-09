<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{

    public function __construct(private $filteredUsers)
    {
        $this->filteredUsers = $filteredUsers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->filteredUsers;
    }

    public function headings(): array
    {
        return [
            'UserID',
            'Name',
            'Email',
            'Created At'
        ];
    }
}
