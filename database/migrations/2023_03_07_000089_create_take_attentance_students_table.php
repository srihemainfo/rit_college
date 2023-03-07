<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakeAttentanceStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('take_attentance_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period')->nullable();
            $table->string('taken_from')->nullable();
            $table->string('approved_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
