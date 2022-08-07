<?php

use App\Http\Controllers\AuthUser;
use App\Http\Controllers\Product;
use App\Http\Controllers\RequestStock;
use App\Http\Controllers\Stocks;
use App\Http\Controllers\SuperAdmin;
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

Route::get('/', [Product::class, "index"])->name("index");
Route::get("/check-stock", [Product::class, "checkStock"])->name("checkstock");
Route::get("/sign-in", [AuthUser::class, "index"])->name("sign-in");
Route::post("login/save", [AuthUser::class, "login"])->name("login.save");
Route::get("/logout", [AuthUser::class, "logout"])->name("logout");
Route::post("/history-stock", [Product::class, "postHistoryStock"])->name("stock.save");
Route::patch("/history-stock/:id", [Product::class, "editHistoryStock"])->name("stock.edit");
Route::post("/stock-request", [Stocks::class, "setStock"])->name("stock.request");
Route::get("/edit/status/{id}", [Stocks::class, "approveStock"])->name("stock.edit.status");
Route::get("/status", [Stocks::class, "status"])->name("stock.status");
Route::get("/edit/status-done/{id}", [Stocks::class, "finishStock"])->name("done.stock");
Route::get("/superadmin", [SuperAdmin::class, "index"])->name("superadmin");
Route::get("stock/export/", [SuperAdmin::class, "generateReport"])->name("stock.export");
Route::get("/request-stock", [RequestStock::class, "index"])->name("request.stock");
Route::get("/registeruser", [AuthUser::class, "registrasiUser"])->name("registrasi.user");
Route::post("/registeruser/save", [AuthUser::class, "registrasiAccount"])->name("registrasi.save");
Route::post("/edit-stock/{id}", [Product::class, "editHistoryStock"])->name("edit.stock");