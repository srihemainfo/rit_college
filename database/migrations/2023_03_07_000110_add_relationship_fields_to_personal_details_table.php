<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPersonalDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_name_id')->nullable();
            $table->foreign('user_name_id', 'user_name_fk_8122386')->references('id')->on('users');
            $table->unsignedBigInteger('blood_group_id')->nullable();
            $table->foreign('blood_group_id', 'blood_group_fk_8122763')->references('id')->on('blood_groups');
            $table->unsignedBigInteger('mother_tongue_id')->nullable();
            $table->foreign('mother_tongue_id', 'mother_tongue_fk_8122863')->references('id')->on('mother_tongues');
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->foreign('religion_id', 'religion_fk_8122760')->references('id')->on('religions');
            $table->unsignedBigInteger('community_id')->nullable();
            $table->foreign('community_id', 'community_fk_8122822')->references('id')->on('communities');
        });
    }
}
