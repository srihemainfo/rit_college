<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('academic_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('register_number')->nullable();
            $table->string('emis_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
