<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeachingStaffsTable extends Migration
{
    public function up()
    {
        Schema::table('teaching_staffs', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id', 'subject_fk_8128378')->references('id')->on('subjects');
            $table->unsignedBigInteger('enroll_master_id')->nullable();
            $table->foreign('enroll_master_id', 'enroll_master_fk_8128379')->references('id')->on('course_enroll_masters');
            $table->unsignedBigInteger('working_as_id')->nullable();
            $table->foreign('working_as_id', 'working_as_fk_8128436')->references('id')->on('roles');
        });
    }
}
