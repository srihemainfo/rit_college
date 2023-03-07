<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveStaffAllocationsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_staff_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_of_leave');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
