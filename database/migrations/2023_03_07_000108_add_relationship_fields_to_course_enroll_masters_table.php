<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseEnrollMastersTable extends Migration
{
    public function up()
    {
        Schema::table('course_enroll_masters', function (Blueprint $table) {
            $table->unsignedBigInteger('degreetype_id')->nullable();
            $table->foreign('degreetype_id', 'degreetype_fk_8115039')->references('id')->on('tools_degree_types');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_8115044')->references('id')->on('batches');
            $table->unsignedBigInteger('academic_id')->nullable();
            $table->foreign('academic_id', 'academic_fk_8115040')->references('id')->on('academic_years');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_8115045')->references('id')->on('tools_courses');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_8115047')->references('id')->on('tools_departments');
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->foreign('semester_id', 'semester_fk_8115050')->references('id')->on('semesters');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id', 'section_fk_8115048')->references('id')->on('sections');
        });
    }
}
