<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->string('nisn_siswa');
            $table->string('nama_siswa');
            $table->integer('presensi');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');
            $table->float('nilai_akhir');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}

