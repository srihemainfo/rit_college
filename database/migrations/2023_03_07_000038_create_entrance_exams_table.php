<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntranceExamsTable extends Migration
{
    public function up()
    {
        Schema::create('entrance_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('passing_year')->nullable();
            $table->string('scored_mark')->nullable();
            $table->string('total_mark')->nullable();
            $table->string('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
