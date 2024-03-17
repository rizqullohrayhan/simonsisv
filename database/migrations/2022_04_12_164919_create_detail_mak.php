<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_belanja');
            $table->longText('detail');
            $table->String('harga')->nullable()->default('-');
            $table->String('satuan')->nullable()->default('-');
            $table->timestamps();
            $table->foreign('id_belanja')->references('id')->on('belanja_mak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_mak');
    }
}
