<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('no_induk');
            $table->string('nisn');
            $table->enum('jk', ['Laki - Laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']);
            $table->enum('status_keluarga', ['Anak Kandung', 'Anak Tiri']);
            $table->integer('anak_ke');
            $table->text('alamat');
            $table->string('telp');
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('alamat_ortu');
            $table->string('telp_ortu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('nama_wali')->nullable()->default('-');
            $table->text('alamat_wali')->nullable()->default('-');
            $table->string('telp_wali')->nullable()->default('-');
            $table->string('pekerjaan_wali')->nullable()->default('-');
            $table->enum('status', ['Belum Aktif', 'Aktif'])->default('Belum Aktif');
            $table->enum('lulus', ['Belum Lulus', 'Sudah Lulus'])->default('Belum Lulus');
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
        Schema::dropIfExists('siswa');
    }
}
