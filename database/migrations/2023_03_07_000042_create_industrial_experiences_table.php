<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustrialExperiencesTable extends Migration
{
    public function up()
    {
        Schema::create('industrial_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('work_experience')->nullable();
            $table->string('designation')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('work_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
