<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_of_periods')->nullable();
            $table->string('no_of_semester')->nullable();
            $table->string('semester_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
