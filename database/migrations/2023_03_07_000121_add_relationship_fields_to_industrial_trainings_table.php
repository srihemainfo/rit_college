<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIndustrialTrainingsTable extends Migration
{
    public function up()
    {
        Schema::table('industrial_trainings', function (Blueprint $table) {
            $table->unsignedBigInteger('name_id')->nullable();
            $table->foreign('name_id', 'name_fk_8129172')->references('id')->on('users');
        });
    }
}
