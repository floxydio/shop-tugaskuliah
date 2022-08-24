<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Transaksi extends Controller
{
    //
    public function loadIndex() {
        $cookieId = Cookie::get("id_user");
        $getAlluser = DB::table("users")->where("role", 0)->where("id", '!=', [$cookieId])->get();
        $dbGetProduct = DB::table("products")->get();


        $dbTransactionOut = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id != ?",[$cookieId]);
        return view("transaksi_keluar", compact("dbGetProduct","getAlluser","dbTransactionOut", "cookieId"));
    } 

    public function loadIndexMasuk() {
        $cookieId = Cookie::get("id_user");

        $dbTransactionOut = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id = ? AND stock_approves.tipe = 2",[$cookieId]);
        return view("transaksi_masuk", compact("dbTransactionOut", "cookieId"));
    } 

    public function createStockApprove($id) {
       
            $getCookies = Cookie::get("id_user");
            $_POST["from_id"] = $getCookies;
            $_POST["to_id"] = $id;
    
            $data = [
                "nama_product" => $_POST["nama_product"],
                "quantity" => $_POST["quantity"],
                "from_id" => $_POST["from_id"],
                "to_id" => $_POST["to_id"],
                "keterangan" => $_POST["keterangan"],
                "status" => 0,
                "tipe" => 1
            ];
            $dbProduct = DB::table("stock_approves")->insert($data);
            // echo $dbProduct;
            if ($dbProduct) {
                return redirect("/");
            } 
    }

    public function stockApproveIn($id) {
       
        $getCookies = Cookie::get("id_user");
        $_POST["to_id"] = $getCookies;
        $_POST["from_id"] = $id;

        $data = [
            "nama_product" => $_POST["nama_product"],
            "quantity" => $_POST["quantity"],
            "from_id" => $_POST["from_id"],
            "to_id" => $_POST["to_id"],
            "keterangan" => $_POST["keterangan"],
            "status" => 0,
            "tipe" => 2
        ];
        $dbProduct = DB::table("stock_approves")->insert($data);
        // echo $dbProduct;
        if ($dbProduct) {
            return redirect("/");
        }
       
    
}
}
