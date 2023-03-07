<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolssyllabusYearsTable extends Migration
{
    public function up()
    {
        Schema::create('toolssyllabus_years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
