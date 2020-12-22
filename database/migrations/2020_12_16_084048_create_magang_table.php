<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('mitra');
            $table->string('lokasi');
            $table->string('lamanya');
            $table->string('ket');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();
    
            $table->foreign('siswa_id')->references('id')->on('siswa');
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
        Schema::dropIfExists('magang');
    }
}
