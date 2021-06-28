<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionalsTable extends Migration
{
    public function up()
    {
        Schema::create('regionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_regional')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
