<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIndustrialExperiencesTable extends Migration
{
    public function up()
    {
        Schema::table('industrial_experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_name_id')->nullable();
            $table->foreign('user_name_id', 'user_name_fk_8129191')->references('id')->on('users');
        });
    }
}
