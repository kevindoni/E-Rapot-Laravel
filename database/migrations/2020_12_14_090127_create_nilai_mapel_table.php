<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('wali_kelas');
            $table->unsignedBigInteger('mapel_id');
            $table->integer('nilai_p');
            $table->integer('nilai_k');
            $table->unsignedBigInteger('tahun_id');
            $table->enum('kelompok', ['Muatan Nasional', 'Muatan Kewilayahan', 'Dasar Bidang Keahlian', 'Dasar Program Keahlian', 'Kompetensi Keahlian']);
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('wali_kelas')->references('id')->on('guru');
            $table->foreign('mapel_id')->references('id')->on('mapel');
            $table->foreign('tahun_id')->references('id')->on('tahun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_mapel');
    }
}
