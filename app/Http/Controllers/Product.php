<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    //
    public function index() {
        $dbProduct = DB::select("select products.id, users.name,products.nama,products.quantity,products.status from products LEFT JOIN users ON products.owned_by = users.id");
        $countToko = DB::table("users")->count();
        $countProduct = DB::table("products")->count();
        $cookie = Cookie::get('username');
        $cookieId = Cookie::get("id_user");
        $dbGetStock = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id != ?",[$cookieId]);
       
        if ($cookie != null) {
            return view('dashboard', compact("countProduct", "countToko", "dbProduct","cookieId", "cookie", "dbGetStock") );
        } else {
            return view('login');
        }
    }

    public function editHistoryStock() {
        $data = [
            "cabang_id" => $_POST["cabang_id"],
            "nama_product" => $_POST["nama_product"],
            "quantity" => $_POST["quantity"]
        
        ];
        $dbProduct = DB::table("products")->where("id", $data["cabang_id"])->update($data);
        if ($dbProduct) {
            return redirect("/check-stock");
        }

    }

    public function postHistoryStock() {
        $dataCookie = Cookie::get("id_user");
        $_POST["cabang_id"] = $dataCookie;
        $dataCookie = Cookie::get("username");
        $idUser = Cookie::get("id_user");
        $dbProduct = DB::select("SELECT history_stocks.id,history_stocks.nama_product,history_stocks.quantity,history_stocks.image,users.name nama_cabang FROM `history_stocks` LEFT JOIN users ON history_stocks.cabang_id = users.id WHERE users.id = ?", [Cookie::get('id_user')]);
        
        
        $data = [
            "cabang_id" => $_POST["cabang_id"],
            "nama_product" => $_POST["nama_product"],
            "quantity" => $_POST["quantity"]
        ];
        DB::table("history_stocks")->insert($data);
        if ($data) {
            return view("checkstok",compact("dbProduct", "dataCookie", "idUser"));
        }
  }

    public function checkStock() {
        $dataCookie = Cookie::get("username");
        $idUser = Cookie::get("id_user");
        $dbProduct = DB::select("SELECT history_stocks.id,history_stocks.nama_product,history_stocks.quantity,history_stocks.image,users.name nama_cabang FROM `history_stocks` LEFT JOIN users ON history_stocks.cabang_id = users.id WHERE users.id = ?", [Cookie::get('id_user')]);
        return view("checkstok", compact("dbProduct", "dataCookie", "idUser"));
    }

}
