<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAparTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_apar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->unique();
            $table->softDeletes();
            $table->string('lokasi_gedung');
            $table->text('alamat');
            $table->string('area', 127);
            $table->string('no_tabung',100);
            $table->integer('berat');
            $table->boolean('kondisi')->default(true);
            $table->string('merk', 127);
            $table->boolean('kondisi_tabung')->default(true);
            $table->string('tahun_pengadaan');
            $table->date('expired');
            $table->text('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_apar');
    }
}
