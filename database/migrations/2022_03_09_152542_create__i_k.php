<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_IK', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_iku');
            $table->string("IK");
            $table->string("deskripsi", 255);
            $table->timestamps();
            $table->foreign('id_iku')->references('id')->on('indikator_IKU')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_i_k');
    }
}
