<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatentsTable extends Migration
{
    public function up()
    {
        Schema::create('patents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
