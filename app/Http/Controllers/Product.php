<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    //
    public function index() {

        $cookieId = Cookie::get("id_user");
        $dbProduct = DB::select("select products.owned_by,products.id, users.name,products.nama,products.quantity,products.status from products LEFT JOIN users ON products.owned_by = users.id WHERE owned_by != ?",[$cookieId]);
        $countToko = DB::table("users")->count();
        $countProduct = DB::table("products")->count();
        $cookie = Cookie::get('username');
        $cookieRole = Cookie::get("role_user");
        // $countCabang = DB::select("select count(*) as count from users where role = 0");
        $countCabang = DB::table("users")->where("role", "0")->count();
        $dbGetStock = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id != ?",[$cookieId]);
       
        if ($cookie != null && $cookieRole == 0) {
            return view('dashboard', compact("countProduct", "countToko", "dbProduct","cookieId", "cookie", "dbGetStock", "countCabang") );
        } else if ($cookie != null && $cookieRole == 1) {
            return redirect("/superadmin");
        }else  {
            return view('login');
        }
    }

    public function loadInventory() {
        $cookieId = Cookie::get("id_user");
        $dbProduct = DB::select("select products.id, users.name,products.nama,products.quantity,products.status from products LEFT JOIN users ON products.owned_by = users.id WHERE owned_by = ?",[$cookieId]);
 
        $countToko = DB::table("users")->count();
        $countProduct = DB::table("products")->count();
        $cookie = Cookie::get('username');
        $cookieRole = Cookie::get("role_user");
        // $countCabang = DB::select("select count(*) as count from users where role = 0");
        $countCabang = DB::table("users")->where("role", "0")->count();
        $getAlluser = DB::table("users")->get();
        $dbGetStock = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id != ?",[$cookieId]);
       
        return view('inventory', compact("countProduct", "countToko", "dbProduct","cookieId", "cookie", "dbGetStock", "countCabang","getAlluser"));
         

    }

    public function editHistoryStock($id) {

        $data = [
            "owned_by" => $_POST["owned_by"],
            "nama" => $_POST["nama"],
            "quantity" => $_POST["quantity"],
            "kode_product" => $_POST["kode_product"]
        
        ];

        $dbProduct = DB::table("products")->where("id", $id)->update($data);
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

  public function editStock() {
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

    public function checkStock() {
        $dataCookie = Cookie::get("username");
        $idUser = Cookie::get("id_user");
        $dbProductSss = DB::select("SELECT products.*, users.name FROM `products` LEFT JOIN users ON products.owned_by = users.id WHERE users.id = ?", [Cookie::get('id_user')]);
        return view("checkstok", compact("dbProductSss", "dataCookie", "idUser"));
    }

    public function viewGudang() {
        $dbProduct = DB::select("select * from products");

        return view('reports.laporan_gudang', compact("dbProduct") );
    }



}
