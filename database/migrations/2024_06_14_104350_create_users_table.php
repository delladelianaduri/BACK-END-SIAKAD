<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('gurus')) {
            Schema::create('gurus', function (Blueprint $table) {
                $table->id();
                $table->string('no_induk')->unique();
                $table->string('nama');
                $table->string('kedudukan');
                $table->string('alamat');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
