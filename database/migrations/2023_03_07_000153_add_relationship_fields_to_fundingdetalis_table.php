<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFundingdetalisTable extends Migration
{
    public function up()
    {
        Schema::table('fundingdetalis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_name_id')->nullable();
            $table->foreign('user_name_id', 'user_name_fk_8139786')->references('id')->on('users');
        });
    }
}
