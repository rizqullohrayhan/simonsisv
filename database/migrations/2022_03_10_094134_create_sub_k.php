<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('indikator_subK', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('id_k');
        //     $table->string("subK");
        //     $table->string("deskripsi", 255);
        //     $table->timestamps();

        //     $table->foreign('id_k')->references('id')->on('indikator_K')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_k');
    }
}
