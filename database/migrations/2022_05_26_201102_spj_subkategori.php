<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpjSubkategori extends Migration
{
    public function up()
    {
        Schema::create('spj_subkategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_subkategori');
            $table->longText(
                'catatan'
            )->nullable();
            $table->integer('is_aktif')->default(1);
            $table->timestamps();
        });
    }
}
