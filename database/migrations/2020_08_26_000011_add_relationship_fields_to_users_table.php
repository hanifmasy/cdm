<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('regional_id')->nullable();
            $table->foreign('regional_id', 'regional_fk_2064679')->references('id')->on('regionals');
            $table->unsignedInteger('witel_id')->nullable();
            $table->foreign('witel_id', 'witel_fk_2064680')->references('id')->on('witels');
        });
    }
}
