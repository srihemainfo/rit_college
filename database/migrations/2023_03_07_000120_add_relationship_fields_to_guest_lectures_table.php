<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGuestLecturesTable extends Migration
{
    public function up()
    {
        Schema::table('guest_lectures', function (Blueprint $table) {
            $table->unsignedBigInteger('user_name_id')->nullable();
            $table->foreign('user_name_id', 'user_name_fk_8129140')->references('id')->on('users');
        });
    }
}
