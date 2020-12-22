<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->unsignedBigInteger('prodi_id');
            $table->string('nama', 2);
            $table->string('nama_kelas');
            $table->unsignedBigInteger('wali_kelas')->nullable();
            $table->enum('status', ['Belum Aktif', 'Aktif'])->default('Belum Aktif');
            $table->timestamps();

            $table->foreign('prodi_id')->references('id')->on('prodi');
            $table->foreign('wali_kelas')->references('id')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
