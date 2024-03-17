<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTwToTorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tor', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tw')->after('id');
            $table->foreign('id_tw')->references('id')->on('triwulan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_unit')->after('id_tw');
            $table->foreign('id_unit')->references('id')->on('unit')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_p')->after('id_unit');
            $table->foreign('id_p')->references('id')->on('indikator_p')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tor', function (Blueprint $table) {
            //
        });
    }
}
