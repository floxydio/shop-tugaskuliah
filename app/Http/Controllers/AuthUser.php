<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class AuthUser extends Controller
{
    public function index() {
        echo Cookie::get("role_user");
        if (Cookie::get("username") != null && Cookie::get("role_user") == 0) {
            return redirect("/");
        } else if (Cookie::get("username") != null && Cookie::get("role_user") == 1) {
            return redirect("/superadmin");
        }else {
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
            Cookie::queue("id_user", $err->id);
            Cookie::queue("role_user", $err->role);
            if ($err->role == "1" || $err->role == 1) {
                redirect("/superadmin")
            ;} else {

                return redirect("/");
            }
        } else {
            return redirect("/sign-in");
        }
    }

    public function logout() {
        Cookie::queue(Cookie::forget('username'));
        Cookie::queue(Cookie::forget('id_user'));
        Cookie::queue(Cookie::forget('role_user'));
        return redirect("/sign-in");
    }
}
