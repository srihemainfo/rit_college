<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddConferencesTable extends Migration
{
    public function up()
    {
        Schema::create('add_conferences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic_name')->nullable();
            $table->string('location')->nullable();
            $table->date('conference_date')->nullable();
            $table->string('contribution_of_conference')->nullable();
            $table->string('project_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
