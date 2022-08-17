<?php

namespace App\Http\Controllers;

use App\Exports\TransactionOut;
use App\Exports\UsersExport;
use App\Exports\UsersModelExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Controller
{
    //

    public function viewTransaksiMasuk() {
        $dbTransactionOut = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id");
        return view('reports.laporan_barangmasuk', compact('dbTransactionOut'));
    }

    public function viewUserTotal() {
        $dbUser = DB::select("SELECT users.id,users.name,users.kota_cabang FROM `users`");
        return view("reports.laporan_totaluser", compact("dbUser"));
    }

    public function exportTranscation() {
        return Excel::download(new TransactionOut, 'transaction.xlsx');
    }

    public function exportUser() {
        return Excel::download(new UsersModelExport, "users.xlsx");
    }

}
