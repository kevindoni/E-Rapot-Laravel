<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->enum('kelompok', ['Muatan Nasional', 'Muatan Kewilayahan', 'Dasar Bidang Keahlian', 'Dasar Program Keahlian', 'Kompetensi Keahlian']);
            $table->integer('kkm');
            $table->integer('bobot_p');
            $table->integer('bobot_k');
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
        Schema::dropIfExists('mapel');
    }
}
