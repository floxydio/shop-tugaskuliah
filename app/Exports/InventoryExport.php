<?php

namespace App\Exports;

// use App\Models\StockApprove;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryExport implements WithHeadings,FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
      //  return DB::query('select products.id, users.name,products.nama,products.quantity,products.status from products LEFT JOIN users ON products.owned_by = users.id')->sortBy("products.id");
      return DB::table("products")->leftJoin("users", "products.owned_by", "=", "users.id")->select("products.id", "users.name", "products.nama", "products.quantity", "products.kode_product")->orderBy("products.id", "asc");
    }
    public function headings(): array
    {
        return [
            'id',
            'Cabang',
            'Product',
            'Quantity',
            'Kode Product'
        ];
    }
}
