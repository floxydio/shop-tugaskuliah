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
        if ($cookie != null) {
            return view('dashboard', compact("countProduct", "countToko", "dbProduct") );
        } else {
            return view('login');
        }
    }

    public function checkStock() {
        $dbProduct = DB::select("SELECT history_stocks.id,history_stocks.nama_product,history_stocks.quantity,history_stocks.image,users.name nama_cabang FROM `history_stocks` LEFT JOIN users ON history_stocks.cabang_id = users.id WHERE users.id = ?", [Cookie::get('id')]);

        return view("checkstok", compact("dbProduct"));
    }
}
