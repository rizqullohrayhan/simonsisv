<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTahunToTriwulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('triwulan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tahun')->after('id');
            $table->foreign('id_tahun')->references('id')->on('tahun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('triwulan', function (Blueprint $table) {
            //
        });
    }
}
