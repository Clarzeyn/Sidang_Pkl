<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nik');
            $table->string('nama');
            $table->string('judul');
            $table->text('isi_laporan');
            $table->string('kategori');
            $table->enum('status', ['verified', 'proses', 'selesai']);
            $table->string('name');
            $table->enum('level', ['admin', 'petugas', 'masyarrakat']);

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
        Schema::dropIfExists('tanggapan');
    }
}
