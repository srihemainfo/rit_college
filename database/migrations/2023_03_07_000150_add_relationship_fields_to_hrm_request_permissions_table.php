<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHrmRequestPermissionsTable extends Migration
{
    public function up()
    {
        Schema::table('hrm_request_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8139747')->references('id')->on('users');
        });
    }
}
