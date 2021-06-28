<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWitelsTable extends Migration
{
    public function up()
    {
        Schema::table('witels', function (Blueprint $table) {
            $table->unsignedInteger('regional_id');
            $table->foreign('regional_id', 'regional_fk_2065567')->references('id')->on('regionals');
        });
    }
}
