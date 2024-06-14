<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatpelsTable extends Migration
{
    public function up()
    {
        Schema::create('matpels', function (Blueprint $table) {
            $table->id('kd_mapel');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matpels');
    }
}
