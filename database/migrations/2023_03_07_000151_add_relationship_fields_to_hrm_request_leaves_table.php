<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHrmRequestLeavesTable extends Migration
{
    public function up()
    {
        Schema::table('hrm_request_leaves', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8139757')->references('id')->on('users');
        });
    }
}
