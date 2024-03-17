<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdRabToAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rab')->after('id');
            $table->foreign('id_rab')->references('id')->on('rab')->onDelete('cascade')->onUpdate('cascade');

            // $table->unsignedBigInteger('id_tahap_anggaran')->after('id_rab');
            // $table->foreign('id_tahap_anggaran')->references('id')->on('tahap_anggaran')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggaran', function (Blueprint $table) {
            //
        });
    }
}
