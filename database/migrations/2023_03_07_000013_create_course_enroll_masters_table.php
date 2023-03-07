<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEnrollMastersTable extends Migration
{
    public function up()
    {
        Schema::create('course_enroll_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enroll_master_number');
            $table->integer('deletes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
