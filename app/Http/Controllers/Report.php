<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Exports\TransactionOut;
use App\Exports\UsersExport;
use App\Exports\UsersModelExport;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Controller
{
    //

    public function viewTransaksiKeluar() {
        $cookieId = Cookie::get("id_user");
        $cookieRole = Cookie::get("role_user");


        if ($cookieId == 1 || $cookieId == "1") {

            $dbTransactionOut = DB::select("select stock_approves.keterangan,stock_approves.id,users.alamat,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id where stock_approves.tipe = 2");
        } else {

        $dbTransactionOut = DB::select("select stock_approves.keterangan,stock_approves.id,users.alamat,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id where stock_approves.tipe = 2 AND stock_approves.from_id = ?", [$cookieId]);
        }


        return view('reports.laporan_barangkeluar',compact('dbTransactionOut'));
    }

    public function viewTransaksiMasuk() {
        $cookieId = Cookie::get("id_user");
        $cookieRole = Cookie::get("role_user");

        if ($cookieId == 1 || $cookieId == "1") {
            $dbTransactionOut = DB::select("select stock_approves.keterangan,stock_approves.id,users.alamat,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id where stock_approves.tipe = 1",);
        } else {
            $dbTransactionOut = DB::select("select stock_approves.keterangan,stock_approves.id,users.alamat,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id where stock_approves.tipe = 1 AND stock_approves.from_id != ?", [$cookieId]);
        }

       
        return view('reports.laporan_barangmasuk', compact('dbTransactionOut'));
    }

    public function viewUserTotal() {
        $dbUser = DB::select("SELECT users.id,users.name,users.kota_cabang FROM `users` WHERE users.role != 1");
        return view("reports.laporan_totaluser", compact("dbUser"));
    }

    public function viewTotalStock() {
        $userID = Cookie::get("id_user");
        $cookieId = Cookie::get("role_user");
        if ($cookieId == 1 || $cookieId == "1") {
            $dbStock = DB::select("SELECT * FROM products");
        } else {
            $dbStock = DB::select("SELECT * FROM products WHERE id = ?", [$userID]);
        }
        
        return view("reports.laporan_stok", compact("dbStock"));

    }

}
