<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nisn_siswa')->primary();
            $table->string('nama_siswa', 255);
            $table->char('jns_kelamin', 1);
            $table->date('tgl_lahir');
            $table->string('alamat', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}