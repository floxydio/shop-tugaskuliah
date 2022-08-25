<?php

use App\Exports\TransactionOut;
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\Product;
use App\Http\Controllers\Report;
use App\Http\Controllers\RequestStock;
use App\Http\Controllers\Stocks;
use App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Transaksi;
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
Route::post("/stock-request/{id}", [Stocks::class, "setStock"])->name("stock.request");
Route::get("/edit/status/{id}", [Stocks::class, "approveStock"])->name("stock.edit.status");
Route::get("/status", [Stocks::class, "status"])->name("stock.status");
Route::get("/edit/status-done/{nama}/{quantity}/{id}", [Stocks::class, "finishStock"])->name("done.stock");
Route::get("/superadmin", [SuperAdmin::class, "index"])->name("superadmin");
Route::get("stock/export/", [SuperAdmin::class, "generateReport"])->name("stock.export");
Route::get("/request-stock", [RequestStock::class, "index"])->name("request.stock");
Route::get("/registeruser", [AuthUser::class, "registrasiUser"])->name("registrasi.user");
Route::post("/registeruser/save", [AuthUser::class, "registrasiAccount"])->name("registrasi.save");
Route::post("/edit-stock/{id}", [Product::class, "editHistoryStock"])->name("edit.stock");
Route::post("/products/save", [SuperAdmin::class, "inputStockSuperAdmin"])->name("products.save");
Route::get("/transaction-out", [Transaksi::class, "loadIndex"])->name("transaksi.keluar");
Route::get("/transaction-in", [Transaksi::class, "loadIndexMasuk"])->name("transaksi.masuk");
Route::get("/inventory", [Product::class, "loadInventory"])->name("inventory");
Route::get("/laporan/barang-masuk",[Report::class,"viewTransaksiMasuk"])->name("laporan.masuk");
Route::get("/laporan/generate/reportin", [Report::class,"exportTranscation"])->name("report.export");
Route::get("/laporan/user-total", [Report::class,"viewUserTotal"])->name("laporan.user");
ROute::get("/laporan/generate/reportuser", [Report::class,"exportUser"])->name("report.user");
Route::post("/products/saved", [Stocks::class, "inputStock"])->name("products.saved");
Route::get("/laporan/gudang", [Product::class, "viewGudang"])->name("laporan.gudang");
Route::get("/laporan/barangkeluar", [Report::class,"viewTransaksiKeluar"])->name("report.out");
Route::get("/laporan/generate/reportgudang", [Report::class,"exportInventory"])->name("reports.gudang");
Route::get("/chart/user",[Product::class, "chartUser"])->name("chart.user");
Route::post("/registationstock/{id}", [Transaksi::class, "createStockApprove"])->name("transaksi.report.out.send");
Route::get("/laporan/stock", [Report::class, "viewTotalStock"])->name("report.totalstok");
Route::post("/sendgudang", [Product::class,"addGudang"])->name("gudang.send");