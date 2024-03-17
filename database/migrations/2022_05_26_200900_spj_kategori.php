<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpjKategori extends Migration
{
    public function up()
    {
        Schema::create('spj_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->integer('is_aktif')->default(1);
            $table->timestamps();
        });
    }
}
