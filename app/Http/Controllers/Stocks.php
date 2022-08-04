<?php

namespace App\Http\Controllers;

use App\Exports\StockExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Stocks extends Controller
{
    public function status() { 
        $cookieId = Cookie::get("id_user");
        $dbGetStock = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id = ?",[$cookieId]);

        return view("status", compact("dbGetStock"));
    }

    public function approveStock($id) {
        $data = [
            "status" => 1
        ];
        $dbProduct = DB::table("stock_approves")->where("id", $id)->update($data);
        if ($dbProduct) {
            return redirect("/");
        }
    }
    

    public function finishStock($id) {
        $data = [
            "status" => 2
        ];
        $dbProduct = DB::table("stock_approves")->where("id", $id)->update($data);
        if ($dbProduct) {
            return redirect("/");
        }
    }


    public function setStock() {
        $getCookies = Cookie::get("id_user");
        $_POST["to_id"] = $getCookies;

        $data = [
            "nama_product" => $_POST["nama_product"],
            "quantity" => $_POST["quantity"],
            "from_id" => $_POST["from_id"],
            "to_id" => $_POST["to_id"],
            "status" => 0
        ];
        $dbProduct = DB::table("stock_approves")->insert($data);
        echo $dbProduct;
       
    }


}
