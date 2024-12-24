<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_P', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ik');
            $table->string("P");
            $table->string("deskripsi", 255);
            $table->unsignedBigInteger("verifikator");
            $table->timestamps();
            $table->foreign('id_ik')->references('id')->on('indikator_IK')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('verifikator')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_k');
    }
}
