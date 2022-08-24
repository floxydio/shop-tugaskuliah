<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockApprovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_approves', function (Blueprint $table) {
            $table->id();
            $table->string('nama_product');
            $table->integer("quantity");
            $table->integer("from_id");
            $table->integer("to_id");
            $table->integer("status");
            $table->string("keterangan");
            $table->timestamps();
            $table->integer("tipe")->after("status");
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_approves');
    }
}
