<?php

namespace App\Exports;

use App\Models\UsersModel;
use Illuminate\Foundation\Auth\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersModelExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all([
            'id',
            'name',
           'kota_cabang'
        ]);
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'kota_cabang',
        ];
    }
}
