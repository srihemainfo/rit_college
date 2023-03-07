<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('educational_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institute_name')->nullable();
            $table->string('institute_location')->nullable();
            $table->string('board_or_university')->nullable();
            $table->string('marks')->nullable();
            $table->string('marks_in_percentage')->nullable();
            $table->string('subject_1')->nullable();
            $table->string('mark_1')->nullable();
            $table->string('subject_2')->nullable();
            $table->string('mark_2')->nullable();
            $table->string('subject_3')->nullable();
            $table->string('mark_3')->nullable();
            $table->string('subject_4')->nullable();
            $table->string('mark_4')->nullable();
            $table->string('subject_5')->nullable();
            $table->string('mark_5')->nullable();
            $table->string('subject_6')->nullable();
            $table->string('mark_6')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
