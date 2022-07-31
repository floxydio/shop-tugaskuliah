<?php

use App\Http\Controllers\AuthUser;
use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Product::class, "index"]);

Route::get("/sign-in", [AuthUser::class, "index"])->name("sign-in");
Route::post("login/save", [AuthUser::class, "login"])->name("login.save");