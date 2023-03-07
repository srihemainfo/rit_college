<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationBoardsTable extends Migration
{
    public function up()
    {
        Schema::create('education_boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('education_board')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
