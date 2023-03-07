<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntranceExamsTable extends Migration
{
    public function up()
    {
        Schema::table('entrance_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('name_id')->nullable();
            $table->foreign('name_id', 'name_fk_8129130')->references('id')->on('users');
            $table->unsignedBigInteger('exam_type_id')->nullable();
            $table->foreign('exam_type_id', 'exam_type_fk_8129131')->references('id')->on('examstaffs');
        });
    }
}
