<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdStatusToTrxStatusTorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_status_tor', function (Blueprint $table) {
            $table->unsignedBigInteger('id_status')->after('id');
            $table->foreign('id_status')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tor')->after('id_status');
            $table->foreign('id_tor')->references('id')->on('tor')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('create_by')->after('id_tor');
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_status_tor', function (Blueprint $table) {
            //
        });
    }
}
