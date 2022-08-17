<?php

namespace App\Exports;

use App\Models\StockApprove;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionOut implements FromCollection,WithHeadings
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
            'nama_product',
            'quantity',
            'from_id',
            'to_id',
            'status',
            'keterangan',
        ];
    }
}
