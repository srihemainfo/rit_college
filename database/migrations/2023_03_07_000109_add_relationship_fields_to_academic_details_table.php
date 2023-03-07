<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAcademicDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('academic_details', function (Blueprint $table) {
            $table->unsignedBigInteger('enroll_master_number_id')->nullable();
            $table->foreign('enroll_master_number_id', 'enroll_master_number_fk_8116116')->references('id')->on('course_enroll_masters');
        });
    }
}
