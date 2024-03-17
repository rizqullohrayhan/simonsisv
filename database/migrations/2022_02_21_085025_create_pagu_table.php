<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaguTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_unit');
            $table->unsignedBigInteger('id_tahun');
            $table->integer('pagu');
            $table->integer('tw1')->nullable();
            $table->integer('tw2')->nullable();
            $table->integer('tw3')->nullable();
            $table->integer('tw4')->nullable();
            $table->timestamps();

            $table->foreign('id_unit')->references('id')->on('unit')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tahun')->references('id')->on('tahun')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagu');
    }
}
