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
}
