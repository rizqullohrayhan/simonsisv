<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->enum('jenis_ajuan', ['Baru', 'Perbaikan']);
            $table->longText('latar_belakang', 2000);
            $table->longText('rasionalisasi', 2000);
            $table->longText('tujuan', 2000);
            $table->longText('mekanisme', 2000);
            $table->longText('keberlanjutan', 1000);
            $table->integer('realisasi_IKU')->nullable();
            $table->integer('target_IKU')->nullable();
            $table->integer('realisasi_IK')->nullable();
            $table->integer('target_IK')->nullable();
            $table->string('nama_pic');
            $table->string('email_pic');
            $table->string('kontak_pic');
            $table->date('tgl_mulai_pelaksanaan');
            $table->date('tgl_akhir_pelaksanaan');
            $table->integer('jumlah_anggaran');
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tor');
    }
}
