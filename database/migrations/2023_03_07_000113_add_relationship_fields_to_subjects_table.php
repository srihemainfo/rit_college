<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('syllabus_id')->nullable();
            $table->foreign('syllabus_id', 'syllabus_fk_8123551')->references('id')->on('toolssyllabus_years');
        });
    }
}
