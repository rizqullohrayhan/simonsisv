<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSpjkategoriToMakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mak', function (Blueprint $table) {
            $table->unsignedBigInteger('id_spjkategori')->after('id');
            $table->foreign('id_spjkategori')->references('id')->on('spj_kategori')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mak', function (Blueprint $table) {
            //
        });
    }
}
