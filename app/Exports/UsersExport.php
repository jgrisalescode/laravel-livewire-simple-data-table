<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping
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

    public function map($user): array
    {
       return [
            $user->id,
            $user->name,
            $user->email,
            $user->created_at,
       ]; 
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
