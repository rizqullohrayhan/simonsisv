<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran', function (Blueprint $table) {
            $table->id();
            $table->string("catatan", 255)->nullable();
            $table->integer("kebutuhan_vol")->nullable();
            $table->string("kebutuhan_sat")->default('-')->nullable();
            $table->integer("frek")->nullable();
            $table->integer("perhitungan_vol")->nullable();
            $table->string("perhitungan_sat")->default('-')->nullable();
            $table->integer("harga_satuan")->nullable();
            $table->integer("anggaran");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggaran');
    }
}
