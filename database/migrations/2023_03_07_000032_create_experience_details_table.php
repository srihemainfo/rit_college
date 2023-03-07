<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('experience_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('worked_place')->nullable();
            $table->string('taken_subjects')->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
