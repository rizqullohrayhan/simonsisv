<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokMak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_mak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mak');
            $table->string('kelompok');
            $table->timestamps();

            $table->foreign('id_mak')->references('id')->on('mak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelompok_mak');
    }
}
