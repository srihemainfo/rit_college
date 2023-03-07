<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('online_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_name')->nullable();
            $table->string('remark')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
