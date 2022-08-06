<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class RequestStock extends Controller
{
    //
    public function index() {
        $cookieId = Cookie::get("id_user");
        $dbGetStock = DB::select("select stock_approves.id,stock_approves.quantity,users.id from_id, usr.id to_id,stock_approves.nama_product,users.name from_cabang, usr.name to_cabang, stock_approves.status FROM `stock_approves` LEFT JOIN users ON stock_approves.from_id = users.id LEFT JOIN users usr ON stock_approves.to_id = usr.id WHERE to_id != ?",[$cookieId]);
       return view('requeststock', compact("dbGetStock"));
    }

}
