<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSpjSubkategoriToDokumenSpj extends Migration
{
    public function up()
    {
        Schema::table('dokumen_spj', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tor')->after('id');
            $table->foreign('id_tor')->references('id')->on('tor');
            $table->unsignedBigInteger('id_subkategori')->after('id');
            $table->foreign('id_subkategori')->references('id')->on('spj_subkategori')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('dokumen_spj', function (Blueprint $table) {
            //
        });
    }
}
