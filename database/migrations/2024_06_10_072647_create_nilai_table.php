<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nisn_siswa');
            $table->string('nama_siswa', 255);
            $table->integer('presensi');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');
            $table->integer('nilai_akhir');
            $table->timestamps();

            $table->foreign('nisn_siswa')->references('nisn')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}