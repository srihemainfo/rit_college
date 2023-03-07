<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeCalendersTable extends Migration
{
    public function up()
    {
        Schema::create('college_calenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('shift')->nullable();
            $table->string('semester_type')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
