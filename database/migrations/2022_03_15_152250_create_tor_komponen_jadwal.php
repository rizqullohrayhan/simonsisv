<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorKomponenJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tor');
            $table->string('komponen');
            $table->integer('bulan_awal');
            $table->integer('bulan_akhir');
            $table->timestamps();
            $table->foreign('id_tor')->references('id')->on('tor')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komponen_jadwal');
    }
}
