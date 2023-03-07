<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSaboticalsTable extends Migration
{
    public function up()
    {
        Schema::table('saboticals', function (Blueprint $table) {
            $table->unsignedBigInteger('name_id')->nullable();
            $table->foreign('name_id', 'name_fk_8129264')->references('id')->on('users');
        });
    }
}
