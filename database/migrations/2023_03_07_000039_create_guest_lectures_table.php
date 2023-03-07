<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestLecturesTable extends Migration
{
    public function up()
    {
        Schema::create('guest_lectures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->nullable();
            $table->string('remarks')->nullable();
            $table->string('location')->nullable();
            $table->datetime('from_date_and_time')->nullable();
            $table->datetime('to_date_and_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
