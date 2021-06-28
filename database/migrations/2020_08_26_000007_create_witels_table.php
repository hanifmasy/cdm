<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWitelsTable extends Migration
{
    public function up()
    {
        Schema::create('witels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_witel')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
