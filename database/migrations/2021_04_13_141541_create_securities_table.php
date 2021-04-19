<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecuritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securities', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->bigInteger('employee_no');
            $table->string('nama');
            $table->tinyInteger('status_pernikahan')->comment('0: belum menikah, 1: sudah menikah, 2:duda/janda');
            $table->date('tanggal_masuk');
            $table->date('tanggal_lahir');
            $table->tinyInteger('gender')->comment('1: laki-laki, 2:perempuan');
            $table->string('agama');
            $table->string('nama_client');
            $table->string('area');
            $table->string('kota');
            $table->string('FM');
            $table->string('BM');
            $table->string('lokasi_kerja');
            $table->string('posisi');
            $table->string('jabatan_baru');
            $table->string('skill');
            $table->text('fungsi');
            $table->string('mitra');
            $table->text('nama_file_foto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('securities');
    }
}
