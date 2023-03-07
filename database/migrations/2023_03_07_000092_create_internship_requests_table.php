<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('internship_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('level_1_userid')->nullable();
            $table->string('level_2_userid')->nullable();
            $table->string('level_3_userid')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
