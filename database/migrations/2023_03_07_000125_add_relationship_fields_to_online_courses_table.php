<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOnlineCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('online_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_name_id')->nullable();
            $table->foreign('user_name_id', 'user_name_fk_8129211')->references('id')->on('users');
        });
    }
}
