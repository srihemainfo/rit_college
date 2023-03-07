<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumofStudiedsTable extends Migration
{
    public function up()
    {
        Schema::create('mediumof_studieds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('medium')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
