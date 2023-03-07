<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustrialTrainingsTable extends Migration
{
    public function up()
    {
        Schema::create('industrial_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->nullable();
            $table->string('location')->nullable();
            $table->string('remarks')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
