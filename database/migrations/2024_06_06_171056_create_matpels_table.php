<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatpelsTable extends Migration
{
    public function up()
    {
        Schema::create('matpels', function (Blueprint $table) {
            $table->integer('kd_matpel')->unsigned()->primary();
            $table->string('nama_matpel', 255);
            $table->timestamps(); // Tambahkan kolom created_at dan updated_at secara otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('matpels');
    }
}