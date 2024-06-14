<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('siswas')) {
            Schema::create('siswas', function (Blueprint $table) {
                $table->string('nisn_siswa')->primary();
                $table->string('nama_siswa');
                $table->string('jns_kelamin');
                $table->date('tgl_lahir');
                $table->string('alamat');
                $table->unsignedBigInteger('kelas_id');
                $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }


    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}