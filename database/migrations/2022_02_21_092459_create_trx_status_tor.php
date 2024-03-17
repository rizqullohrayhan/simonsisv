<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxStatusTor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_status_tor', function (Blueprint $table) {
            $table->id();

            // komentar tiap field
            $table->string("role_by")->nullable();
            $table->string("k_sub")->nullable();
            $table->string("k_judul")->nullable();
            $table->string("k_latar_belakang")->nullable();
            $table->string("k_rasionalisasi")->nullable();
            $table->string("k_tujuan")->nullable();
            $table->string("k_mekanisme")->nullable();
            $table->string("k_jadwal")->nullable();
            $table->string("k_iku")->nullable();
            $table->string("k_ik")->nullable();
            $table->string("k_keberlanjutan")->nullable();
            $table->string("k_penanggung")->nullable();
            $table->string("k_rab")->nullable();
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
        Schema::dropIfExists('trx_status_kegiatan');
    }
}
