<?php

namespace App\Exports;

use App\Models\StockApprove;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StockApprove::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'quantity',
            'from_id',
            'to_id',
            'nama_product',
            'from_cabang',
            'to_cabang',
            'status'
        ];
    }
}
