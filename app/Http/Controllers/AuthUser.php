<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class AuthUser extends Controller
{
    public function index() {
        $cookie = Cookie::get('user');
        echo $cookie;
        if (Cookie::get("username") != null) {
            return view("dashboard");
        } else {
        return view("login");
        }
    }
    
    public function login(Request $req) {
        $data = [
            "username" => $req->input("username"),
            "password" => $req->input("password")
        ];
        // database
        $err = DB::table("users")->where("username", $data["username"])->where("password", $data["password"])->first();
        if ($err) {
            Cookie::queue("username", $data["username"]);
            return view("dashboard");
        } else {
            return redirect("/sign-in");
        }

    }
}