<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdMastersTable extends Migration
{
    public function up()
    {
        Schema::create('od_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('level_1_role');
            $table->string('level_2_role');
            $table->string('level_3_role');
            $table->string('approved_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
