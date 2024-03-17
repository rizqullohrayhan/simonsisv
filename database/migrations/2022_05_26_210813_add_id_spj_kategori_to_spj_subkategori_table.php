<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSpjKategoriToSpjSubkategoriTable extends Migration
{
    public function up()
    {
        Schema::table('spj_subkategori', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kategori')->after('id');
            $table->foreign('id_kategori')->references('id')->on('spj_kategori')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
