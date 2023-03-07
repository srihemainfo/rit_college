<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarsTable extends Migration
{
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->nullable();
            $table->string('remark')->nullable();
            $table->date('seminar_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
