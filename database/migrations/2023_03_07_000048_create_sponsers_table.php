<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsersTable extends Migration
{
    public function up()
    {
        Schema::create('sponsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sponser_type')->nullable();
            $table->string('sponser_name')->nullable();
            $table->string('sponsered_items')->nullable();
            $table->string('sponsered_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
