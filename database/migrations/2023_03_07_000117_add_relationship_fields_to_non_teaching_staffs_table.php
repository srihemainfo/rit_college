<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNonTeachingStaffsTable extends Migration
{
    public function up()
    {
        Schema::table('non_teaching_staffs', function (Blueprint $table) {
            $table->unsignedBigInteger('working_as_id')->nullable();
            $table->foreign('working_as_id', 'working_as_fk_8128393')->references('id')->on('roles');
        });
    }
}
